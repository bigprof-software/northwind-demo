<?php
	define('TESTING_MODE', false); // set to true to see the generated queries instead of executing them
    define('PREPEND_PATH', '../');
    define('APP_ROOT', dirname(__DIR__) . '/');
	include(APP_ROOT . 'lib.php');

	// find most recent employee birth date
	$employee_birth_date = sqlValue("SELECT MAX(BirthDate) FROM `employees`");

	// if that employee is already 26 years old or younger, then we don't need to do anything
	if (floor((time() - strtotime($employee_birth_date)) / (365 * 24 * 60 * 60)) <= 26) {
		exit;
	}

	// figure out how many years we need to add to make that emploee 26 years old
	$years_to_add = floor((time() - strtotime($employee_birth_date)) / (365 * 24 * 60 * 60)) - 26;

	$queries = [];

	// update all employee birth dates by adding the number of years we just calculated
	$queries[] = "UPDATE `employees` SET BirthDate = DATE_ADD(BirthDate, INTERVAL $years_to_add YEAR)";

	// find most recent hire date
	$employee_hire_date = sqlValue("SELECT MAX(HireDate) FROM `employees`");

	// figure out how many years we need to add to make that emploee have 1 year of service
	$years_to_add = floor((time() - strtotime($employee_hire_date)) / (365 * 24 * 60 * 60)) - 1;

	// update all employee hire dates by adding the number of years we just calculated
	$queries[] = "UPDATE `employees` SET HireDate = DATE_ADD(HireDate, INTERVAL $years_to_add YEAR)";

	// find most recent order date
	$order_date = sqlValue("SELECT MAX(OrderDate) FROM `orders`");
	// figure out how many days we need to add to make that order one week old
	$days_to_add = floor((time() - strtotime($order_date)) / (24 * 60 * 60)) - 7;
	// update all order dates by adding the number of days we just calculated
	$queries[] = "UPDATE `orders` SET OrderDate = DATE_ADD(OrderDate, INTERVAL $days_to_add DAY)";
	// also update RequiredDate by the same number of days if present
	$queries[] = "UPDATE `orders` SET RequiredDate = DATE_ADD(RequiredDate, INTERVAL $days_to_add DAY) WHERE RequiredDate IS NOT NULL";
	// also update ShippedDate by the same number of days if present
	$queries[] = "UPDATE `orders` SET ShippedDate = DATE_ADD(ShippedDate, INTERVAL $days_to_add DAY) WHERE ShippedDate IS NOT NULL";

	// log queries for testing (as json response)
	if (TESTING_MODE) {
		header('Content-Type: application/json');
		echo json_encode($queries);
		exit;
	}

	// log queries for testing (as text response)
	foreach ($queries as $query) {
		echo $query . "\n";
	}
