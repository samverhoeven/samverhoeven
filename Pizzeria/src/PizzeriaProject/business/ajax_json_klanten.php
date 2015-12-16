<?php
use Doctrine\Common\ClassLoader;
use PizzeriaProject\Business\KlantService;

require_once("../../../libraries/Doctrine/Common/ClassLoader.php");
$classLoader = new ClassLoader("PizzeriaProject", "../../../src");
$classLoader->register();

session_start();

$KS = new KlantService();

$klanten = $KS->getAlleKlanten();
foreach ($klanten as $klant){
    $emails[] = $klant->getEmail(); 
}

echo json_encode($emails);

