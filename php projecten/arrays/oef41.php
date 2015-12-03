<?php
	class GetalArrayGenerator {
		public function getArray() {
			/*$getallen = array();
			$getallen[0] = 0;
			for($i = 1; $i < 50; $i++){
				$getallen[$i] = $getallen[$i-1] + $i;
			}
			return $getallen;*/

			$getallen = array();
			$getallen[0] = 0;
			$getallen[1] = 1;
			for($i = 2; $i < 30; $i++){
				$getallen[$i] = $getallen[$i-1] + $getallen[$i-2];  
			}
			return $getallen;
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Willekeurige getallen</title>
</head>
<body>
<pre>
<?php
	$arrGen= new GetalArrayGenerator();
	print_r($arrGen->getArray());
?>
</pre>
</body>
</html>