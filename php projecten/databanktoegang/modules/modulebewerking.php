<?php
	require_once("module.class.php");
	require_once("moduleLijst.class.php");

	if ($_GET["action"] == "verwerk") {
		$module = new Module($_GET["id"], $_POST["naam"], $_POST["prijs"]);
		$ml = new ModuleLijst();
		$ml->updateModule($module);
		$updated = true;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Modules</title>
</head>
<body>
	<h1>Module bewerken</h1>
	<?php
		if ($updated) print("Record bijgewerkt!");
		$ml = new ModuleLijst();
		$module = $ml->getModuleById($_GET["id"]);
	?>
	<form action="modulebewerking.php?action=verwerk&id=<?php print($_GET["id"]);?>" method="post">
		Naam:
		<input type="text" name="naam" value="<?php print($module->getNaam()); ?>"><br><br>
		Prijs:
		<input type="text" name="prijs" value="<?php print($module->getPrijs()); ?>"> euro<br>
		<input type="submit" value="Opslaan">
	</form>
	<br>
	<a href="oef91.php">Terug naar overzicht</a>
</body>
</html>