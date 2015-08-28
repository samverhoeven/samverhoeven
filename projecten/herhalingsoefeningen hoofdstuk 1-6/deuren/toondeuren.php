<?php
session_start();
if (isset($_GET["reset"])) {
	if ($_GET["reset"] == 1) {
		unset($_SESSION["deurenReeks"]);
	}
}
if (!isset($_SESSION["deurenReeks"])) {
	$_SESSION["deurenReeks"] = array();
	for ($i=1; $i <= 7; $i++) { 
		$_SESSION["deurenReeks"][$i] = 0;
	}
	$_SESSION["schattenDeurNr"] = rand(1, 7);
	$_SESSION["pogingen"] = 0;
}
if (isset($_GET["kiesdeur"])) {
	$gekozenDeurNr = $_GET["kiesdeur"];
	if ($gekozenDeurNr == $_SESSION["schattenDeurNr"]) {
	 	$_SESSION["deurenReeks"][$gekozenDeurNr] = 2;
	 }else{
	 	$_SESSION["deurenReeks"][$gekozenDeurNr] = 1;
	 }
	 $_SESSION["pogingen"]++;
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset = utf-8>
	<title>DEUREN</title>
</head>
<style>
img{
	border-width: 0px;
}
<?php
if ($gekozenDeurNr == $_SESSION["schattenDeurNr"]) {
	?>
	#deuren{
		pointer-events: none;
	}
	<?php
}
?>
</style>
<body>
	<h1>Kies een deur</h1>
	<?php
	for ($i=1; $i <= 7; $i++) { 
		?>
		<a id="deuren" href="toondeuren.php?kiesdeur=<?php print($i);?>">
		<?php
		if ($_SESSION["deurenReeks"][$i] == 0) {
			?>
			<img src="img/doorclosed.png">
			<?php
		}
		if ($_SESSION["deurenReeks"][$i] == 1) {
			?>
			<img src="img/dooropen.png">
			<?php
		}
		if ($_SESSION["deurenReeks"][$i] == 2) {
			?>
			<img src="img/doortreasure.png">
			<?php

		}
		?>
		</a>
		<?php
	}
	?>
	<br>
	<p>Aantal pogingen: <?php print($_SESSION["pogingen"]);?></p>
	<br>
	<p>Klik <a href="toondeuren.php?reset=1">hier</a> om een nieuw spel te beginnen.</p>
</body>
</html>