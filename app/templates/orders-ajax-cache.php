<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'orders';

		/* data for selected record, or defaults if none is selected */
		var data = {
			CustomerID: <?php echo json_encode(array('id' => $rdata['CustomerID'], 'value' => $rdata['CustomerID'], 'text' => $jdata['CustomerID'])); ?>,
			EmployeeID: <?php echo json_encode(array('id' => $rdata['EmployeeID'], 'value' => $rdata['EmployeeID'], 'text' => $jdata['EmployeeID'])); ?>,
			ShipVia: <?php echo json_encode(array('id' => $rdata['ShipVia'], 'value' => $rdata['ShipVia'], 'text' => $jdata['ShipVia'])); ?>,
			ShipName: <?php echo json_encode($jdata['ShipName']); ?>,
			ShipAddress: <?php echo json_encode($jdata['ShipAddress']); ?>,
			ShipCity: <?php echo json_encode($jdata['ShipCity']); ?>,
			ShipRegion: <?php echo json_encode($jdata['ShipRegion']); ?>,
			ShipPostalCode: <?php echo json_encode($jdata['ShipPostalCode']); ?>,
			ShipCountry: <?php echo json_encode($jdata['ShipCountry']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for CustomerID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'CustomerID' && d.id == data.CustomerID.id)
				return { results: [ data.CustomerID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for CustomerID autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'CustomerID' && d.id == data.CustomerID.id) {
				$j('#ShipName' + d[rnd]).html(data.ShipName);
				$j('#ShipAddress' + d[rnd]).html(data.ShipAddress);
				$j('#ShipCity' + d[rnd]).html(data.ShipCity);
				$j('#ShipRegion' + d[rnd]).html(data.ShipRegion);
				$j('#ShipPostalCode' + d[rnd]).html(data.ShipPostalCode);
				$j('#ShipCountry' + d[rnd]).html(data.ShipCountry);
				return true;
			}

			return false;
		});

		/* saved value for EmployeeID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'EmployeeID' && d.id == data.EmployeeID.id)
				return { results: [ data.EmployeeID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ShipVia */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ShipVia' && d.id == data.ShipVia.id)
				return { results: [ data.ShipVia ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

