<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<link rel="shortcut icon" type="image/x-icon" href="http://www.unife.it/favicon.ico">

	<title>Sistema bibliotecario dell'università di Ferrara</title>

	<link rel="stylesheet" type="text/css" href="stylenavbar.css">
</head>

<body>
	<h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
	<?php include_once('navbarRICERCA.html'); ?>



	<h2>Prestiti Registrati agli Utenti</h2>
	<p>Compila un campo del modulo sottostante per cercare l'utente che ha preso in prestito il libro desiderato</p>

	<form action="Utente_per_libro.php" method="POST">

		<fieldset>
			<label>Codice libro: </label></br>
			<input type="text" name="CODICE_LIBRO">
		</fieldset>

		<fieldset>
			<label>Titolo </label></br>
			<input type="text" name="TITOLO">
		</fieldset>

		<fieldset>
			<label>ISBN: </label></br>
			<input type="text" name="ISBN" minlength="11" maxlength="13">
		</fieldset>

		<input type="submit" value="Cerca">
	</form>
</body>

</html>