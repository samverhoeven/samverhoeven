<?php
session_start();
if ($_GET["reset"] == 1) unset($_SESSION["aantalLucifers"]);
if (!isset($_SESSION["aantalLucifers"])) $_SESSION["aantalLucifers"] = 7;
$aantal = $_GET["aantal"];
$spelstop = false;
if (isset($aantal)) {
	if ($_SESSION["aantalLucifers"] - $aantal > 0) {
		$_SESSION["aantalLucifers"] -= $aantal;
	} elseif ($_SESSION["aantalLucifers"] - $aantal == 0) {
		$spelstop = true;
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head><title>Luciferspel 2</title></head>
	<body>
		<h1>Luciferspel 2</h1>
		<?php
		if ($spelstop) {
			?>
			<h2>Het spel is afgelopen.</h2>
			<?php
		} else {
			for ($i=1; $i<=$_SESSION["aantalLucifers"]; $i++) {
				?>
				<img src="img/lucifer.png">
				<?php
			}
			?>
			<br>
			<br>
			<table>
				<tr>
					<td>
						<form action="luciferspel2.php?aantal=1" method="get">
							<input type="submit" value="Eén lucifer wegnemen">
						</form>
					</td>
					<td>
						<form action="luciferspel2.php?aantal=2" method="get">
							<input type="submit" value="Twee lucifers wegnemen">
						</form>
					</td>
				</tr>
			</table>
			<?php
		}
		?>
		<br>
		Klik <a href="luciferspel2.php?reset=1">hier</a> om een nieuw spel te beginnen.
	</body>
</html>
