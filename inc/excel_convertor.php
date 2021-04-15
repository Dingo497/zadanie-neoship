<?php

include_once'classes/excel_converting.php';
include_once'classes/get_recipient_data.php';


	// import phpspreadsheetu
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_POST['submit_import'])) {

	$convert = new excel_convert($_FILES['import_file']['name'], $_FILES['import_file']['tmp_name']);
	$array = $convert->right_array();

	$recipient_data = new get_recipient_data($array);
	$final_array = $recipient_data->result_data();

	if ($final_array) {
		session_start();
		$_SESSION['final_array'] = $final_array;
		header("location: ../index.php?error=none");
		exit();
	}else{
		header("location: ../index.php?error=somethingwrong");
		exit();
	}

}