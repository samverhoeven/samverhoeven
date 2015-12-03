<?php
require_once("business/persoonservice.class.php");
$pService = new PersoonService();
$personen = $pService->getPersonenOverzicht();
include("presentation/personenlijst.php");