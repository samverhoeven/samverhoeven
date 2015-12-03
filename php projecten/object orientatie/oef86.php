<?php
	interface Omschrijving{
		public function getOmschrijving();
	}

	abstract class Rekening{
		private $saldo = 0;
		private $rekeningnr;

		public function __construct($rekeningnr){
			$this->rekeningnr = $rekeningnr;
		}
		public function stort($bedrag){
			$this->saldo += $bedrag;
		}
		public function getSaldo(){
			return $this->saldo;
		}
		public function getNr(){
			return $this->rekeningnr;
		}
		public abstract function voerIntrestDoor();
	}

	class Zichtrekening extends Rekening implements Omschrijving{
		private static $intrest = 0.025;

		public function voerIntrestDoor(){
			parent::stort(parent::getSaldo() * self::$intrest);
		}
		public function getOmschrijving(){
			return "Kortetermijnrekening";
		}
	}

	class Spaarrekening extends Rekening implements Omschrijving{
		private static $intrest = 0.03;

		public function voerIntrestDoor(){
			parent::stort(parent::getSaldo() * self::$intrest);
		}
		public function getOmschrijving(){
			return "Langetermijnrekening";
		}
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset = utf-8>
<title>Rekening</title>
</head>
<body>
	<h1>
		<?php
			$rek = new Zichtrekening("091-0122401-16");
			print($rek->getNr() . "<br>");
			print("Het saldo is: " .$rek->getSaldo() . "<br>");
			$rek->stort(200);
			print("Het saldo is: " .$rek->getSaldo() . "<br>");
			$rek->voerIntrestDoor();
			print("Het saldo is: " .$rek->getSaldo() . "<br>");
			print($rek->getOmschrijving());
		?>
	</h1>
</body>
</html>