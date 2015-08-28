<?php
class Thermometer{
	private $temperatuur;
	public function __construct($gegevenTemperatuur){
		if ($gegevenTemperatuur >= -50 && $gegevenTemperatuur <= 100) {
		$this->temperatuur = $gegevenTemperatuur;
		}
	}
	public function verhoog($aantalGraden){
		$temp = $this->temperatuur + $aantalGraden;
		if ($temp <= 100) {
		$this->temperatuur += $aantalGraden;
		}
	}
	public function verlaag($aantalGraden){
		$temp = $this->temperatuur - $aantalGraden;
		if ($temp >= -50) {
		$this->temperatuur -= $aantalGraden;
		}
	}
	public function setTemperatuur($gegevenTemperatuur){
		if ($gegevenTemperatuur >= -50 && $gegevenTemperatuur <= 100) {
		$this->temperatuur = $gegevenTemperatuur;
		}
	}
	public function getTemperatuur(){
		return $this->temperatuur;
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset = utf-8>
<title>Thermometer</title>
</head>
<body>
	<h1>
	<?php
	$therm = new Thermometer(20);
	//$Therm->setTemperatuur(20);
	$therm->verhoog(10);
	$therm->verlaag(5);	
	print($therm->getTemperatuur());
	?>
	</h1>
</body>
</html>