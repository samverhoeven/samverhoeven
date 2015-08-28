<?php
	class Oefening {
			public function getAnalyse($getal) {
			switch($getal){
				case 1:
					return "Eén";
					break;
				case 2:
					return "Twee";
					break;
				case 3:
					return "Drie";
					break;
				case 4:
					return "Vier";
					break;
				case 5:
					return "Vijf";
					break;
				default:
					return $getal;
					break;
			}
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Analyse van getallen</title>
</head>
<body>
	<h1>
		<?php
			$oef = new Oefening();
			print($oef->getAnalyse(2));
		?>
	</h1>
</body>
</html>