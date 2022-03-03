<?php
// This script and data application were generated by AppGini 22.12
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');

	handle_maintenance();

	header('Content-type: text/javascript; charset=' . datalist_db_encoding);

	$table_perms = getTablePermissions('orders');
	if(!$table_perms['access']) die('// Access denied!');

	$mfk = Request::val('mfk');
	$id = makeSafe(Request::val('id'));
	$rnd1 = intval(Request::val('rnd1')); if(!$rnd1) $rnd1 = '';

	if(!$mfk) {
		die('// No js code available!');
	}

	switch($mfk) {

		case 'CustomerID':
			if(!$id) {
				?>
				$j('#ShipName<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipAddress<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipCity<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipRegion<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipPostalCode<?php echo $rnd1; ?>').html('&nbsp;');
				$j('#ShipCountry<?php echo $rnd1; ?>').html('&nbsp;');
				<?php
				break;
			}
			$res = sql("SELECT `customers`.`CustomerID` as 'CustomerID', `customers`.`CompanyName` as 'CompanyName', `customers`.`ContactName` as 'ContactName', `customers`.`ContactTitle` as 'ContactTitle', `customers`.`Address` as 'Address', `customers`.`City` as 'City', `customers`.`Region` as 'Region', `customers`.`PostalCode` as 'PostalCode', `customers`.`Country` as 'Country', `customers`.`Phone` as 'Phone', `customers`.`Fax` as 'Fax', `customers`.`TotalSales` as 'TotalSales' FROM `customers`  WHERE `customers`.`CustomerID`='{$id}' limit 1", $eo);
			$row = db_fetch_assoc($res);
			?>
			$j('#ShipName<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['CompanyName']))); ?>&nbsp;');
			$j('#ShipAddress<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['Address']))); ?>&nbsp;');
			$j('#ShipCity<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['City']))); ?>&nbsp;');
			$j('#ShipRegion<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['Region']))); ?>&nbsp;');
			$j('#ShipPostalCode<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['PostalCode']))); ?>&nbsp;');
			$j('#ShipCountry<?php echo $rnd1; ?>').html('<?php echo addslashes(str_replace(["\r", "\n"], '', safe_html($row['Country']))); ?>&nbsp;');
			<?php
			break;


	}

?>