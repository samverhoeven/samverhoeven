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
			$boekSvc->updateBoek($_GET["id"], $_POST["txtTitel"], $_POST["selGenre"]);
			header("location: toonalleboeken.php");
			exit(0);
		}catch(TitelBestaatException $tbe){
			header("Location: updateboek.php?id=".$_GET["id"]."&error=titleexists");
			exit(0);
		}
	} 
}else {
	$genreSvc = new GenreService();
	$genreLijst = $genreSvc->getGenresOverzicht();
	$boekSvc = new BoekService();
	$boek = $boekSvc->haalBoekOp($_GET["id"]);
	if(isset($_GET["error"])){
		$error = $_GET["error"];
	}else{
		$error = null;
	}
	//include("src/VDAB/BoekenProject/presentation/updateboekform.php");
	$view = $twig->render("updateboekform.twig", array( "genreLijst" => $genreLijst, "boek" => $boek, "error" => $error));
	print($view);
}