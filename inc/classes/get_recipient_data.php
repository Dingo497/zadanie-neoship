<?php

class base_get_recipient_data {

	public function clear_arr(){
		null;
	}

	public function get_minMax($a, $min, $max) {
		null;
	}

	public function set_new_value($what, $where, $value){
		null;
	}

	public function discount_maxKg($kg){
		null;
	}

	public function SK_shipping() {
		null;
	}

	public function HUCZ_shipping() {
		null;
	}

	public function AT_shipping() {
		null;
	}

	public function SK_shipping_cash(){
		null;
	}

	public function HUCZ_shipping_cash(){
		null;
	}

	public function AT_shipping_cash(){
		null;
	}

	public function shipping_extras($country){
		null;
	}

	public function total_withoutDPH(){
		null;
	}

	public function total_withDPH(){
		null;
	}

	public function total_withDPH_and_package(){
		null;
	}

	public function count_all($what, $where){
		null;
	}

}



class get_recipient_data extends base_get_recipient_data {
	private $array;
	private $rec_country;
	private $rec_weight;
	private $all_array;

//	Na priradenie array do classy
	function __construct($array) {
		$this->array = $array;
	}


//	Ak dostanem z excelu velke cislo tak mi o hodi na string, tu tomu zabranujem
	function clear_arr(){
		foreach ($this->array as $key => $value) {
			$result = str_replace(',', '', $value['dobierka']);
			$this->set_new_value($key, 'dobierka', $result);
			$result = str_replace(',', '', $value['váha']);
			$this->set_new_value($key, 'váha', $result);
		}
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


//	Na vypocet ceny prepravy balika na SK
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


//	Na vypocet ceny prepravy balika v CZ a HU
	function HUCZ_shipping() {
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Česká republika [CZ]' || $value['príjemca-štát'] == 'Maďarská republika [HU]') {
				$rec_weight = $value['váha'];
				if ($this->get_minMax($rec_weight, 0.00, 5.00)) {
					$this->set_new_value($key, 'shipping', 4.35);
				}
				if ($this->get_minMax($rec_weight, 5.01, 10.00)) {
					$this->set_new_value($key, 'shipping', 4.9);
				}
				if ($this->get_minMax($rec_weight, 10.01, 15.00)) {
					$this->set_new_value($key, 'shipping', 6);
				}
				if ($this->get_minMax($rec_weight, 15.01, 20.00)) {
					$this->set_new_value($key, 'shipping', 7.5);
				}
				if ($this->get_minMax($rec_weight, 20.01, 25.00)) {
					$this->set_new_value($key, 'shipping', 8.5);
				}
				if ($this->get_minMax($rec_weight, 25.01, 30.00)) {
					$this->set_new_value($key, 'shipping', 10.10);
				}
				if ($this->get_minMax($rec_weight, 30.01, 40.00)) {
					$this->set_new_value($key, 'shipping', 13.60);
				}
				if ($this->get_minMax($rec_weight, 40.01, 50.00)) {
					$this->set_new_value($key, 'shipping', 16.60);
				}
				if ($this->get_minMax($rec_weight, 50.01, 999.99)) {
					$discount = $this->discount_maxKg($rec_weight);
					$this->set_new_value($key, 'shipping', $discount);
				}
			}
		}
	}


//	Na vypocet ceny prepravy balika v AT
	function AT_shipping() {
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Rakúsko [AT]') {
				$rec_weight = $value['váha'];
				if ($this->get_minMax($rec_weight, 0.00, 3.00)) {
					$this->set_new_value($key, 'shipping', 6.2);
				}
				if ($this->get_minMax($rec_weight, 3.01, 5.00)) {
					$this->set_new_value($key, 'shipping', 6.7);
				}
				if ($this->get_minMax($rec_weight, 5.01, 10.00)) {
					$this->set_new_value($key, 'shipping', 7.2);
				}
				if ($this->get_minMax($rec_weight, 10.01, 15.00)) {
					$this->set_new_value($key, 'shipping', 8.2);
				}
				if ($this->get_minMax($rec_weight, 15.01, 20.00)) {
					$this->set_new_value($key, 'shipping', 9.2);
				}
				if ($this->get_minMax($rec_weight, 20.01, 25.00)) {
					$this->set_new_value($key, 'shipping', 11.2);
				}
				if ($this->get_minMax($rec_weight, 25.01, 30.00)) {
					$this->set_new_value($key, 'shipping', 12.5);
				}
				if ($this->get_minMax($rec_weight, 30.01, 40.00)) {
					$this->set_new_value($key, 'shipping', 15.80);
				}
				if ($this->get_minMax($rec_weight, 40.01, 50.00)) {
					$this->set_new_value($key, 'shipping', 18.50);
				}
				if ($this->get_minMax($rec_weight, 50.01, 999.99)) {
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


//	Ci ma v zasielke dobierku na HU, CZ ak ano daj jej poplatok
	function HUCZ_shipping_cash(){
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Česká republika [CZ]' || $value['príjemca-štát'] == 'Maďarská republika [HU]' && $value['dobierka'] == true) {
				if ($this->get_minMax($value['dobierka'], 0.01, 500.00)) {
					$this->set_new_value($key, 'cash on delivery', 1.6);
				}
				if ($this->get_minMax($value['dobierka'], 500.01, 1000.00)) {
					$this->set_new_value($key, 'cash on delivery', 3.6);
				}
				if ($this->get_minMax($value['dobierka'], 1000.01, 3300.00)) {
					$result = ($value['dobierka'] / 100) * 1.05;
					$this->set_new_value($key, 'cash on delivery', $result);
				}
			}
		}
	}


//	Ci ma v zasielke dobierku na AT ak ano daj jej poplatok
	function AT_shipping_cash(){
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == 'Rakúsko [AT]' && $value['dobierka'] == true) {
				if ($this->get_minMax($value['dobierka'], 0.01, 1000.00)) {
					$this->set_new_value($key, 'cash on delivery', 4.6);
				}
				if ($this->get_minMax($value['dobierka'], 1000.01, 3300.00)) {
					$result = ($value['dobierka'] / 100) * 1.6;
					$this->set_new_value($key, 'cash on delivery', $result);
				}
			}
		}
	}


//	Ci ma v zasielke extra priplatky ak ano pridaj poplatok
	function shipping_extras($country){
		foreach ($this->array as $key => $value) {
			if ($value['príjemca-štát'] == $country) {
				if ($value['príplatky'] == 'ZM') {
					$this->set_new_value($key, 'extras', 3.49);
				}
				if ($value['príplatky'] == 'TsN') {
					$this->set_new_value($key, 'extras', 3.49);
				}
			}
		}
	}


//	Sucet vsetkych poplatkov bez DPH
	function total_withoutDPH(){
		foreach ($this->array as $key => $value) {
			$result = $value['shipping'] + $value['extras'] + $value['cash on delivery'];
			$this->set_new_value($key, 'total without DPH', $result);
		}
	}


//	Sucet vsetkych poplatkov s DPH
	function total_withDPH(){
		foreach ($this->array as $key => $value) {
			$result = ($value['total without DPH'] / 100) * 20 + $value['total without DPH'];
			$this->set_new_value($key, 'total with DPH', $result);
		}
	}


//	Sucet dopravy s poplatkami s DPH s balikom kde priratam DPH cena ktoru zaplati prijemca
	function total_withDPH_and_package(){
		foreach ($this->array as $key => $value) {
			$cash_DPH = ($value['dobierka']  / 100) * 20 + $value['dobierka'];
			$result = $value['total with DPH'] + $cash_DPH;
			$this->set_new_value($key, 'total with DPH and package', $result);
		}
	}

//	Sucet vsetkych zasielok doprava s DPH bez DPH a spolu zasielka
	function count_all($what, $where){
		foreach ($this->array as $key => $value) {
			if (empty($result)) {
				$result = $value[$what];
			}else{
				$result = $result + $value[$what];
			}
		}
		$this->array[$where] = $result;
	}


// result
	function result_data(){
		$this->clear_arr();
		$this->SK_shipping();
		$this->SK_shipping_cash();
		$this->shipping_extras('Slovenská republika [SK]');
		$this->HUCZ_shipping();
		$this->HUCZ_shipping_cash();
		$this->shipping_extras('Maďarská republika [HU]');
		$this->shipping_extras('Česká republika [CZ]');
		$this->AT_shipping();
		$this->AT_shipping_cash();
		$this->shipping_extras('Rakúsko [AT]');
		$this->total_withoutDPH();
		$this->total_withDPH();
		$this->total_withDPH_and_package();
		$this->count_all('total without DPH', 'all without DPH');
		$this->count_all('total with DPH', 'all with DPH');
		$this->count_all('total with DPH and package', 'all');
		return $this->array;
	}

}