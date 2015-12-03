<?php
	require_once("film.class.php");
	require_once("filmlijst.class.php");
	
	session_start();
	
	$fl = new FilmLijst();

	if(isset($_POST['addBtn']))
	{
		if (isset($_GET["action"]) && $_GET["action"] == "new") {
			$fl->createFilm($_POST["titel"], $_POST["duurtijd"]);
			if (!is_numeric($_POST["duurtijd"]) || ($_POST["duurtijd"]) <= 0 || empty($_POST["titel"])){
				$_SESSION["foutbericht"] = "De gegeven invoer is niet geldig.";
			}else{
				$_SESSION["foutbericht"] = null;
			}
			header("Refresh: 0");
		}
	}
	if (isset($_GET["action"]) && $_GET["action"] == "delete") {
		$fl->deleteFilm($_GET["id"]);
	}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>Films</title>
</head>
<body>
	<h1>Alle films</h1>
	<ul>
		<?php
			$tab = $fl->getLijst();
			foreach ($tab as $film) {
				?>
				<li>
					<a href="filmbewerken.php?id=<?php print($film->getId());?>">
					<?php print($film->getTitel());?>
					</a>
					(<?php print($film->getDuurtijd());?> min)
					<a href="oef92.php?action=delete&id=<?php print($film->getId());?>"><img src="img/delete.png"></a>
				</li>
				<?php
			}
		?>
	</ul>
	<h1>Film toevoegen</h1>
	<form action="oef92.php?action=new" method="post">
		<label for="titel">Titel:</label>
		<input type="text" name="titel">
		<br>
		<label for="duurtijd">Duurtijd:</label>
		<input "text" name="duurtijd">minuten
		<br>
		<input type="submit" value="Toevoegen" name="addBtn">
		<br>
		<?php print($_SESSION["foutbericht"])?>
	</form>
</body>
</html>