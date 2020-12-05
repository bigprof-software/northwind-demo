<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'products';

		/* data for selected record, or defaults if none is selected */
		var data = {
			SupplierID: <?php echo json_encode(array('id' => $rdata['SupplierID'], 'value' => $rdata['SupplierID'], 'text' => $jdata['SupplierID'])); ?>,
			CategoryID: <?php echo json_encode(array('id' => $rdata['CategoryID'], 'value' => $rdata['CategoryID'], 'text' => $jdata['CategoryID'])); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for SupplierID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'SupplierID' && d.id == data.SupplierID.id)
				return { results: [ data.SupplierID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for CategoryID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'CategoryID' && d.id == data.CategoryID.id)
				return { results: [ data.CategoryID ], more: false, elapsed: 0.01 };
			return false;
		});

		cache.start();
	});
</script>

