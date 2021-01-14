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
    <h2>Libri in prestito ad un Utente</h2>
    <p>Compila un campo del modulo sottostante per cercare i libri presi in prestito da un utente</p>

    <form action="Libro_per_utente.php" method="POST">

        <fieldset>
            <label>Numero di Matricola</label></br>
            <input type="text" name="N_MATRICOLA" minlength="6" maxlength="6">
        </fieldset>

        <fieldset>
            <label>Nome</label></br>
            <input type="text" name="NOME_UTENTE">
        </fieldset>

        <fieldset>
            <label>Cognome</label></br>
            <input type="text" name="COGNOME_UTENTE">
        </fieldset>

        <input type="submit" value="Cerca">
    </form>
</body>

</html>