<?php
use VDAB\BoekenProject\Business\BoekService;
use Doctrine\Common\ClassLoader;
require_once("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/VDAB/BoekenProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("VDAB","src");
$classLoader->register();

//require_once("business/boekservice.class.php");

$boekSvc = new BoekService();
$boekSvc->verwijderBoek($_GET["id"]);

header("location: toonalleboeken.php");
exit(0);