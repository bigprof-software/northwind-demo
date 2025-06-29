<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/products.php');
	include_once(__DIR__ . '/products_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('products');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'products';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`products`.`ProductID`" => "ProductID",
		"`products`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`suppliers1`.`CompanyName`), CONCAT_WS('',   `suppliers1`.`CompanyName`), '') /* Supplier */" => "SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "CategoryID",
		"`products`.`QuantityPerUnit`" => "QuantityPerUnit",
		"CONCAT('$', FORMAT(`products`.`UnitPrice`, 2))" => "UnitPrice",
		"`products`.`UnitsInStock`" => "UnitsInStock",
		"`products`.`UnitsOnOrder`" => "UnitsOnOrder",
		"`products`.`ReorderLevel`" => "ReorderLevel",
		"concat('<i class=\"glyphicon glyphicon-', if(`products`.`Discontinued`, 'check', 'unchecked'), '\"></i>')" => "Discontinued",
		"`products`.`TotalSales`" => "TotalSales",
		"`products`.`TechSheet`" => "TechSheet",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`products`.`ProductID`',
		2 => 2,
		3 => '`suppliers1`.`CompanyName`',
		4 => '`categories1`.`CategoryName`',
		5 => 5,
		6 => '`products`.`UnitPrice`',
		7 => '`products`.`UnitsInStock`',
		8 => '`products`.`UnitsOnOrder`',
		9 => '`products`.`ReorderLevel`',
		10 => '`products`.`Discontinued`',
		11 => '`products`.`TotalSales`',
		12 => 12,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`products`.`ProductID`" => "ProductID",
		"`products`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`suppliers1`.`CompanyName`), CONCAT_WS('',   `suppliers1`.`CompanyName`), '') /* Supplier */" => "SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "CategoryID",
		"`products`.`QuantityPerUnit`" => "QuantityPerUnit",
		"CONCAT('$', FORMAT(`products`.`UnitPrice`, 2))" => "UnitPrice",
		"`products`.`UnitsInStock`" => "UnitsInStock",
		"`products`.`UnitsOnOrder`" => "UnitsOnOrder",
		"`products`.`ReorderLevel`" => "ReorderLevel",
		"`products`.`Discontinued`" => "Discontinued",
		"`products`.`TotalSales`" => "TotalSales",
		"`products`.`TechSheet`" => "TechSheet",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`products`.`ProductID`" => "Product ID",
		"`products`.`ProductName`" => "Product Name",
		"IF(    CHAR_LENGTH(`suppliers1`.`CompanyName`), CONCAT_WS('',   `suppliers1`.`CompanyName`), '') /* Supplier */" => "Supplier",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "Category",
		"`products`.`QuantityPerUnit`" => "Quantity Per Unit",
		"`products`.`UnitPrice`" => "Unit Price",
		"`products`.`UnitsInStock`" => "Units In Stock",
		"`products`.`UnitsOnOrder`" => "Units On Order",
		"`products`.`ReorderLevel`" => "Reorder Level",
		"`products`.`Discontinued`" => "Discontinued",
		"`products`.`TotalSales`" => "Total Sales",
		"`products`.`TechSheet`" => "Technical Sheet",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`products`.`ProductID`" => "ProductID",
		"`products`.`ProductName`" => "ProductName",
		"IF(    CHAR_LENGTH(`suppliers1`.`CompanyName`), CONCAT_WS('',   `suppliers1`.`CompanyName`), '') /* Supplier */" => "SupplierID",
		"IF(    CHAR_LENGTH(`categories1`.`CategoryName`), CONCAT_WS('',   `categories1`.`CategoryName`), '') /* Category */" => "CategoryID",
		"`products`.`QuantityPerUnit`" => "QuantityPerUnit",
		"CONCAT('$', FORMAT(`products`.`UnitPrice`, 2))" => "UnitPrice",
		"`products`.`UnitsInStock`" => "UnitsInStock",
		"`products`.`UnitsOnOrder`" => "UnitsOnOrder",
		"`products`.`ReorderLevel`" => "ReorderLevel",
		"concat('<i class=\"glyphicon glyphicon-', if(`products`.`Discontinued`, 'check', 'unchecked'), '\"></i>')" => "Discontinued",
		"`products`.`TotalSales`" => "TotalSales",
		"`products`.`TechSheet`" => "TechSheet",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['SupplierID' => 'Supplier', 'CategoryID' => 'Category', ];

	$x->QueryFrom = "`products` LEFT JOIN `suppliers` as suppliers1 ON `suppliers1`.`SupplierID`=`products`.`SupplierID` LEFT JOIN `categories` as categories1 ON `categories1`.`CategoryID`=`products`.`CategoryID` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = (getLoggedAdmin() !== false);
	$x->AllowAdminShowSQL = showSQL();
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'products_view.php';
	$x->TableTitle = 'Products';
	$x->TableIcon = 'resources/table_icons/handbag.png';
	$x->PrimaryKey = '`products`.`ProductID`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [250, 200, 120, 150, 70, 100, 150, 100, ];
	$x->ColCaption = ['Product Name', 'Supplier', 'Category', 'Quantity Per Unit', 'Unit Price', 'Discontinued', 'Total Sales', 'Orders for this product', ];
	$x->ColFieldName = ['ProductName', 'SupplierID', 'CategoryID', 'QuantityPerUnit', 'UnitPrice', 'Discontinued', 'TotalSales', '%order_details.ProductID%', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 10, 11, -1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/products_templateTV.html';
	$x->SelectedTemplate = 'templates/products_templateTVS.html';
	$x->TemplateDV = 'templates/products_templateDV.html';
	$x->TemplateDVP = 'templates/products_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: products_init
	$render = true;
	if(function_exists('products_init')) {
		$args = [];
		$render = products_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: products_header
	$headerCode = '';
	if(function_exists('products_header')) {
		$args = [];
		$headerCode = products_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php');
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: products_footer
	$footerCode = '';
	if(function_exists('products_footer')) {
		$args = [];
		$footerCode = products_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php');
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
