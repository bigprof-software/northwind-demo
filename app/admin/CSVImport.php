<?php
	class CSVImport{
		private $curr_dir,
				$curr_page,
				$lang, /* translation text */
				$settings, /* assoc array that stores $_REQUEST */
				$error_back_link,
				$max_batch_size, /* max # of non-empty lines to insert per batch */
				$max_data_length, /* max length of csv data in read per batch in bytes */
				$initial_ts; /* initial timestamp */

		public function __construct($settings = array()) {
			global $Translation;

			$this->curr_dir = dirname(__FILE__);
			$this->curr_page = basename(__FILE__);
			$this->max_batch_size = 500;
			$this->max_data_length = 0.5 * 1024 * 1024;
			$this->initial_ts = microtime(true);
			$this->lang = $Translation;

			/* back link to use in errors */
			$this->error_back_link = '' .
				'<div class="text-center vspacer-lg"><a href="' . $this->curr_page . '" class="btn btn-danger btn-lg">' .
					'<i class="glyphicon glyphicon-chevron-left"></i> ' .
					$this->lang['back and retry'] .
				'</a></div>';

			$this->settings = $settings;
		}

		protected function debug($msg, $html = true) {
			if($settings['DEBUG_MODE'] && $html) return "<pre>DEBUG: {$msg}</pre>";
			if($settings['DEBUG_MODE']) return " [DEBUG: {$msg}] ";
			return '';
		}

		protected function elapsed() {
			return number_format(microtime(true) - $this->initial_ts, 3);
		}

		protected function csv_path($csv_file = '') {
			$csv_path = "{$thid->curr_dir}/../csv";
			@mkdir($csv_path);
			if(!is_dir($csv_path)) return false;

			return rtrim("$csv_path/{$csv_file}", '/');
		}

		/**
		 *  @brief retrieve and validate the csv file specified in the request parameter 'csv'
		 *  
		 *  @param [in] $options optional assoc array of options ('htmlpage' => bool, displaying errors as html page)
		 *  @return csv filename if valid, false otherwise.
		 */
		protected function get_csv($options = array()) {
			$csv = $this->settings['csv'];

			if(!$csv) {
				if(isset($options['htmlpage'])) {
					echo $this->header();
					echo errorMsg($this->lang['csv file upload error'] . $this->error_back_link . $this->debug(__LINE__));
					echo $this->footer();
				}
				return false;
			}

			$csv = basename($csv);
			if(!is_readable($this->csv_path($csv))) return false;

			return $csv;
		}

		/**
		 *  @brief Retrieve and validate name of table used for importing data
		 *  
		 *  @param [in] $silent (optional) boolean indicating no output to client if true, useful in ajax requests for example.
		 *  @return table name, or false on error.
		 */
		protected function get_table($silent = false) {
			$table_ok = true;

			$table = $this->settings['table'];
			if(!$table) $table_ok = false;

			if($table_ok) {
				$tables = getTableList();
				if(!array_key_exists($table, $tables)) $table_ok = false;
			}

			if(!$table_ok) {
				if($silent) return false;

				echo $this->header();
				echo errorMsg(str_replace('<TABLENAME>', html_attr($table), $this->lang['table name title']) . ': ' . $this->lang['does not exist'] . $this->error_back_link . $this->debug(__LINE__));
				echo $this->footer();
				return false;
			}

			return $table;
		}

		protected function table_fields($table) {
			$fields = array();

			$stable = makeSafe($table);
			$res = sql("SHOW FIELDS FROM `{$stable}`", $eo);
			while($row = db_fetch_assoc($res)) {
				$fields[] = $row['Field'];
			}

			return $fields;
		}

		/**
		  * start/continue importing a csv file into the db (ajax-friendly)
		  */
		public function import() {
			@header('Content-type: application/json');
			$res = array(
				'imported' => 0,
				'failed' => 0,
				'remaining' => 0,
				'logs' => array()
			);

			$csv_status = $this->start();
			if(isset($csv_status['error'])) {
				$res['logs'][] = $csv_status['error'];
				echo json_encode($res);
				return;
			}

			$start = $csv_status['start'];

			$lines = $this->csv_lines();
			if($start >= $lines) { // no more rows to import
				$res['logs'][] = $this->lang['mission accomplished'];
				echo json_encode($res);
				$this->start(0);
				return;
			}

			$settings = $this->get_csv_settings();
			if($settings === false) {
				$res['logs'][] = $this->debug(__LINE__, false) . $this->lang['csv file upload error'];
				echo json_encode($res);
				return;
			}
			$data_lines = $lines - ($settings['has_titles'] ? 1 : 0);

			$bkp_res = $this->backup_table($start, $settings);
			if(isset($bkp_res['error'])) {
				$res['logs'][] = $this->debug(__LINE__, false) . $bkp_res['error'];
				echo json_encode($res);
				return;
			}elseif(isset($bkp_res['status'])) {
				$res['logs'][] = $bkp_res['status'];
			}

			$csv_data = $this->get_csv_data($start, $settings);
			if(!count($csv_data)) {
				$res['logs'][] = $this->lang['mission accomplished'];
				echo json_encode($res);
				$this->start(0);
				return;
			}

			$res['logs'][] = str_replace(
				array('<RECORDNUMBER>', '<RECORDS>'),
				array(number_format($start + 1), number_format($data_lines)),
				$this->lang['start at estimated record']
			);

			$res['imported'] = count($csv_data);
			$new_start = $start + $res['imported'];
			$res['remaining'] = $lines - $new_start;

			$query_info = $eo = array();
			$insert = $this->get_query($csv_data, $settings, $query_info);
			if($insert === false) {
				$res['logs'][] = $this->debug(__LINE__, false) . $this->lang['csv file upload error'];
				echo json_encode($res);
				return;
			}

			if(!sql($insert, $eo)) {
				$res['logs'][] = $this->debug(__LINE__, false) . db_error();
				echo json_encode($res);
				return;
			}

			$res['logs'][count($res['logs']) - 1] .= " {$this->lang['ok']}";

			if($new_start >= $lines) {
				$this->start(0); /* reset csv status after finishing */
			}else{
				$this->start($new_start); /* update csv status file to new start */
			}

			echo json_encode($res);
		}

		protected function setting_or($var, $default) {
			return (isset($this->settings[$var]) ? $this->settings[$var] : $default);
		}

		/**
		 *  @brief Retrieve and validate CSV settings from REQUEST
		 *  
		 *  @return false on error, or associative array (table, backup_table, update_pk, has_titles, ignore_lines, field_separator, field_delimiter, mappings[])
		 */
		protected function get_csv_settings() {
			static $settings = array();
			if(!empty($settings)) return $settings; // cache to avoid reprocessing

			$settings = array(
				'backup_table' => (bool) $this->setting_or('backup_table', true),
				'update_pk' => (bool) $this->setting_or('update_pk', false),
				'has_titles' => (bool) $this->setting_or('has_titles', false),
				'ignore_lines' => max(0, (int) $this->setting_or('ignore_lines', 0)),
				'field_separator' => $this->setting_or('field_separator', ','),
				'field_delimiter' => $this->setting_or('field_delimiter', '"'),
				'mappings' => $this->setting_or('mappings', array())
			);

			if(!$settings['field_delimiter']) $settings['field_delimiter'] = '"';
			if(!$settings['field_separator']) $settings['field_separator'] = ',';

			$settings['table'] = $this->get_table(true);
			if($settings['table'] === false) return false;

			if(!is_array($settings['mappings']) || !count($settings['mappings'])) return false;

			/* validate and trim field names */
			$last_field_key = count($settings['mappings']) - 1;
			$mappings = array();
			for($i = 0; $i <= $last_field_key; $i++) {
				$fn = $settings['mappings'][$i];
				$fn = trim($fn);
				if(!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $fn) && $fn != 'ignore-field') return false;

				/* make sure field is not already mapped to another column */
				if(isset($mappgins[$fn])) return false;

				$settings['mappings'][$i] = $fn;
				if($fn == 'ignore-field') {
					unset($settings['mappings'][$i]);
				}else{
					$mappgins[$fn] = true;
				}
			}

			if(!count($settings['mappings'])) return false;

			return $settings;
		}

		/**
		 *  @brief Counts non-empty lines in the current csv file. Count is cached for performance.
		 *  
		 *  @return number of non-empty data lines in csv
		 *  
		 *  @details This function counts all non-empty, including the title column
		 */
		protected function csv_lines() {
			$csv = $this->get_csv();
			if(!$csv) return 0;

			/*
				store lines count server-side:
				for each csv file being imported, create a count file in the csv folder named {csv-file-name.csv.count}
				the file stores the # of non-empty lines.
			*/
			$csv_file = $this->csv_path($csv);
			$count_file = "{$csv_file}.count";

			/* if csv modified after counting its lines, force recount */
			if(is_file($count_file) && filemtime($count_file) < filemtime($csv_file)) {
				@unlink($count_file);
				return $this->csv_lines();
			}

			$lines = @file_get_contents($count_file);
			if($lines !== false) return intval($lines);

			/* this is a new import process */
			$lines = 0;
			$fp = @fopen($csv_file, 'r');
			if($fp === false) return 0;

			/* start counting non-empty lines of csv */
			while($line = fgets($fp)) {
				if(strlen(trim($line))) $lines++;
			}
			fclose($fp);

			@file_put_contents($count_file, $lines);
			return $lines;
		}

		/**
		 *  @brief if this is the beginning of the import process, perform table backup if requested
		 *  
		 *  @param $start current line in csv
		 *  @param $settings assoc arry of csv settings
		 *  @return assoc array, 'status' key and value if successful, 'error' key and value on error
		 */
		protected function backup_table($start, $settings) {
			if($start > 0) return array(); // no need to backup as we've passed the first batch
			if(!$settings['backup_table']) return array(); // no backup requested

			$table = $this->get_table(true);
			if($table === false) return array('error' => $this->lang['no table name provided'] . $this->debug(__LINE__, false));

			$stable = makeSafe($table);
			if(!sqlValue("SELECT COUNT(1) FROM `{$stable}`")) // nothing to backup!
				return array('status' => str_replace('<TABLE>', $table, $this->lang['table backup not done']));

			$btn = $stable . '_backup_' . @date('YmdHis');
			$eo = array();
			sql("DROP TABLE IF EXISTS `{$btn}`", $eo);
			if(!sql("CREATE TABLE IF NOT EXISTS `{$btn}` LIKE `{$stable}`", $eo))
				return array('error' => str_replace('<TABLE>', $table, $this->lang['error backing up table'] . $this->debug(__LINE__, false)));
			if(!sql("INSERT `{$btn}` SELECT * FROM `{$stable}`", $eo))
				return array('error' => str_replace('<TABLE>', $table, $this->lang['error backing up table'] . $this->debug(__LINE__, false)));

			return array(
				'status' => str_replace(
					array('<TABLE>', '<TABLENAME>'),
					array($table, $btn),
					$this->lang['table backed up']
				)
			);
		}

		protected function no_bom($str) {
			return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
		}

		/**
		 *  @brief opens current csv file and reads several lines from it, starting at non-empty line $start
		 *  
		 *  @param $start non-empty line # to start reading from
		 *  @param $settings csv settings array as retrieved from CSV::get_csv_settings
		 *  @return numeric 2D array of csv data (row1array, row2array, ...)
		 */
		protected function get_csv_data($start, $settings) {
			if($settings === false) return array();

			$csv = $this->get_csv();
			$csv_file = "{$this->curr_dir}/csv/{$csv}";
			$first_line = true;

			$fp = @fopen($csv_file, 'r');
			if(false === $fp) return array();

			/* skip $start non-empty lines */
			$skip = $start;

			/* apply ignore_lines */
			if($start < $settings['ignore_lines']) $skip = $settings['ignore_lines'];

			/* get key of last mapping field -- used later here to apply ignored fields */
			end($settings['mappings']);
			$last_field_key = key($settings['mappings']);

			/* skip title line */
			$skip += ($settings['has_titles'] ? 1 : 0);

			for($i = 0; $i < $skip; $i++) {
				/* keep reading till a non-empty line or EOF */
				do {
					$line = @implode('', @fgetcsv($fp));
					if($first_line) {
						$line = $this->no_bom($line); /* remove BOM from 1st line */
						$first_line = false;
					}
				} while(trim($line) === '' && $line !== false);

				if(false === $line) { fclose($fp); return array(); } /* EOF before $start */
			}

			/* keep reading data from csv file till data size limit or EOF is reached */
			$csv_data = array(); $raw_data = '';
			do {
				$data = fgetcsv($fp, pow(2, 15), $settings['field_separator'], $settings['field_delimiter']);
				if($data === false) { fclose($fp); return $csv_data; } /* EOF */

				if($first_line) {
					$data[0] = $this->no_bom($data[0]); /* remove BOM if 1st line */
					$data[0] = trim($data[0], $settings['field_delimiter']); /* fix fgetcsv behavior with BOM */
					$first_line = false;
				}
				if(count($data) == 1 && !$data[0]) continue; /* empty line */

				/* handle ignored fields */
				$last_key = max($last_field_key, count($data) - 1);
				for($i = 0; $i <= $last_key; $i++) {
					if(!isset($data[$i])) $data[$i] = '';
					if(!isset($settings['mappings'][$i])) unset($data[$i]);
				}

				$raw_data .= implode('', $data);
				$csv_data[] = $data;
			} while(strlen($raw_data) < $this->max_data_length && count($csv_data) < $this->max_batch_size);

			fclose($fp);
			return $csv_data;
		}

		/**
		 *  @brief Prepare the insert/replace query
		 *  
		 *  @param [in] $csv_data 2D numeric array of data to insert/replace
		 *  @param [in] $settings import settings assoc. array
		 *  @param [in,out] $query_info assoc array for exchanging query info and options
		 *  @return query string on success, false on error
		 */
		protected function get_query(&$csv_data, $settings, &$query_info) {
			/* make sure table name is provided */
			$table = $this->get_table(true);
			if($table === false) {
				$query_info['error'] = $this->lang['no table name provided'] . $this->debug(__LINE__, false);
				return false;
			}
			$stable = makeSafe($table);

			/* make sure mappings are provided */
			if(!isset($settings['mappings']) || !is_array($settings['mappings']) || !count($settings['mappings'])) {
				$query_info['error'] = $this->lang['error reading csv data'] . $this->debug(__LINE__, false);
				return false;
			}

			/* replace or insert? */
			$query = "INSERT IGNORE INTO ";
			if(isset($settings['update_pk']) && $settings['update_pk'] === true) {
				$query = "REPLACE ";
			}
			$query .= "`{$stable}` ";

			/* use mappings to determine field names */
			$query .= '(`' . implode('`,`', $settings['mappings']) . '`) VALUES ';

			/* build query data */
			$insert_data = array();
			foreach($csv_data as $rec) {
				/* sanitize data for SQL */
				foreach($rec as $i => $item) {
					$rec[$i] = "'" . makeSafe($item, false) . "'";
					if($item === '') $rec[$i] = 'NULL';
				}

				$insert_data[] = '(' . implode(',', $rec) . ')';
			}
			$query .= implode(",\n", $insert_data);

			return $query;
		}

		/**
		 *  get/set the next start of current csv file
		 *  
		 *  @param $start optional, new start value to save into status file
		 *  @return array('error' => error message) or array('start' => start line)
		 */
		protected function start($new_start = false) {
			$csv = $this->get_csv();
			if(!$csv) {
				/* invalid csv file specified */
				return array('error' => $this->debug(__LINE__, false) . $this->lang['csv file upload error']);
			}

			/*
				store progress server-side:
				for each csv file being imported, create a status file in the csv folder named {csv-file-name.csv.status}
				the file stores the last imported line#.
			*/
			$status_file = $this->csv_path($csv) . '.status';
			if(!is_file($status_file)) {
				/* this is a new import process */
				/* create a status file and store $new_start into it */
				@file_put_contents($status_file, $new_start);
			}

			if($new_start !== false && intval($new_start) >= 0) {
				@file_put_contents($status_file, intval($new_start));
				return array('start' => intval($new_start));
			}

			$start = @file_get_contents($status_file);
			if(false === $start) {
				/* can't read file */
				return array('error' => $this->debug(__LINE__, false) . $this->lang['csv file upload error']);
			}

			return array('start' => intval($start));
		}

		/**
		 *  @brief UTF8-encodes a string/array
		 *  @see https://stackoverflow.com/a/26760943/1945185
		 *  
		 *  @param [in] $mixed string or array of strings to be UTF8-encoded
		 *  @return UTF8-encoded array/string
		 */
		protected function utf8ize($mixed) {
			if(!is_array($mixed)) return to_utf8($mixed);

			foreach($mixed as $key => $value) {
				$mixed[$key] = $this->utf8ize($value);
			}
			return $mixed;
		}
	}
