<?php
class NegatieveStortingException extends Exception {
}

class RekeningVolException extends Exception {
}

class TegroteStortingException extends Exception {
}

class Rekening {
	private $saldo;
	public function __construct() {
		$this->saldo = 0;
	}
	public function storten($bedrag) {
		if ($bedrag < 0) throw new NegatieveStortingException();
		if ($bedrag > 500) throw new TegroteStortingException();
		if ($this->saldo + $bedrag > 1000) throw new RekeningVolException();
		$this->saldo += $bedrag;
	}
	public function getSaldo() {
		return $this->saldo;
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Test exception</title>
</head>
<body>
	<?php
	$rek = new Rekening();
	try {
		print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
		$rek->storten(501);
		print("<p>Saldo: " . $rek->getSaldo() . " &euro;</p>");
	} catch (NegatieveStortingException $ex) {
		print("<p>Een negatief bedrag storten is niet mogelijk!</p>");
	} catch (RekeningVolException $ex) {
		print("<p>Dit bedrag kan niet gestort worden, de limiet van de rekening is &euro;1000!</p>");
	} catch (TegroteStortingException $ex) {
		print("<p>Een storting van meer dan &euro;500 is niet toegelaten!</p>");
	}
	?>
</body>
</html>