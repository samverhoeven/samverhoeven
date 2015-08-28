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

if (TijdService::checkTijd()) { /* Checkt of voor 10u is (tussen 6 en 10u) */
    header("Location: buitentijd.php");
    exit(0);
}
if (!isset($_SESSION["aangemeld"]) || ($_SESSION["aangemeld"] == false)) { /* Checkt of je aangemeld bent */
    header("Location: aanmelden.php");
    exit(0);
} else {
    if (isset($_GET["wijzig"])) {
        if ($_GET["wijzig"]) {
            $klant = CustomerService::haalKlantOp($_SESSION["klant"]);
            if (!empty($_POST["huidig"]) && !empty($_POST["nieuw1"]) && !empty($_POST["nieuw2"])) {
                if ($klant->getWachtwoord() == $_POST["huidig"]) {
                    if (($_POST["nieuw1"] == $_POST["nieuw2"]) && ($_POST["nieuw1"] != null)) {
                        CustomerService::wijzigWachtwoord($_SESSION["klant"], $_POST["nieuw1"]);
                        $gelijk = true;
                        header("Location: bestellen.php");
                        exit(0);
                    }
                    $gelijk = false;
                    $leeg = false;
                    $wachtwoord = true;
                } else {
                    $wachtwoord = false;
                }
            } else {
                $leeg = true;
            }
        }
    }

    if (!isset($leeg)) {
        $leeg = false;
    }
    if (!isset($gelijk)) {
        $gelijk = true;
    }
    if(!isset($wachtwoord)){
        $wachtwoord = true;
    }
    $view = $twig->render("wachtwoordform.twig", array("gelijk" => $gelijk, "leeg" => $leeg,
        "wachtwoord" => $wachtwoord));
    print($view);
}