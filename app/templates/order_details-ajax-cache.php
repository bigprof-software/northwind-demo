<?php
	$rdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $rdata)));
	$jdata = array_map('to_utf8', array_map('nl2br', array_map('html_attr_tags_ok', $jdata)));
?>
<script>
	$j(function() {
		var tn = 'order_details';

		/* data for selected record, or defaults if none is selected */
		var data = {
			OrderID: <?php echo json_encode(array('id' => $rdata['OrderID'], 'value' => $rdata['OrderID'], 'text' => $jdata['OrderID'])); ?>,
			ProductID: <?php echo json_encode(array('id' => $rdata['ProductID'], 'value' => $rdata['ProductID'], 'text' => $jdata['ProductID'])); ?>,
			Category: <?php echo json_encode($jdata['Category']); ?>,
			CatalogPrice: <?php echo json_encode($jdata['CatalogPrice']); ?>,
			UnitsInStock: <?php echo json_encode($jdata['UnitsInStock']); ?>
		};

		/* initialize or continue using AppGini.cache for the current table */
		AppGini.cache = AppGini.cache || {};
		AppGini.cache[tn] = AppGini.cache[tn] || AppGini.ajaxCache();
		var cache = AppGini.cache[tn];

		/* saved value for OrderID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'OrderID' && d.id == data.OrderID.id)
				return { results: [ data.OrderID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ProductID */
		cache.addCheck(function(u, d) {
			if(u != 'ajax_combo.php') return false;
			if(d.t == tn && d.f == 'ProductID' && d.id == data.ProductID.id)
				return { results: [ data.ProductID ], more: false, elapsed: 0.01 };
			return false;
		});

		/* saved value for ProductID autofills */
		cache.addCheck(function(u, d) {
			if(u != tn + '_autofill.php') return false;

			for(var rnd in d) if(rnd.match(/^rnd/)) break;

			if(d.mfk == 'ProductID' && d.id == data.ProductID.id) {
				$j('#Category' + d[rnd]).html(data.Category);
				$j('#CatalogPrice' + d[rnd]).html(data.CatalogPrice);
				$j('#UnitsInStock' + d[rnd]).html(data.UnitsInStock);
				return true;
			}

			return false;
		});

		cache.start();
	});
</script>

