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
    <?php include_once('navbarPRESTITO.html'); ?>

    <h2>Restituzione di un libro</h2>

    <p>Inserisci il codice del prestito per confermare il rientro</p>
    <form action="Elimina_prestito.php" method="POST">

        <fieldset>
            <label>Codice Prestito: </label></br>
            <input type="text" name="CODICE_PRESTITO">
        </fieldset>
        <input type="submit" value="Ricerca">
    </form>
</body>

</html>