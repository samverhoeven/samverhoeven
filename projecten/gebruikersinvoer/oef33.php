<?php
	class Oefening{
		public function getResultaat($gok){
			$getal = rand(1, 10);
			if ($gok == $getal) {
				$response = 'Proficiat u heeft goed gegokt.';
			}
			else{
				$response = 'Helaas uw gok was niet goed.';
			}
			return "Uw gok: " . $gok . ". Het getal: " . $getal . "<br>" . $response;
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
		$resultaat = $oef->getResultaat($_GET["mijngok"]);
		print($resultaat);
	?>
</body>
</html>