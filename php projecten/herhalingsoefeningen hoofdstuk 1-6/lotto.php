<?php
class GetallenKiezer{
	public function getgetallenReeks(){
		$tab = array();
		while (count($tab)<6) {
			$getal = rand(1, 42);
			if (!in_array($getal, $tab)) {
				$tab[] = $getal;
			}
		}
		return $tab;
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset = utf-8>
	<title>Lotto</title>
</head>
<body>
	<?php
	$kiezer = new GetallenKiezer();
	$reeks = $kiezer->getGetallenReeks();
	print_r($reeks);
	print("<br> 
		<table>");
	for ($i=1; $i <= 42; $i++) { 
		if (in_array($i, $reeks)) {
			$bgcolor = "#aaa";
		}else{
			$bgcolor = "#eee";
		}
		if ($i % 7 == 1) {
			print("<tr>");
		}
		print("<td style='text-align: center; background-color: " . $bgcolor . ";'>" . $i . "</td>");
		if ($i % 7 == 0) {
			print("</tr>");
		}
	}
	print("</table>");
	?>
</body>
</html>