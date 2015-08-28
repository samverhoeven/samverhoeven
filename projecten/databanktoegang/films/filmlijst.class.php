<?php
	require_once("film.class.php");

	class FilmLijst{
		private $dbConn;
		private $dbUsername;
		private $dbPassword;

		public function __construct() {
			$this->dbConn = "mysql:host=localhost;dbname=cursusphp";
			$this->dbUsername = "cursusgebruiker";
			$this->dbPassword = "cursuspwd";
		}

		public function createFilm($titel, $duurtijd){
			if (is_numeric($duurtijd) && $duurtijd > 0 && !empty($titel)) {
				$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);				
				$sql = "insert into films (titel, duurtijd) values('$titel','$duurtijd')";
				$dbh->exec($sql);
				$dbh = null;
			}else{
				return "Deze invoer is fout";
			}
		}
		public function deleteFilm($id){
			$dbh = new PDO("mysql:host=localhost;dbname=cursusphp","cursusgebruiker","cursuspwd");
			$dbh->exec("delete from films where id=$id");
			$dbh = null;
		}
		public function getLijst(){
			$lijst = array();
			$dbh = new PDO("mysql:host=localhost;dbname=cursusphp", "cursusgebruiker", "cursuspwd");
			$resultSet = $dbh->query("select id, titel, duurtijd from films order by titel");
			foreach ($resultSet as $rij) {
				$film = new Film($rij["id"], $rij["titel"],$rij["duurtijd"]);
				$lijst[] = $film;
			}
			$dbh = null;
			return $lijst;
		}

		public function getFilmById($id) {
			$sql = "select titel, duurtijd from films where id = " . $id;
			$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
			$resultSet = $dbh->query($sql);
			if ($resultSet) {
				$rij = $resultSet->fetch();
				if ($rij) {
					$film = new Film($id, $rij["titel"], $rij["duurtijd"]);
					$dbh = null;
					return $film;
				} else return false;
			} else return false;	
		}
		
		public function updateFilm($film) {
			$sql = "update films set titel = '" . $film->getTitel() . "', duurtijd = " . $film->getDuurtijd() . 
											" where id = " . $film->getId();
			$dbh = new PDO($this->dbConn, $this->dbUsername, $this->dbPassword);
			$dbh->exec($sql);
			$dbh = null;
		}
	}