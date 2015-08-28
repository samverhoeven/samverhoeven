<?php
	class arrayGenerator {
		public function getArray() {
			/*$seizoenen = array();
			array_push($seizoenen,"Winter");
			array_push($seizoenen,"Lente");
			array_push($seizoenen,"Zomer");
			array_push($seizoenen,"Herfst");
			return $seizoenen;*/
			
			/*$getallen = array();
			$getal = rand(1, 100);
			$getallen[] = $getal;
			while ($getal <= 80){
				$getal = rand (1, 100);
				$getallen[] = $getal;
			}
			return $getallen;*/

			$getallen = array();
			for ($i = 1; $i <= 50; $i += 2) {
				$getallen[] = $i;
			}
			for ($i = 2; $i <= 50; $i += 2) {
				$getallen[] = $i;
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
	<pre>
	<?php
		$array = new arrayGenerator();
		print_r($array->getArray());
	?>
	</pre>
</body>
</html>