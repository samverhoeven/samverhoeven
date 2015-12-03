<?php
class TekstgrootteGenerator{
	public function getTekstgrootte(){
		$tab = array();
		$groter=10;
		for ($i=0; $i < 13; $i++) { 
			$tab[$i]=0;
		}
		for ($i=0; $i < 7; $i++) {
			$tab[$i] = $groter;
			$groter += 10;
		}
		$groter -= 20;
		for ($i=7; $i < 13; $i++) { 
			$tab[$i] = $groter;
			$groter -= 10;
		}
		return $tab;
	}
}