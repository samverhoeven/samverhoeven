<?php
namespace VDAB\BoekenProject\Business;
use VDAB\BoekenProject\Data\BoekDAO;
use VDAB\BoekenProject\Data\GenreDAO;

//require_once("data/boekdao.class.php");

class BoekService {
	public function getBoekenOverzicht() {
		$boekDAO = new BoekDAO();
		$lijst = $boekDAO->getAll();
		return $lijst;
	}

	public function voegNieuwBoekToe($titel, $genreId){
		$boekDAO = new BoekDAO();
		$boekDAO->create($titel, $genreId);
	}

	public function verwijderBoek($id) {
		$boekDAO = new BoekDAO();
		$boekDAO->delete($id);
	}

	public function haalBoekOp($id) {
		$boekDAO = new BoekDAO();
		$boek = $boekDAO->getById($id);
		return $boek;
	}

	public function updateBoek($id, $titel, $genreId) {
		$genreDAO = new GenreDAO();
		$boekDAO = new BoekDAO();
		$genre = $genreDAO->getById($genreId);
		$boek = $boekDAO->getById($id);
		$boek->setTitel($titel);
		$boek->setGenre($genre);
		$boekDAO->update($boek);
	}
}