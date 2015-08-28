<?php
	class Auto {
		private $aantalDeuren;
		public function setAantalDeuren($aantal) {
			$this->aantalDeuren = $aantal;
		}
		public function getAantalDeuren() {
			return $this->aantalDeuren;
		}
	}
	$kleineAuto = new Auto();
	$groteAuto = new Auto();
	$kleineAuto->setAantalDeuren(3);
	$groteAuto->setAantalDeuren(5);
	$groteAuto->setAantalDeuren($kleineAuto->getAantalDeuren()+2);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Klassen in de praktijk</title>
</head>
<body>
	Aantal deuren in een kleine auto:
	<?php print($kleineAuto->getAantalDeuren());?>
	<br>
	Aantal deuren in een grote auto:
	<?php print($groteAuto->getAantalDeuren());?>
</body>
</html>