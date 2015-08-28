<?php

use BroodjesProject\Business\TijdService;
use BroodjesProject\Business\BroodjeService;
use BroodjesProject\Business\BelegService;
use BroodjesProject\Business\BestellingService;
use BroodjesProject\Business\BestregService;
use BroodjesProject\Business\BelegBestregService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/BroodjesProject/presentation");
$twig = new Twig_Environment($loader);
$classLoader = new ClassLoader("BroodjesProject", "src");
$classLoader->register();

session_start();

$broodjeSvc = new BroodjeService();
$broodjesLijst = $broodjeSvc->haalBroodjesOverzicht();
$belegSvc = new BelegService();
$belegLijst = $belegSvc->haalBelegOverzicht();

if (TijdService::checkTijd()) { /* Checkt of voor 10u is (tussen 6 en 10u) */
    header("Location: buitentijd.php");
    exit(0);
}
if (!isset($_SESSION["aangemeld"]) || ($_SESSION["aangemeld"] == false)) { /* Checkt of je aangemeld bent */
    header("Location: aanmelden.php");
    exit(0);
} else {
    if (isset($_GET["broodje"])) { /* Checkt of broodje is gekozen */
        $broodjeCheck = true;
        $_SESSION["totaal"] = 0;
        $id = $_GET["broodje"];
        $_SESSION["broodje"] = $broodjeSvc->haalBroodjeOp($id);
        $_SESSION["totaal"] += $_SESSION["broodje"]->getPrijs();
    } else {
        $broodjeCheck = false;
    }

    if (isset($_GET["beleg"])) { /* Checkt of beleg is gekozen */
        unset($_SESSION["beleg"]);
        $beleg = $_POST["gekozenBeleg"];
        foreach ($beleg as $keuze) {
            $_SESSION["beleg"][] = $belegSvc->haalBelegOp($keuze);
            $_SESSION["totaal"] += $belegSvc->haalBelegOp($keuze)->getPrijs();
        }
        /* Om bij verversen niet nog eens het beleg bij het totaal op te tellen */
        header("Location: bestellen.php?afrekenen=true");
        exit(0);
    }

    if (isset($_GET["afrekenen"])) {
        $belegCheck = true;
    } else {
        $belegCheck = false;
    }

    if (isset($_GET["bestel"])) { /* Checkt of de keuze is gemaakt en voor bestellen is gekozen */
        $bestelling = BestellingService::haalBestellingOp($_SESSION["klant"]);
        if (is_null($bestelling)) {
            BestellingService::voegBestellingToe($_SESSION["klant"], $_SESSION["totaal"], date("Y-m-d"));
        } elseif ($bestelling->getDatum() != date("Y-m-d")) {
            BestellingService::voegBestellingToe($_SESSION["klant"], $_SESSION["totaal"], date("Y-m-d"));
        } else {
            BestellingService::updateBestelling($_SESSION["klant"], $_SESSION["totaal"]);
        }
        $bestelling = BestellingService::haalBestellingOp($_SESSION["klant"]);
        $bestregId = BestregService::voegBestregToe($bestelling->getId(), $_SESSION["broodje"]->getId(), $_SESSION["totaal"], date("Y-m-d - H:i:sa"));
        foreach ($_SESSION["beleg"] as $belegId) {
            BelegBestregService::voegBelegBestregToe($bestregId, $belegId->getId());
        }
        header("Location: bestellen.php?klaar=true");
        exit(0);
    }

    /* extra check om prijs niet bij elke refresh te verhogen binnen vorige check: if (isset($_GET["bestel"])) */
    if (isset($_GET["klaar"])) {
        $bestelCheck = true;
    } else {
        $bestelCheck = false;
    }

    /* Zonder deze variabelen eerst te setten krijg je een notice, 
     * deze variabelen worden al gebruikt in $twig->render */
    if (!isset($_SESSION["beleg"])) {
        $_SESSION["beleg"] = " ";
    }

    if (!isset($_SESSION["broodje"])) {
        $_SESSION["broodje"] = " ";
    }

    if (!isset($_SESSION["totaal"])) {
        $_SESSION["totaal"] = 0;
    }

    $view = $twig->render("bestellingform.twig", array("broodjesLijst" => $broodjesLijst,
        "belegLijst" => $belegLijst, "broodjeCheck" => $broodjeCheck, "belegCheck" =>
        $belegCheck, "bestelCheck" => $bestelCheck, "gekozenBeleg" => $_SESSION["beleg"],
        "gekozenBroodje" => $_SESSION["broodje"], "totaal" => $_SESSION["totaal"]));
    print($view);
}