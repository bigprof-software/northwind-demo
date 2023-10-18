<?php
	/**
	 * Basic script to perform global search on all tables of an AppGini application
	 * Related post: https://forums.appgini.com/phpbb/viewtopic.php?f=2&t=1689&p=4510
	 */

	/* Assuming this custom file is placed inside 'hooks' */
	define('PREPEND_PATH', '../');
	$hooks_dir = dirname(__FILE__);
	include("{$hooks_dir}/../defaultLang.php");
	include("{$hooks_dir}/../language.php");
	include("{$hooks_dir}/../lib.php");
	
	include_once("{$hooks_dir}/../header.php");
	
	/* check access: modify this part according to who you want to allow to access this page */
	$mi = getMemberInfo();
	// if(!in_array($mi['username'], array('john.doe', 'jane.doe'))){
	// if(!$mi['username'] || $mi['username'] == 'guest'){
	if(!in_array($mi['group'], array('Admins', 'Data entry'))){
		echo error_message("Access denied");
		include_once("{$hooks_dir}/../footer.php");
		exit;
	}
	
	$search = $_REQUEST['search'];
	echo show_search_form($search);
	$results = process_search($search);
	echo render_search_results($results);

	include_once("{$hooks_dir}/../footer.php");


	/* function to display search form */
	function show_search_form($search = ''){
		ob_start();
		?>
		<div class="page-header"><h1>Global Search</h1></div>
		<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-2">
					<input type="text" class="form-control" id="search" 
						name="search" placeholder="What are you looking for?" 
						value="<?php echo html_attr($search); ?>"
						style="font-size: 2em;"
						autofocus>
				</div>
				<div class="col-sm-2">
					<button style="font-size: 2em;" type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-search"></i> Search</button>
				</div>
			</div>
		</form>
		<?php
		return ob_get_clean();
	}

	/* function to process search */
	function process_search($search = ''){
		if(!$search) return false;
		
		/* get tables accessible by current user */
		$tables = getTableList();
		if(!count($tables)) return false;
		
		/* perform search */
		$results = array();
		foreach($tables as $tn => $tdata){
			$res = sql(get_search_query($tn, $search), $eo);
			while($row = db_fetch_assoc($res)){
				$results[$tn][] = array(
					'id' => $row['PRIMARY_KEY_VALUE'],
					'record' => array_slice($row, 1, NULL, true)
				);
			}
		}
		
		return $results;
	}

	/* function to render search results */
	function render_search_results($results, $search = ''){
		if(!count($results) || !$results) return '';
		
		$tables = getTableList();
		
		$html = '<h2>Showing matches from ' . count($results) . ' tables</h2>';
		foreach($results as $tn => $tres){
			if(!count($tres)) continue;
			
			ob_start();
			?>
			<button type="button" class="btn btn-info btn-lg vspacer-lg">
				<?php echo $tables[$tn][0]; ?>
				<span class="badge"><?php echo count($tres); ?></span>
			</button>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th></th>
							<?php foreach($tres[0]['record'] as $label => $v){ ?>
								<th><?php echo $label; ?></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tres as $rec){ ?>
							<?php $link = "../{$tn}_view.php?SelectedID=" . urlencode($rec['id']); ?>
							<tr>
								<td><a href="<?php echo $link; ?>" class="btn btn-default" target="_blank"><i class="glyphicon glyphicon-search"></i></a></td>
								<?php foreach($rec['record'] as $v){ ?>
									<td><?php echo $v; ?></td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<?php
			$html .= ob_get_clean();
		}
		
		return $html;
	}

	/* function to get a list of query fields of a given table */
	function list_of_fields($tn){
		$fields = preg_split('/ as \'.*?\',? ?/', get_sql_fields($tn));
		if(!count($fields) || $fields === false) return false;

		array_pop($fields); // remove last element as it's an empty string
		return $fields;
	}

	/* function to prepare search query */
	function get_search_query($tn, $search){
		if(!$search) return false;
		$fields = list_of_fields($tn);
		if(!$fields) return false;
		
		$safe_search = makeSafe($search);
		$where = " AND CONCAT_WS('||', " . implode(', ', $fields) . ") LIKE '%{$safe_search}%'";
		$pk = "`{$tn}`.`" . getPKFieldName($tn) . "` as 'PRIMARY_KEY_VALUE'";
		$query = "SELECT {$pk}, " . get_sql_fields($tn) . " FROM " . get_sql_from($tn) . $where;
		
		return $query;
	}