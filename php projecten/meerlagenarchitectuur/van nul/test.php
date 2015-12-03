<?php
require_once("data/boekdao.class.php");
require_once("data/genredao.class.php");

//$dao = new BoekDAO();
//$boek = $dao->getById(1);

$dao = new GenreDAO();
$genre = $dao->getById(5);

print("<pre>");
print_r($genre);
print("</pre>");
?>