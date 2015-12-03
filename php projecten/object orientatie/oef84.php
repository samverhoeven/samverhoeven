<?php
	class Persoon{
		private $familienaam;
		private $voornaam;

		public function __construct($familienaam,$voornaam){
			$this->setFamilienaam($familienaam);
			$this->setVoornaam($voornaam);
		}
		public function setFamilienaam($familienaam){
			$this->familienaam = $familienaam;
		}
		public function setVoornaam($voornaam){
			$this->voornaam = $voornaam;
		}
		public function getVollNaam(){
			return ($this->familienaam . ", " . $this->voornaam);
		}
	}

	class Cursist extends Persoon{
		private $aantalCursussen;

		public function __construct($familienaam, $voornaam, $aantalCursussen){
			parent::__construct($familienaam, $voornaam);
			$this->aantalCursussen = $aantalCursussen;
		}
		public function getAantalCursussen(){
			return $this->aantalCursussen;
		}
	}

	class Medewerker extends Persoon{
		private $aantalCursisten;

		public function __construct($familienaam, $voornaam, $aantalCursisten){
			parent::__construct($familienaam, $voornaam);
			$this->aantalCursisten = $aantalCursisten;
		}
		public function getAantalCursisten(){
			return $this->aantalCursisten;
		}
	}

	$cursist = new Cursist("Peeters", "Jan", 3);
	$medewerker = new Medewerker("Janssens", "Tom", 8);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset = utf-8>
<title>Cursisten en medewerkers</title>
</head>
<body>
	<h1>Namen</h1>
	<ul>
	<li><?php print($cursist->getVollNaam() . " volgt " . $cursist->getAantalCursussen() . " cursus(sen)");?></li>
	<li><?php print($medewerker->getVollNaam() . " begeleidt " . $medewerker->getAantalCursisten() . " cursist(en)");?></li>
	</ul>
</body>
</html>