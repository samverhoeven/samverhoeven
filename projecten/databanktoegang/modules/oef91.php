<?php	
	require_once("module.class.php");
	require_once("moduleLijst.class.php");

	$ml = new ModuleLijst();

	if(isset($_GET["action"]) && $_GET["action"] == "verwijder"){
		$ml->deleteModule($_GET["id"]);
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Modules</title>
</head>
<body>
	<?php	
		$tab = $ml->getLijst();
	?>
	<ul>
		<?php
			foreach ($tab as $module) {
				$moduleNaam = $module->getNaam();
				$moduleId = $module->getId();
				print("<li>" . $moduleNaam . " (<a href=\"oef91.php?action=verwijder&id=" . $moduleId . "\">Verwijderen</a>) 
					(<a href=\"modulebewerking.php?id=" . $moduleId . "\">Bewerken</a>)</li>");
			}
		?>
	</ul>
</body>
</html>