<?php
require_once("data/persoondao.class.php");

class PersoonService{
	public function getPersonenOverzicht(){
		$pDAO = new PersoonDAO();
		$personen = $pDAO->getAll();
		return $personen;
	}
}