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

    <h2>Modifica dati prestito</h2>
    <p>Inserire il codice prestito e le informazioni che si vogliono modificare</p>

    <form action="Modifica_prestito.php" method="POST">

        <fieldset>
            <label>Codice prestito: </label></br>
            <input type="text" name="CODICE_PRESTITO">
        </fieldset>

        <p>Informazioni modificabili</p></br>

        <fieldset>
            <label>Codice Libro: </label></br>
            <input type="text" name="CODICE_LIBRO_CONCESSO">
        </fieldset>

        <fieldset>
            <label>Numero della Matricola: </label></br>
            <input type="text" name="N_MATRICOLA_EFFETTUA" minlength="6" maxlength="6">
        </fieldset>

        <fieldset>
            <label>Data Prestito: </label></br>
            <input type="date" name="DATA_INIZIO_PRESTITO">
        </fieldset>

        <fieldset>
            <label>Data Limite Restituzione: </label></br>
            <input type="date" name="DATA_FINE_PRESTITO">
        </fieldset>

        <fieldset>
            <label>Sede di restituzione: </label>
            <select name="NOME_SUCCURSALE_PRESTITO">

                <option value="Architettura">Architettura</option>
                <option value="Economia e management">Economia e management</option>
                <option value="Fisica e Scienze della Terra">Fisica e Scienze della Terra</option>
                <option value="Giurisprudenza">Giurisprudenza</option>
                <option value="Ingegneria">Ingegneria</option>
                <option value="Matematica e informatica">Matematica e informatica</option>
                <option value="Morfologia, chirurgia e medicina sperimentale">Morfologia, chirurgia e medicina sperimentale</option>
                <option value="Scienze biomediche e chirurgo specialistiche">Scienze biomediche e chirurgico specialistiche</option>
                <option value="Scienze chimiche e farmaceutiche">Scienze chimiche e farmaceutiche</option>
                <option value="Scienze della vita e biotecnologie">Scienze della vita e biotecnologie</option>
                <option value="Scienze mediche">Scienze mediche</option>
                <option value="Studi umanistici">Studi umanistici</option>

            </select>
        </fieldset>
        <input type="submit" value="Modifica">
    </form>
</body>

</html>