<?php
use VDAB\BoekenProject\Business\BoekService;
use VDAB\BoekenProject\Business\GenreService;
use VDAB\BoekenProject\Exceptions\TitelBestaatException;
use Doctrine\Common\ClassLoader;
require_once("Doctrine/Common/ClassLoader.php");
require_once("libraries/Twig/Autoloader.php");

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("src/VDAB/BoekenProject/presentation");
$twig = new Twig_Environment($loader);

$classLoader = new ClassLoader("VDAB","src");
$classLoader->register();

//require_once("business/genreservice.class.php");
//require_once("business/boekservice.class.php");
//require_once("exceptions/titelbestaatexception.class.php");
if(isset($_GET["action"])){
	if ($_GET["action"] == "process") {
		try{
			$boekSvc = new BoekService();
			$boekSvc->voegNieuwBoekToe($_POST["txtTitel"], $_POST["selGenre"]);
			header("location: toonalleboeken.php");
			exit(0);
		}catch(TitelBestaatException $tbe){
			header("Location: voegboektoe.php?error=titleexists");
			exit(0);
		}
	}
} else {
	$genreSvc = new GenreService();
	$genreLijst = $genreSvc->getGenresOverzicht();
	if(isset($_GET["error"])){
		$error = $_GET["error"];
	}else{
		$error = null;
	}
	//include("src/VDAB/BoekenProject/presentation/nieuwboekform.php");
	$view = $twig->render("nieuwboekform.twig", array( "genreLijst" => $genreLijst, "error" => $error));
	print($view);
}