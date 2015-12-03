<?php
session_start();
/*if (!isset($_SESSION["aantal"])) {
	$_SESSION["aantal"] = 0;
}else{
	$_SESSION["aantal"]++;
}

if(!isset($_SESSION["winnendGetal"]) || $_SESSION["aantal"] == 10){
	$_SESSION["aantal"] = 0;
	$_SESSION["winnendGetal"] = rand(1, 100);
}*/

if (!isset($_SESSION["teller"]) || $_SESSION["teller"] >= 5) {
	$_SESSION["teller"] = 0;
} else {
	$_SESSION["teller"]++;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Ingredienten</title>
</head>
<body>
	<h1>
	<?php
	//print($_SESSION["winnendGetal"]);
	print($_SESSION["teller"]);
	?>
	</h1>	
</body>