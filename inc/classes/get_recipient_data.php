<?php

class base_get_recipient_data {

	public function get_country(){
		null;
	}

	public function get_delivery_cash(){
		null;
	}

	public function get_weight(){
		null;
	}

	public function get_extras(){
		null;
	} 

}



class get_recipient_data extends base_get_recipient_data {
	private $array;
	private $rec_country;
	private $rec_weight;

//	Na priradenie array do classy
	function __construct($array) {
		$this->array = $array;
	}


//	Na vypocet ci sa cislo nachadza medzi min a max
	function get_minMax($a, $min, $max) {
		if ($min <= $a && $a <= $max) {
			return true;
		}
	}


//	Na priradenie novej hodnoty do zakladneho array zasielok
	function set_new_value($what, $where, $value){
		$this->array[$what][$where] = $this->array[$what][$where] = $value;
	}


//	Na vypocet zlavy z prepravy velkeho balika
	function discount_maxKg($kg){
		$x = $kg * 0.6;
		$result = $x / 2;
		return $result;
	}


//	Na vypocet ceny prepravy balika
	function SK_shipping() {
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Slovenská republika [SK]') {
				$rec_weight = $value['váha'];
				if ($this->get_minMax($rec_weight, 0.00, 3.00)) {
					$this->set_new_value($key, 'shipping', 2.47);
				}
				if ($this->get_minMax($rec_weight, 3.01, 5.00)) {
					$this->set_new_value($key, 'shipping', 2.53);
				}
				if ($this->get_minMax($rec_weight, 5.01, 10.00)) {
					$this->set_new_value($key, 'shipping', 2.63);
				}
				if ($this->get_minMax($rec_weight, 10.01, 15.00)) {
					$this->set_new_value($key, 'shipping', 2.96);
				}
				if ($this->get_minMax($rec_weight, 15.01, 20.00)) {
					$this->set_new_value($key, 'shipping', 3.49);
				}
				if ($this->get_minMax($rec_weight, 20.01, 25.00)) {
					$this->set_new_value($key, 'shipping', 4.57);
				}
				if ($this->get_minMax($rec_weight, 25.01, 30.00)) {
					$this->set_new_value($key, 'shipping', 5.11);
				}
				if ($this->get_minMax($rec_weight, 30.01, 40.00)) {
					$this->set_new_value($key, 'shipping', 6.24);
				}
				if ($this->get_minMax($rec_weight, 40.01, 50.00)) {
					$this->set_new_value($key, 'shipping', 7.31);
				}
				if ($this->get_minMax($rec_weight, 50.01, 60.00)) {
					$this->set_new_value($key, 'shipping', 9.57);
				}
				if ($this->get_minMax($rec_weight, 60.01, 70.00)) {
					$this->set_new_value($key, 'shipping', 11.93);
				}
				if ($this->get_minMax($rec_weight, 70.01, 999.99)) {
					$discount = $this->discount_maxKg($rec_weight);
					$this->set_new_value($key, 'shipping', $discount);
				}
			}
		}
	}


//	Ci ma v zasielke dobierku na SK ak ano daj jej poplatok
	function SK_shipping_cash(){
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Slovenská republika [SK]' && $value['dobierka'] == true) {
				if ($this->get_minMax($value['dobierka'], 0.01, 3300.00)) {
					$this->set_new_value($key, 'cash on delivery', 0.6);
				}
			}
		}
	}


	function SK_shipping_extras(){
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Slovenská republika [SK]') {
				if ($value['príplatky'] == 'ZM') {
					$this->set_new_value($key, 'extras', 3.49);
				}
				if ($value['príplatky'] == 'TsN') {
					$this->set_new_value($key, 'extras', 3.49);
				}
			}
		}
	}


	function total_withoutDPH(){
		foreach ($this->array as $key => $value) {
			$result = $value['shipping'] + $value['extras'] + $value['cash on delivery'];
			$this->set_new_value($key, 'total without DPH', $result);
		}
	}


	function total_withDPH(){
		foreach ($this->array as $key => $value) {
			$result = ($value['total without DPH'] / 100) * 20 + $value['total without DPH'];
			$this->set_new_value($key, 'total with DPH', $result);
		}
	}


	function total_withDPH_and_package(){
		foreach ($this->array as $key => $value) {
			$cash_DPH = ($value['dobierka']  / 100) * 20 + $value['dobierka'];
			$result = $value['total with DPH'] + $cash_DPH;
			$this->set_new_value($key, 'total with DPH and package', $result);
		}
	}


	function result_data(){
		$this->SK_shipping();
		$this->SK_shipping_cash();
		$this->SK_shipping_extras();
		$this->total_withoutDPH();
		$this->total_withDPH();
		$this->total_withDPH_and_package();
		return $this->array;
	}

}