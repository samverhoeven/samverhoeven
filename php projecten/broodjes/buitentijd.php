<?php
use BroodjesProject\Business\TijdService;
use Doctrine\Common\ClassLoader;
require_once ("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/BroodjesProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("BroodjesProject","src");
$classLoader->register();

session_start();

if(TijdService::checkTijd() == false){
    header("Location: aanmelden.php");
    exit(0);
}else{
    $view = $twig->render("buitentijdbericht.twig");
    print($view);
}

