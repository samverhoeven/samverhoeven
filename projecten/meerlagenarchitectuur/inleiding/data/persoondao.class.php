<?php
require_once("entities/persoon.class.php");

class DBConfig{
	public static $DB_CONNSTRING = "mysql:host=localhost;dbname=cursusphp";
	public static $DB_USERNAME = "cursusgebruiker";
	public static $DB_PASSWORD = "cursuspwd";
}

class PersoonDAO{
	public function getAll(){
		$lijst = array();
		$sql = "select familienaam, voornaam from personen";
		$dbh = new PDO(DBConfig::$DB_CONNSTRING,
		DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
		$resultSet = $dbh->query($sql);
		foreach ($resultSet as $rij) {
			$lijst[] = new Persoon($rij["familienaam"], $rij["voornaam"]);
		}
		$dbh = null;
		return $lijst;
	}
}