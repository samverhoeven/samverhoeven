<!DOCTYPE HTML>
<html>
<head>
	<meta charset = utf-8>
	<title>Tafels</title>
<style>
table, td{
	border: 1px solid black;
}
</style>
</head>
<body>
	<table>
		<tr>
			<td> </td>
			<?php
				for ($i=1; $i < 11; $i++) { 
					?>
					<td><?php print($i);?></td>
					<?php
				}
			?>
		</tr>
		<?php
		for ($i=1; $i < 11; $i++) { 
			?>
			<tr>
				<td><?php print($i);?></td>
				<?php
				for ($j=1; $j < 11; $j++) { 
					?>
					<td><?php print($i*$j);?></td>
					<?php
				}
				?>
			</tr>
			<?php		
		}
		?>
	</table>
</body>
</html>