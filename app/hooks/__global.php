<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function login_ok($memberInfo, &$args) {

		return '';
	}

	function login_failed($attempt, &$args) {

	}

	function member_activity($memberInfo, $activity, &$args) {
		switch($activity) {
			case 'pending':
				break;

			case 'automatic':
				break;

			case 'profile':
				break;

			case 'password':
				break;

		}
	}

	function sendmail_handler(&$pm) {

	}

	/* custom log function */
	function app_log($msg) {
		if(!count($_REQUEST)) return;
		$log_file = dirname(__FILE__) . '/sql.log';
		@file_put_contents($log_file, 
			"-----\n" . 
			substr(md5(implode('', $_REQUEST)), 0, 10) . "\n" .
			json_encode($_REQUEST) . "\n" .
			date('H:i:s') . "\n" .
			"{$msg}\n", 
		FILE_APPEND);

	}