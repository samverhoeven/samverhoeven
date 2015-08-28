<?php
use VDAB\BoekenProject\Business\BoekService;
use VDAB\BoekenProject\Business\GenreService;
use Doctrine\Common\ClassLoader;
require_once("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/VDAB/BoekenProject/presentation");
$twig = new Twig_Environment($loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());

$classLoader = new ClassLoader("VDAB","src");
$classLoader->register();

//require_once("business/boekservice.class.php");
//require_once("business/genreservice.class.php");

$boekSvc = new BoekService();
$boekenLijst = $boekSvc->getBoekenOverzicht();

//include("src/VDAB/BoekenProject/presentation/boekenlijst.php");

$view = $twig->render("boekenlijst.twig", array( "boekenLijst" => $boekenLijst ));
print($view);
?>