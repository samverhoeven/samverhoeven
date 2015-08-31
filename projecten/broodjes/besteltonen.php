<?php

use BroodjesProject\Business\TijdService;
use BroodjesProject\Business\BestellingService;
use BroodjesProject\Business\BestregService;
use BroodjesProject\Business\BelegBestregService;
use BroodjesProject\Business\BroodjeService;
use BroodjesProject\Business\BelegService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/BroodjesProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("BroodjesProject", "src");
$classLoader->register();

session_start();

if (TijdService::checkTijd()) { /* Checkt of voor 10u is (tussen 6 en 10u) */
    header("Location: buitentijd.php");
    exit(0);
}
if (!isset($_SESSION["aangemeld"]) || ($_SESSION["aangemeld"] == false)) { /* Checkt of je aangemeld bent */
    header("Location: aanmelden.php");
    exit(0);
} else {
    $bestelling = BestellingService::haalBestellingOp($_SESSION["klant"]);
    if (!empty($bestelling)) {
        $bestellingId = $bestelling->getId();
        $bestregels = BestregService::haalBestregOp($bestellingId);
        $broodjes = BroodjeService::haalBroodjesOverzicht();
        $belegBestregels = BelegBestregService::haalBelegBestregOverzicht();
        $belegOverzicht = BelegService::haalBelegOverzicht();
        if (empty($bestregels)) {
            $leeg = true;
        } else {
            $leeg = false
                
                ;
        }
    } else {
        $leeg = true;
    }
}

if (!isset($bestregels)) {
    $bestregels = " ";
}

if (!isset($broodjes)) {
    $broodjes = " ";
}

if (!isset($belegBestregels)) {
    $belegBestregels = " ";
}
if (!isset($belegOverzicht)) {
    $belegOverzicht = " ";
}

$view = $twig->render("mijnbestel.twig", array("bestregels" => $bestregels, "broodjes" => $broodjes,
    "belegBestregels" => $belegBestregels, "belegOverzicht" => $belegOverzicht, "leeg" => $leeg));
print($view);

