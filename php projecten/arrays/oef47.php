<?php
	class arrayGenerator {
		public function getArray() {
			$getallen = array();
			for ($i = 1; $i <= 40; $i++) {
				$getallen[$i] = 0;
			}
			for($i = 0; $i < 100; $i++){
				$getal = rand(1, 40);
				$getallen[$getal]++;
			}
			return $getallen;
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Ingredienten</title>
</head>
<body>
	<ul>
	<?php
		$array = new arrayGenerator();
		$tabel = $array->getArray();
		foreach ($tabel as $sleutel => $waarde) {
			print("<li>");
			print("Getal ");
			print($sleutel);
			print(" werd ");
			print($waarde);
			print(" keer gegenereerd.");
			print("</li>");
		}
	?>
	</ul>
</body>
</html>