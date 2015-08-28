<?php
session_start();

require_once("business/userservice.class.php");


if(isset($_GET["action"])){
	if ($_GET["action"] == "login") {
		$gebruikersnaam = $_POST["gebruikersnaam"];
		$wachtwoord = $_POST["wachtwoord"];
		$resultaat = UserService::controleerGebruiker($gebruikersnaam, $wachtwoord);
		if ($resultaat) {
			$_SESSION["aangemeld"] = true;
			header("Location: toongeheim.php");
			exit(0);
		}else{
			header("Location: aanmelden.php");
			exit(0);
		}
	}
}else{
	include("presentation/loginform.php");
}