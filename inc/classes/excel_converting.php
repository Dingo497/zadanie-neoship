<?php

class base_excel_convert {

	function take_suffix(){
		null;
	}

	function allowed_suffix(){
		null;
	}

	function convert(){
		null;
	}

	function change_keys(){
		null;
	}

	function right_array(){
		null;
	}

}


class excel_convert extends base_excel_convert {
	private $file_suffixend;
	private $allowed_suffixens = ['xls',  'csv', 'xlsx'];
	private $file_name;
	private $file_tmp;
	private $data_array;
	private $result = [];

//	Zadefinovanie
	function __construct($file_name, $file_tmp){
		$this->file_name = $file_name;
		$this->file_tmp = $file_tmp;
	}

//	Zobratie pripony
	function take_suffix(){
		// zobratie nazvu suboru a nastavenie povolenych koncoviek
		$check = explode('.', $this->file_name);
		$file_suffixend = $check[1];
		$this->file_suffixend 	= $file_suffixend;
	}

//	Zistenie ci je dobra pripona
	function allowed_suffix(){
		if (in_array($this->file_suffixend, $this->allowed_suffixens)) {
			return true;
		}else{
			return false;
		}
	}

//	Konvertnutie z docasneho ulozenia subora do array
	function convert(){
		// Load $take_path to a Spreadsheet object
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->file_tmp);
		$this->data_array = $spreadsheet->getActiveSheet()->toArray();
	}

//	Zmena klucov samotnych zaseliek
	function change_keys(){
		$array = $this->data_array['0'];
		foreach ($this->data_array as $key => $value) {
			array_push($this->result,array_combine($array, $value));
		}
		array_shift($this->result);
	}

//	returne respond
	function right_array(){
		$this->take_suffix();
		if ($this->allowed_suffix() == true) {
			$this->convert();
			$this->change_keys();
			return $this->result;
			exit();
		}else{
			header("location: ../index.php?error=invalidfilesuffix");
			exit();
		}
	}

}





