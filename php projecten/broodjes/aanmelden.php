<?php

use BroodjesProject\Business\CustomerService;
use BroodjesProject\Business\TijdService;
use Doctrine\Common\ClassLoader;

require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/BroodjesProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("BroodjesProject", "src");
$classLoader->register();

session_start();

$customerSvc = new CustomerService();

if (TijdService::checkTijd()) {
    header("Location: buitentijd.php");
    exit(0);
}
if (isset($_GET["uitloggen"])) {
    if ($_GET["uitloggen"]) {
        $_SESSION["aangemeld"] = false;
    }
}
if (isset($_SESSION["aangemeld"])) {
    if ($_SESSION["aangemeld"]) {
        header("Location: bestellen.php");
        exit(0);
    }
}
if (isset($_GET["action"])) {
    if ($_GET["action"] == "login") {
        $email = $_POST["email"];
        $wachtwoord = $_POST["wachtwoord"];
        $resultaat = $customerSvc->controleerKlant($email, $wachtwoord);
        if ($resultaat) {
            $_SESSION["aangemeld"] = true;
            $_SESSION["klant"] = $customerSvc->getKlantId($email);
            header("Location: bestellen.php");
            exit(0);
        } else {
            $geregistreerd = $customerSvc->controleerGeregistreerd($email, $wachtwoord);
            if ($geregistreerd) {
                header("Location: aanmelden.php?error=foutegegevens");
            } else {
                header("Location: aanmelden.php?error=bestaatniet");
            }
            exit(0);
        }
    }
} else {
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
    } else {
        $error = null;
    }
    $view = $twig->render("loginform.twig", array("error" => $error));
    print($view);
}
