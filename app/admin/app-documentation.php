<?php
	require(__DIR__ . '/incCommon.php');

	$GLOBALS['page_title'] = $Translation['app documentation'];
	include(__DIR__ . '/incHeader.php');
?>
<div class="page-header"><h1><?php echo APP_TITLE . ' ' . $Translation['app documentation']; ?></h1></div>
<div class="row">
	<div class="col-md-3 col-lg-2" id="toc-section">
		<nav class="hidden-print hidden-xs hidden-sm affix">
			<ul class="nav">
				<li>
					<a href="#content-section"><?php echo APP_TITLE; ?></a>
					<ul class="nav">
						<li>
							<a href="#table-customers">Customers</a>
							<ul class="nav">
								<li><a href="#field-customers-TotalSales">Total Sales</a></li>
							</ul>
						</li>
						<li>
							<a href="#table-employees">Employees</a>
							<ul class="nav">
								<li><a href="#field-employees-Age">Age</a></li>
								<li><a href="#field-employees-TotalSales">Total Sales</a></li>
							</ul>
						</li>
						<li>
							<a href="#table-orders">Orders</a>
							<ul class="nav">
								<li><a href="#field-orders-status">Status</a></li>
								<li><a href="#field-orders-total">Total</a></li>
							</ul>
						</li>
						<li>
							<a href="#table-order_details">Order Items</a>
							<ul class="nav">
								<li><a href="#field-order_details-Subtotal">Subtotal</a></li>
							</ul>
						</li>
						<li>
							<a href="#table-shippers">Shippers</a>
							<ul class="nav">
								<li><a href="#field-shippers-NumOrders">Number of orders shipped</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<a class="back-to-top" href="#content-section"><?php echo $Translation['back to top']; ?></a>
		</nav>
	</div>

	<div class="col-md-9 col-lg-8" id="content-section">
		<p class="app-documentation" id="app-title">

This is the Northwind demo app, showing a sample, relatively sophisticated, app that can be created by AppGini.

		</p>

		<h2 class="table-documentation" id="table-customers">Customers</h2>
		<p class="table-documentation">



		</p>

		<h3 class="field-documentation" id="field-customers-TotalSales">Total Sales</h3>
		<p class="field-documentation">

<p>This is an automatically calculated field that uses this SQL query:</p>
<pre>SELECT SUM(`order_details`.`UnitPrice` * `order_details`.`Quantity` - `order_details`.`Discount`) FROM `customers` 
LEFT JOIN `orders` ON `orders`.`CustomerID`=`customers`.`CustomerID` 
LEFT JOIN `order_details` ON `orders`.`OrderID`=`order_details`.`OrderID` 
WHERE `customers`.`CustomerID`='%ID%'</pre>

		</p>
		<h2 class="table-documentation" id="table-employees">Employees</h2>
		<p class="table-documentation">



		</p>

		<h3 class="field-documentation" id="field-employees-Age">Age</h3>
		<p class="field-documentation">

<p>This field is <a href="https://bigprof.com/appgini/help/calculated-fields">Automatically calculated</a>. The SQL query used for calculation is:</p>

<pre>SELECT FLOOR(DATEDIFF(NOW(), `employees`.`BirthDate`) / 365) FROM `employees` 
WHERE `employees`.`EmployeeID`='%ID%'</pre>

<p><code>DATEDIFF</code> returns the difference between 2 dates <i>in days</i>, so we should divide by 365 to get years. Using <code>FLOOR</code> rounds down age to the nearest year ... That is, if someone is 32.4 years old, her age would display as <i>32</i>. Also, if someone is 36.9 years old, she'd show as <i>36</i> years old since she's, technically, not 37 yet ;)</p>

		</p>
		<h3 class="field-documentation" id="field-employees-TotalSales">Total Sales</h3>
		<p class="field-documentation">

<p>This field calculates the total sales made by current employee using this SQL query:</p>

<pre>SELECT SUM(`order_details`.`UnitPrice` * `order_details`.`Quantity` - `order_details`.`Discount`) FROM `employees` 
LEFT JOIN `orders` ON `orders`.`EmployeeID`=`employees`.`EmployeeID` 
LEFT JOIN `order_details` ON `orders`.`OrderID`=`order_details`.`OrderID` 
WHERE `employees`.`EmployeeID`='%ID%'</pre>

		</p>
		<h2 class="table-documentation" id="table-orders">Orders</h2>
		<p class="table-documentation">



		</p>

		<h3 class="field-documentation" id="field-orders-status">Status</h3>
		<p class="field-documentation">

<p>This is a <a href="">calculated field</a> based on the following SQL query</p>
<pre>SELECT
IF(
    `orders`.`ShippedDate`, 
        '&lt;span class="text-success">Shipped&lt;/span>', 
        /* else */
        IF(
           `orders`.`RequiredDate` < now(), 
                '&lt;span class="text-danger">Late&lt;/span>', 
                /* else */
                '&lt;span class="text-warning">Pending&lt;/span>'
        )
) 
FROM `orders` 
WHERE `orders`.`OrderID`='%ID%'</pre>
<p>For late orders, a <span class="text-danger">Late</span> status would be displayed.
For orders not yet shipped, but not late, a <span class="text-warning">Pending</span> status would be displayed.
And for shipped orders, <span class="text-success">Shipped</span> will be displayed.</p>

		</p>
		<h3 class="field-documentation" id="field-orders-total">Total</h3>
		<p class="field-documentation">

<p>This field is <a href="https://bigprof.com/appgini/help/calculated-fields">automatically calculated</a> using the following SQL query:</p>
<pre>SELECT SUM(`order_details`.`UnitPrice` * `order_details`.`Quantity`) + `orders`.`Freight` FROM `orders` 
LEFT JOIN `order_details` ON `order_details`.`OrderID`=`orders`.`OrderID` 
WHERE `orders`.`OrderID`='%ID%'</pre>

		</p>
		<h2 class="table-documentation" id="table-order_details">Order Items</h2>
		<p class="table-documentation">



		</p>

		<h3 class="field-documentation" id="field-order_details-Subtotal">Subtotal</h3>
		<p class="field-documentation">

<p>This field is <a href="https://bigprof.com/appgini/help/calculated-fields">automatically calculated</a> using the following query:</p>

<pre>SELECT `order_details`.`UnitPrice` * `order_details`.`Quantity` - `order_details`.`Discount` FROM `order_details` 
WHERE `order_details`.`odID`='%ID%'</pre>

<p>The formula above calculates the subtotal of this invoice line by multiplying unit price by quantity and then subtracting discount amount.</p>

		</p>
		<h2 class="table-documentation" id="table-shippers">Shippers</h2>
		<p class="table-documentation">



		</p>

		<h3 class="field-documentation" id="field-shippers-NumOrders">Number of orders shipped</h3>
		<p class="field-documentation">

<p>This field is <a href="https://bigprof.com/appgini/help/calculated-fields">Automatically calculated</a>. The SQL query used is:</p>

<pre>SELECT COUNT(1) FROM `shippers` 
LEFT JOIN `orders` ON `orders`.`ShipVia`=`shippers`.`ShipperID` 
WHERE `shippers`.`ShipperID`='%ID%'</pre>

		</p>
	</div>
</div>

<style>
	body { position: relative; }
	#toc-section ul.nav:nth-child(2) {
		margin-left: 1.5em;
	}
	#content-section { border-left: 1px dotted #ddd; padding-top: 6em; }
	h2.table-documentation, h3.field-documentation { padding-top: 3em; }
	#toc-section li.active { font-weight: bold; }
	#toc-section li:not(.active) { font-weight: normal; }
</style>

<script>
	$j(function() {
		$j('body').scrollspy({ target: '#toc-section', offset: 80 });
	})
</script>

<?php
	include(__DIR__ . '/incFooter.php');
