<?php
	require_once("getallenreeksmaker.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset=utf-8>
<title>Toon Getallen</title>
<style>
	table{
		border: 1px solid black;
	}
	table td{
		border: 1px solid black;
	}
</style>
</head>
<body>
	<?php
		$getReeks = new GetallenReeksMaker();
		$tabel = $getReeks->getReeks();
	?>
	<table>
		<tbody>
			<tr>
			<?php
				foreach($tabel as $getal){
					?>
					
						<td>
							<?php print($getal); ?>
						</td>
					
					<?php
				}
			?>
			</tr>
		</tbody>
	</table>
</body>
</html>