<?php
class Geheim {
public function getResultaat() {
$mijnGetal = 10;
$mijngetal = $mijnGetal * $mijnGetal;
return $mijnGetal;
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Oefening op variabelen</title>
</head>
<body>
<h1>
<?php
$geheim = new Geheim();
print($geheim->getResultaat());
?>
</h1>
</body>
</html>