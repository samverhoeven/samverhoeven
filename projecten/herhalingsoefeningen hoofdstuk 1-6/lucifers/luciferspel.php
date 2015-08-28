<?php
session_start();
if (isset($_GET["reset"])) {
	if ($_GET["reset"] == 1) {
		unset($_SESSION["aantalLucifers"]);
	}
}
if (!isset($_SESSION["aantalLucifers"])) {
	$_SESSION["aantalLucifers"] = 7;
}
if (isset($_GET["aantal"])) {
	$aantal = $_GET["aantal"];
}
$spelstop = false;
if (isset($aantal)) {	
	if ($_SESSION["aantalLucifers"] - $aantal > 0) {
		$_SESSION["aantalLucifers"] -= $aantal;
	}elseif ($_SESSION["aantalLucifers"] - $aantal == 0) {
		$spelstop = true;
	}
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset = utf-8>
<title>Luciferspel</title>
<style>
.lucifers{
	float: left;
}
</style>
</head>
<body>
	<h1>Luciferspel</h1>
	<?php
	if ($spelstop) {
		?>
		<h2>Het spel is afgelopen.</h2>
		<?php
	}else{
		for ($i=1; $i <= $_SESSION["aantalLucifers"]; $i++) { 
			?>
			<img class="lucifers" src="img/lucifer.png">
			<?php
		}
		?>
		<table style="clear: left;">
			<tr>
				<td>
					<form action="luciferspel.php?aantal=1" method="post">
						<input type="submit" value="Eén lucifer wegnemen">
					</form>
				</td>
				<td>
					<form action="luciferspel.php?aantal=2" method="post">
						<input type="submit" value="Twee lucifers wegnemen">
					</form>
				</td>		
			</tr>
		</table>
		<?php
	}
	?>
	<p>Klik <a href="luciferspel.php?reset=1">hier</a> om een nieuw spel te beginnen.</p>
</body>
</html>