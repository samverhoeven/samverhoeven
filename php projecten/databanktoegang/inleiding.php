<?php
	class PersonenLijst {
		public function getLijst() {
			$lijst = array();
			$dbh = new PDO("mysql:host=localhost;dbname=cursusphp", "cursusgebruiker", "cursuspwd");
			$resultSet = $dbh->query("select familienaam, voornaam from personen");
			foreach ($resultSet as $rij) {
				$lijst[]/*$naam*/ = $rij["familienaam"] . ", " . $rij["voornaam"];
				//array_push($lijst, $naam);
			}
			$dbh = null;
			return $lijst;
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Databanken introductie</title>
</head>
<body>
	<?php
	$pl = new PersonenLijst();
	$tab = $pl->getLijst();
	sort($tab);
	?>
	<ul>
		<?php
		foreach ($tab as $naam) {
			print("<li>" . $naam . "</li>");
		}
		?>
	</ul>
</body>
</html>