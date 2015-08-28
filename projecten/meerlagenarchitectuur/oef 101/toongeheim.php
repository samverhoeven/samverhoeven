<?php
session_start();

if(!isset($_SESSION["aangemeld"])){
	header("Location: aanmelden.php");
	exit(0);
}
include("presentation/geheimeinformatie.php");
