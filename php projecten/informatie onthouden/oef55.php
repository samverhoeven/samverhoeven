<?php
$kleur = "white";
if(!isset($_COOKIE["achtergrondkleur"])){
	setcookie("achtergrondkleur", $kleur);
}
if (!empty($_POST["achtergrondkleuren"])) {
	setcookie("achtergrondkleur", $_POST["achtergrondkleuren"], time() + 86400);
	$kleur = $_POST["achtergrondkleuren"];
} elseif (isset($_COOIE["achtergrondkleur"])) {
	$kleur = $_COOKIE["achtergrondkleur"];
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Cookies</title>
<style>
	body{
		background-color: <?php print($kleur); ?>
	}
</style>
</head>
<body>
	<form action="oef55.php" method="post">
		<label>Kies uw favoriete achtergrondkleur: </label>
		<select name="achtergrondkleuren">
			<option value="red">Rood</option>
			<option value="blue">Blauw</option>
			<option value="green">Groen</option>
			<option value="yellow">Geel</option>
			<option value="white">Wit</option>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<a href="oef55.php">Vernieuw de pagina</a>
</body>
</html>