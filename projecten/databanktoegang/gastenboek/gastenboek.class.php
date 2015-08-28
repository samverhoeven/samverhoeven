<?php
require_once("bericht.class.php");

class Gastenboek {

	private $dbConn;
	private $dbUsername;
	private $dbPassword;
	
	public function __construct() {
		$this->dbConn = "mysql:host=localhost;dbname=cursusphp";
		$this->dbUsername = "cursusgebruiker";
		$this->dbPassword = "cursuspwd";
	}
	
	public function getAlleBerichten() {
		$lijst = array();
		$sql = "select id, auteur, boodschap, datum from gastenboek order by datum desc";
		$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
		$resultSet = $dbh->query($sql);
		foreach ($resultSet as $rij) {
			$bericht = new Bericht($rij["id"], $rij["auteur"], $rij["boodschap"], $rij["datum"]);
			array_push($lijst, $bericht);
		}
		$dbh = null;
		return $lijst;
	}
	
	public function createBericht($auteur, $boodschap) {
		$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
		$datum = date("Y-m-d H:i:s");
		$sql = "insert into gastenboek (auteur, boodschap, datum) values ('$auteur', '$boodschap', '$datum')";
		$dbh->exec($sql);
		$dbh = null;
	}

}