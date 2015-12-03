<?php
	class Oefening{
		public function getGetallen(){
				/*for($getal = 20; $getal <= 50; $getal+=2){
					print($getal . "<br>");
				}*/
				/*$random = rand(100,200);
				for($getal = 1; $getal <= $random; $getal++){
					print($getal . "<br>");
				}*/
				/*$getal = rand(1, 1000);
				while($getal <= 600){
					print($getal . "<br>");
					$getal = rand(1, 1000);
				}*/
				$getal1 = 0;
				$getal2 = 1;
				while ($getal1 <= 5000) {

					print ($getal1 . "<br>");
					print ($getal2 . "<br>");
					$getal1 = $getal1 + $getal2;
					$getal2 = $getal1 + $getal2;
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
			print($oef->getGetallen());
		?>
	</h1>
</body>
</html>