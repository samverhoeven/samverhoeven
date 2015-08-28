<?php
	class Vergelijking {
		public function getSomIsStriktPositief($getal1, $getal2) {
			$antw = (($getal1 + $getal2) > 0);
			if ($antw == true) return "JA";
			else return "NEEN";
		}
		public function getSomIsStriktNegatief($getal1, $getal2, $getal3){
			$antw = (($getal1 + $getal2 + $getal3) < 0) ;
			if ($antw == true) return "JA";
			else return "NEEN";
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Vergelijking</title>
</head>
<body>
<h1>
	<?php
		$vgl = new Vergelijking();
		print($vgl->getSomIsStriktPositief(10, -9));
	?>
	</br>
	<?php
		print($vgl->getSomIsStriktNegatief(10, -9, -2));
	?>
</h1>
</body>
</html>