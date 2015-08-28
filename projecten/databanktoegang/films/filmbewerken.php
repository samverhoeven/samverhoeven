<?php
	require_once("film.class.php");
	require_once("filmlijst.class.php");

	if ($_GET["action"] == "verwerk") {
		$film = new Film($_GET["id"], $_POST["titel"], $_POST["duurtijd"]);
		$filmLijst = new FilmLijst();
		$filmLijst->updateFilm($film);
		$updated = true;
	}
?>
<!DOCTYPE HTML>
<html>
	<head><title>Films</title></head>
	<body>
		<h1>Film bewerken</h1>
		<?php
		if ($updated) print("Record bijgewerkt!");
		$filmLijst = new FilmLijst();
		$film = $filmLijst->getFilmById($_GET["id"]);
		?>
		<form action="filmbewerken.php?action=verwerk&id=<?php print($_GET["id"]);?>" method="post">
			Titel:
			<input type="text" name="titel" value="<?php print($film->getTitel()); ?>"><br><br>
			Duurtijd:
			<input type="text" name="duurtijd" value="<?php print($film->getDuurtijd()); ?>"> min<br>
			<input type="submit" value="Opslaan">
		</form>
		<br>
		<a href="oef92.php">Terug naar overzicht</a>
		
	</body>
</html>