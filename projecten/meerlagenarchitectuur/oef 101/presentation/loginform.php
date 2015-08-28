<!DOCTYPE HTML>
<html>
<head>
<meta charset = utf-8>
<title>login form</title>
</head>
<body>
	<h1>Inloggen</h1>
	<form method="post" action="aanmelden.php?action=login">
		<table>
			<tr>
				<td><label for="gebruikersnaam">Gebruikersnaam:</label></td>
				<td><input type="text" name="gebruikersnaam"></td>
			</tr>
			<tr>
				<td><label for="wachtwoord">Wachtwoord:</label></td>
				<td><input type="text" name="wachtwoord"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="log in"></td>
			</tr>
		</table>
	</form>
</body>
</html>