<?php
require_once("bericht.class.php");
require_once("berichtlijst.class.php");

session_start();

$berichtLijst = new BerichtLijst();
$nickform = false;

if (!isset($_SESSION["nickname"])) {
	//$getal = rand(111, 999);
	//$_SESSION["nickname"] = "p" . $getal;
	$nickform = true;
}
if (isset($_GET["action"])) {
	if ($_GET["action"]=="newnick") {
		$_SESSION["nickname"] = $_POST["nick"];
		$nickform = false;
		header("Location: chat.php");
	}

	if ($_GET["action"] == "add") {
		$berichtLijst->createBericht($_SESSION["nickname"], $_POST["txtBoodschap"]);
		header("Location: chat.php");
	}
}
$berichten = $berichtLijst->getAlleBerichten();

?>
<!DOCTYPE HTML>
<html>
	<head><title>Chatprogramma</title></head>
	<style>
		table {
			border-collapse: border;
		}
		td {
			vertical-align: top;
		}
	</style>
	<body>
		<table style="width: 500px;">
			<tbody>
				<?php
				if ($nickform == true) {
					?>
					<form method="post" action="chat.php?action=newnick">
						<label for="nick">Voer uw nickname in ('p'+'uw nickname'):</label>
						<input name="nick" type="text">
						<input type="submit">
					</form>
					<?php
				}
				if ($nickform == false) {
					$i=0;
					foreach ($berichten as $bericht) {
						?>
						<tr>
							<td style="width: 150px;">
								<?php print($bericht->getNickname());?> >
							</td>
							<td>
								<?php print($bericht->getBoodschap());?>
							</td>
						</tr>
						<?php
						$i++;
						if ($i>=20) {
							break;
						}
					}
				?>
			</tbody>
		</table>
		<br>
		<br>
		<form method="post" action="chat.php?action=add">
			Bericht:<br>
			<textarea name="txtBoodschap" cols="60" rows="3" maxlength="180"></textarea><br>
			<input type="submit" value="Versturen">
		</form>
		<?php
		}
		?>
	</body>
</html>
