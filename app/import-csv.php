<?php
	define('PREPEND_PATH', '');
	$app_dir = dirname(__FILE__);
	include_once("{$app_dir}/lib.php");

	// accept a record as an assoc array, return transformed row ready to insert to table
	$transformFunctions = [
		'customers' => function($data, $options = []) {

			return $data;
		},
		'employees' => function($data, $options = []) {
			if(isset($data['BirthDate'])) $data['BirthDate'] = guessMySQLDateTime($data['BirthDate']);
			if(isset($data['HireDate'])) $data['HireDate'] = guessMySQLDateTime($data['HireDate']);
			if(isset($data['ReportsTo'])) $data['ReportsTo'] = pkGivenLookupText($data['ReportsTo'], 'employees', 'ReportsTo');

			return $data;
		},
		'orders' => function($data, $options = []) {
			if(isset($data['CustomerID'])) $data['CustomerID'] = pkGivenLookupText($data['CustomerID'], 'orders', 'CustomerID');
			if(isset($data['EmployeeID'])) $data['EmployeeID'] = pkGivenLookupText($data['EmployeeID'], 'orders', 'EmployeeID');
			if(isset($data['OrderDate'])) $data['OrderDate'] = guessMySQLDateTime($data['OrderDate']);
			if(isset($data['RequiredDate'])) $data['RequiredDate'] = guessMySQLDateTime($data['RequiredDate']);
			if(isset($data['ShippedDate'])) $data['ShippedDate'] = guessMySQLDateTime($data['ShippedDate']);
			if(isset($data['ShipVia'])) $data['ShipVia'] = pkGivenLookupText($data['ShipVia'], 'orders', 'ShipVia');
			if(isset($data['ShipName'])) $data['ShipName'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipName'], 'orders', 'ShipName'));
			if(isset($data['ShipAddress'])) $data['ShipAddress'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipAddress'], 'orders', 'ShipAddress'));
			if(isset($data['ShipCity'])) $data['ShipCity'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipCity'], 'orders', 'ShipCity'));
			if(isset($data['ShipRegion'])) $data['ShipRegion'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipRegion'], 'orders', 'ShipRegion'));
			if(isset($data['ShipPostalCode'])) $data['ShipPostalCode'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipPostalCode'], 'orders', 'ShipPostalCode'));
			if(isset($data['ShipCountry'])) $data['ShipCountry'] = thisOr($data['CustomerID'], pkGivenLookupText($data['ShipCountry'], 'orders', 'ShipCountry'));

			return $data;
		},
		'order_details' => function($data, $options = []) {
			if(isset($data['OrderID'])) $data['OrderID'] = pkGivenLookupText($data['OrderID'], 'order_details', 'OrderID');
			if(isset($data['ProductID'])) $data['ProductID'] = pkGivenLookupText($data['ProductID'], 'order_details', 'ProductID');
			if(isset($data['UnitPrice'])) $data['UnitPrice'] = preg_replace('/[^\d\.]/', '', $data['UnitPrice']);
			if(isset($data['Discount'])) $data['Discount'] = preg_replace('/[^\d\.]/', '', $data['Discount']);
			if(isset($data['Category'])) $data['Category'] = thisOr($data['ProductID'], pkGivenLookupText($data['Category'], 'order_details', 'Category'));
			if(isset($data['CatalogPrice'])) $data['CatalogPrice'] = thisOr($data['ProductID'], pkGivenLookupText($data['CatalogPrice'], 'order_details', 'CatalogPrice'));
			if(isset($data['UnitsInStock'])) $data['UnitsInStock'] = thisOr($data['ProductID'], pkGivenLookupText($data['UnitsInStock'], 'order_details', 'UnitsInStock'));

			return $data;
		},
		'products' => function($data, $options = []) {
			if(isset($data['SupplierID'])) $data['SupplierID'] = pkGivenLookupText($data['SupplierID'], 'products', 'SupplierID');
			if(isset($data['CategoryID'])) $data['CategoryID'] = pkGivenLookupText($data['CategoryID'], 'products', 'CategoryID');
			if(isset($data['UnitPrice'])) $data['UnitPrice'] = preg_replace('/[^\d\.]/', '', $data['UnitPrice']);

			return $data;
		},
		'categories' => function($data, $options = []) {

			return $data;
		},
		'suppliers' => function($data, $options = []) {

			return $data;
		},
		'shippers' => function($data, $options = []) {

			return $data;
		},
	];

	// accept a record as an assoc array, return a boolean indicating whether to import or skip record
	$filterFunctions = [
		'customers' => function($data, $options = []) { return true; },
		'employees' => function($data, $options = []) { return true; },
		'orders' => function($data, $options = []) { return true; },
		'order_details' => function($data, $options = []) { return true; },
		'products' => function($data, $options = []) { return true; },
		'categories' => function($data, $options = []) { return true; },
		'suppliers' => function($data, $options = []) { return true; },
		'shippers' => function($data, $options = []) { return true; },
	];

	/*
	Hook file for overwriting/amending $transformFunctions and $filterFunctions:
	hooks/import-csv.php
	If found, it's included below

	The way this works is by either completely overwriting any of the above 2 arrays,
	or, more commonly, overwriting a single function, for example:
		$transformFunctions['tablename'] = function($data, $options = []) {
			// new definition here
			// then you must return transformed data
			return $data;
		};

	Another scenario is transforming a specific field and leaving other fields to the default
	transformation. One possible way of doing this is to store the original transformation function
	in GLOBALS array, calling it inside the custom transformation function, then modifying the
	specific field:
		$GLOBALS['originalTransformationFunction'] = $transformFunctions['tablename'];
		$transformFunctions['tablename'] = function($data, $options = []) {
			$data = call_user_func_array($GLOBALS['originalTransformationFunction'], [$data, $options]);
			$data['fieldname'] = 'transformed value';
			return $data;
		};
	*/

	@include("{$app_dir}/hooks/import-csv.php");

	$ui = new CSVImportUI($transformFunctions, $filterFunctions);
