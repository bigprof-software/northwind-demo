<?php
// This script and data application was generated by AppGini, https://bigprof.com/appgini
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/employees.php');
	include_once(__DIR__ . '/employees_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('employees');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'employees';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`employees`.`EmployeeID`" => "EmployeeID",
		"`employees`.`TitleOfCourtesy`" => "TitleOfCourtesy",
		"`employees`.`Photo`" => "Photo",
		"`employees`.`LastName`" => "LastName",
		"`employees`.`FirstName`" => "FirstName",
		"`employees`.`Title`" => "Title",
		"if(`employees`.`BirthDate`,date_format(`employees`.`BirthDate`,'%m/%d/%Y'),'')" => "BirthDate",
		"if(`employees`.`HireDate`,date_format(`employees`.`HireDate`,'%m/%d/%Y'),'')" => "HireDate",
		"`employees`.`Address`" => "Address",
		"`employees`.`City`" => "City",
		"`employees`.`Region`" => "Region",
		"`employees`.`PostalCode`" => "PostalCode",
		"`employees`.`Country`" => "Country",
		"`employees`.`HomePhone`" => "HomePhone",
		"`employees`.`Extension`" => "Extension",
		"`employees`.`Notes`" => "Notes",
		"IF(    CHAR_LENGTH(`employees1`.`LastName`) || CHAR_LENGTH(`employees1`.`FirstName`), CONCAT_WS('',   `employees1`.`LastName`, ', ', `employees1`.`FirstName`), '') /* ReportsTo */" => "ReportsTo",
		"`employees`.`Age`" => "Age",
		"`employees`.`TotalSales`" => "TotalSales",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`employees`.`EmployeeID`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`employees`.`BirthDate`',
		8 => '`employees`.`HireDate`',
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15,
		16 => 16,
		17 => 17,
		18 => '`employees`.`Age`',
		19 => '`employees`.`TotalSales`',
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`employees`.`EmployeeID`" => "EmployeeID",
		"`employees`.`TitleOfCourtesy`" => "TitleOfCourtesy",
		"`employees`.`Photo`" => "Photo",
		"`employees`.`LastName`" => "LastName",
		"`employees`.`FirstName`" => "FirstName",
		"`employees`.`Title`" => "Title",
		"if(`employees`.`BirthDate`,date_format(`employees`.`BirthDate`,'%m/%d/%Y'),'')" => "BirthDate",
		"if(`employees`.`HireDate`,date_format(`employees`.`HireDate`,'%m/%d/%Y'),'')" => "HireDate",
		"`employees`.`Address`" => "Address",
		"`employees`.`City`" => "City",
		"`employees`.`Region`" => "Region",
		"`employees`.`PostalCode`" => "PostalCode",
		"`employees`.`Country`" => "Country",
		"`employees`.`HomePhone`" => "HomePhone",
		"`employees`.`Extension`" => "Extension",
		"`employees`.`Notes`" => "Notes",
		"IF(    CHAR_LENGTH(`employees1`.`LastName`) || CHAR_LENGTH(`employees1`.`FirstName`), CONCAT_WS('',   `employees1`.`LastName`, ', ', `employees1`.`FirstName`), '') /* ReportsTo */" => "ReportsTo",
		"`employees`.`Age`" => "Age",
		"`employees`.`TotalSales`" => "TotalSales",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`employees`.`EmployeeID`" => "Employee ID",
		"`employees`.`TitleOfCourtesy`" => "Title Of Courtesy",
		"`employees`.`LastName`" => "Last Name",
		"`employees`.`FirstName`" => "First Name",
		"`employees`.`Title`" => "Title",
		"`employees`.`BirthDate`" => "Birth Date",
		"`employees`.`HireDate`" => "Hire Date",
		"`employees`.`Address`" => "Address",
		"`employees`.`City`" => "City",
		"`employees`.`Region`" => "Region",
		"`employees`.`PostalCode`" => "Postal Code",
		"`employees`.`Country`" => "Country",
		"`employees`.`HomePhone`" => "Home Phone",
		"`employees`.`Extension`" => "Extension",
		"`employees`.`Notes`" => "Notes",
		"`employees`.`Age`" => "Age",
		"`employees`.`TotalSales`" => "Total Sales",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`employees`.`EmployeeID`" => "EmployeeID",
		"`employees`.`TitleOfCourtesy`" => "TitleOfCourtesy",
		"`employees`.`LastName`" => "LastName",
		"`employees`.`FirstName`" => "FirstName",
		"`employees`.`Title`" => "Title",
		"if(`employees`.`BirthDate`,date_format(`employees`.`BirthDate`,'%m/%d/%Y'),'')" => "BirthDate",
		"if(`employees`.`HireDate`,date_format(`employees`.`HireDate`,'%m/%d/%Y'),'')" => "HireDate",
		"`employees`.`Address`" => "Address",
		"`employees`.`City`" => "City",
		"`employees`.`Region`" => "Region",
		"`employees`.`PostalCode`" => "PostalCode",
		"`employees`.`Country`" => "Country",
		"`employees`.`HomePhone`" => "HomePhone",
		"`employees`.`Extension`" => "Extension",
		"`employees`.`Notes`" => "Notes",
		"`employees`.`Age`" => "Age",
		"`employees`.`TotalSales`" => "TotalSales",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['ReportsTo' => 'ReportsTo', ];

	$x->QueryFrom = "`employees` LEFT JOIN `employees` as employees1 ON `employees1`.`EmployeeID`=`employees`.`ReportsTo` ";
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
	$x->AllowCSV = 1;
	$x->AllowAdminShowSQL = showSQL();
	$x->RecordsPerPage = 5;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'employees_view.php';
	$x->TableTitle = 'Employees';
	$x->TableIcon = 'resources/table_icons/administrator.png';
	$x->PrimaryKey = '`employees`.`EmployeeID`';
	$x->DefaultSortField = '4';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [60, 100, 100, 200, 100, 120, 150, 150, 150, 100, 100, ];
	$x->ColCaption = ['Photo', 'Last Name', 'First Name', 'Title', 'Hire Date', 'Country', 'ReportsTo', 'Age', 'Total Sales', 'Subordinates', 'Initiated orders', ];
	$x->ColFieldName = ['Photo', 'LastName', 'FirstName', 'Title', 'HireDate', 'Country', 'ReportsTo', 'Age', 'TotalSales', '%employees.ReportsTo%', '%orders.EmployeeID%', ];
	$x->ColNumber  = [3, 4, 5, 6, 8, 13, 17, 18, 19, -1, -1, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/employees_templateTV.html';
	$x->SelectedTemplate = 'templates/employees_templateTVS.html';
	$x->TemplateDV = 'templates/employees_templateDV.html';
	$x->TemplateDVP = 'templates/employees_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = true;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: employees_init
	$render = true;
	if(function_exists('employees_init')) {
		$args = [];
		$render = employees_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: employees_header
	$headerCode = '';
	if(function_exists('employees_header')) {
		$args = [];
		$headerCode = employees_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php');
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: employees_footer
	$footerCode = '';
	if(function_exists('employees_footer')) {
		$args = [];
		$footerCode = employees_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php');
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
