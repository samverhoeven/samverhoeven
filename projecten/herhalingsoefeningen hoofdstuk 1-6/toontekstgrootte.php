<?php
	require_once("tekstgroottegenerator.php");
	$tekstgrootteGenerator = new TekstgrootteGenerator();
	$tekstgrootte = $tekstgrootteGenerator->getTekstGrootte();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Tekst Grootte</title>
<style>
<?php
for ($i=0; $i < 13; $i++) { 
	?>
	h1:nth-child(<?php print($i+1);?>){
		font-size: <?php print($tekstgrootte[$i]);?>px;
	}
	<?php
}
?>
</style>
</head>
<body>
	<?php	
	print_r($tekstgrootte);
	for ($i=0; $i < 13; $i++) { 
		?>
		<h1>PHP is FANTASTISCH</h1>
		<?php
	}
	?>
</body>
</html>