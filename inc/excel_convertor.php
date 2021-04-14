<?php

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

include_once'classes/excel_converting.php';
include_once'classes/get_recipient_data.php';

	// import phpspreadsheetu
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['submit_import'])) {
	$convert = new excel_convert($_FILES['import_file']['name'], $_FILES['import_file']['tmp_name']);
	$array = $convert->right_array();

	include_once'counting.php';

}