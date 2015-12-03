<?php
	class Oefening{
		public function getResultaat($getal1, $getal2, $bewerking){
			switch ($bewerking) {
				case '1':
					$resultaat = $getal1 + $getal2;
					return $resultaat;
					break;

				case '2':
					$resultaat = $getal1 - $getal2;
					return $resultaat;
					break;
				
				case '3':
					$resultaat = $getal1 * $getal2;
					return $resultaat;
					break;
				
				case '4':
					$resultaat = $getal1 / $getal2;
					return $resultaat;
					break;
				
				default:
					return $bewerking . " is geen geldige bewerking";
					break;
			}			
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Gebruikersinvoer</title>
</head>
<body>
	<h1>
	<?php
		$oef = new Oefening();
		$resultaat = $oef->getResultaat($_GET["getal1"], $_GET["getal2"], $_GET["bewerking"]);
		print($resultaat);
	?>
</body>
</html>