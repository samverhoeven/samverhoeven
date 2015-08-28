<?php
	$grondgetal = $_GET["grondgetal"];
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset = utf-8>
	<title>Toon Tafels van <?php print($grondgetal);?></title>
	<style>
	table, td, th{
		border: 1px solid black;
	}
	</style>
</head>
<body>
	<table>
		<tr><th colspan="2">De tafel van <?php print($grondgetal);?></th></tr>
		<?php
			for ($i=0; $i < 10; $i++) { 
			?>
			<tr>
				<td><?php print($i+1);?> maal <?php print($grondgetal);?></td>
				<td><?php print(($i+1)*$grondgetal);?></td>
			</tr>
			<?php
			}
		?>
	</table>
</body>
</html>