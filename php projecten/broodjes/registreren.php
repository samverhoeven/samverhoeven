<?php

use BroodjesProject\Business\TijdService;
use Doctrine\Common\ClassLoader;
use BroodjesProject\Business\CustomerService;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/BroodjesProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("BroodjesProject", "src");
$classLoader->register();

session_start();

if (TijdService::checkTijd()) {
    header("Location: buitentijd.php");
    exit(0);
}
if ($_SESSION["aangemeld"]) {
    header("Location: bestellen.php");
    exit(0);
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "registreren") {
        if (($_POST["wachtwoord"] == $_POST["wachtwoordCheck"]) && ($_POST["voornaam"] != null) && ($_POST["achternaam"] != null) && ($_POST["email"] != null) && ($_POST["wachtwoord"] != null) && ($_POST["wachtwoordCheck"] != null)) {
            /* Geen controle of klant bestaat! */
            CustomerService::VoegNieuweKlantToe($_POST["voornaam"], $_POST["achternaam"], $_POST["email"], $_POST["wachtwoord"]);
            header("Location: aanmelden.php");
            exit(0);
        } else {
            if (($_POST["voornaam"] == null) || ($_POST["achternaam"] == null) || ($_POST["email"] == null) || ($_POST["wachtwoord"] == null) || ($_POST["wachtwoordCheck"] == null)) {
                header("Location: registreren.php?error=veldleeg");
                exit(0);
            }
            if ($_POST["wachtwoord"] != $_POST["wachtwoordCheck"]) {
                header("Location: registreren.php?error=wachtwoord");
                exit(0);
            }
        }
    }
}
if (isset($_GET["error"])) {
    $error = $_GET["error"];
} else {
    $error = null;
}
$view = $twig->render("registratieform.twig", array("error" => $error));
print($view);
