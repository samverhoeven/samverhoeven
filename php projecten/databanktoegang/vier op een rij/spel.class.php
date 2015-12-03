<?php
class Spel {

	private $dbConn;
	private $dbUsername;
	private $dbPassword;
	
	public function __construct() {
		$this->dbConn = "mysql:host=localhost;dbname=cursusphp";
		$this->dbUsername = "cursusgebruiker";
		$this->dbPassword = "cursuspwd";
	}

	public function getStatus($rij, $kolom) {
		$sql = "select status from vieropeenrij_spelbord where rijnummer = " . $rij .
								" and kolomnummer = " . $kolom;
		$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
		$resultSet = $dbh->query($sql);
		if ($resultSet) {
			$record = $resultSet->fetch();
			if ($record) {
				$dbh = null;
				return $record["status"];
			} else return false;
		} else return false;
	}
	
	public function gooiMunt($kolom, $status) {
		// Zoek een beschikbare rij
		$gevondenRij = 0;
		$i=6;
		while ($gevondenRij == 0 && $i > 0) {
			if ($this->getStatus($i, $kolom) == 0) $gevondenRij = $i;
			else $i--;
		}
		if ($gevondenRij != 0) {
			$sql = "update vieropeenrij_spelbord set status = " . $status . " where rijnummer = " .
									$gevondenRij . " and kolomnummer = " . $kolom;
			$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
			$dbh->exec($sql);
			$dbh = null;
		} else return false;
	}
	
	public function reset() {
		$sql = "update vieropeenrij_spelbord set status = 0";
		$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
		$dbh->exec($sql);
		$dbh = null;
	}
}