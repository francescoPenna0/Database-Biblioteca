<?php

include_once('connessioneBiblioteca.php');

$CODICE_PRESTITO = $_POST['CODICE_PRESTITO'];

if (strlen($CODICE_PRESTITO) == 0) {

    $query = "SELECT N_MATRICOLA, NOME_UTENTE, COGNOME_UTENTE, CODICE_LIBRO, TITOLO, ISBN, CODICE_PRESTITO, DATA_INIZIO_PRESTITO, 
              DATA_FINE_PRESTITO, NOME_SUCCURSALE_PRESTITO 
              from PRESTITO, EFFETTUA, UTENTI, CONCESSO, LIBRO
              where CODICE_PRESTITO=CODICE_PRESTITO_EFFETTUA and N_MATRICOLA_EFFETTUA=N_MATRICOLA 
              and CODICE_PRESTITO=CODICE_PRESTITO_CONCESSO and CODICE_LIBRO_CONCESSO=CODICE_LIBRO
              order by CODICE_PRESTITO";
    $result = mysqli_query($link, $query);
    if (!$result) {
        include_once('navbar.html');
        echo "<p>Si è verificato un nel mostrare la situazione prestiti</p>";
        exit(-2);
    }
} else {

    $query = "SELECT N_MATRICOLA, NOME_UTENTE, COGNOME_UTENTE, CODICE_LIBRO, TITOLO, ISBN, CODICE_PRESTITO, DATA_INIZIO_PRESTITO, 
                DATA_FINE_PRESTITO, NOME_SUCCURSALE_PRESTITO 
                from PRESTITO, EFFETTUA, UTENTI, CONCESSO, LIBRO
                where $CODICE_PRESTITO=CODICE_PRESTITO and $CODICE_PRESTITO=CODICE_PRESTITO_EFFETTUA and N_MATRICOLA_EFFETTUA=N_MATRICOLA 
                and $CODICE_PRESTITO=CODICE_PRESTITO_CONCESSO and CODICE_LIBRO_CONCESSO=CODICE_LIBRO";
    $result = mysqli_query($link, $query);
    if (!$result) {
        include_once('navbar.html');
        echo "<p>Si è verificato un nel mostrare la situazione prestiti</p>";
        exit(-2);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sistema bibliotecario dell'università di Ferrara</title>
    <link rel="stylesheet" type="text/css" href="stylenavbar.css">
    <link rel="shortcut icon" type="image/x-icon" href="http://www.unife.it/favicon.ico">
    <style>
        fieldset {
            border: none;
            margin-bottom: 20px;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
        }

        tr {
            border-bottom: 1px solid #ccc;
        }

        th {
            /*border-right: 1px solid #ccc;*/
            color: navy;
            width: 120px;
            padding: 8px;
        }

        td {
            /*border-right: 1px solid #ccc; */
            text-align: center;
            padding: 10px;
        }

        td:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
    <?php include_once('navbarPRESTITO.html'); ?>

    <table>
        <thead>
            <tr>
                <th>Codice Prestito</th>
                <th>Numero di Matricola</th>
                <th>Nome Utente</th>
                <th>Cognome Utente</th>
                <th>Codice Libro</th>
                <th>Titolo</th>
                <th>ISBN</th>
                <th>Data Inizio Prestito</th>
                <th>Data Fine Prestito</th>
                <th>Succursale</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td> <?php echo $row['CODICE_PRESTITO'] ?> </td>
                    <td> <?php echo $row['N_MATRICOLA'] ?> </td>
                    <td> <?php echo $row['NOME_UTENTE'] ?> </td>
                    <td> <?php echo $row['COGNOME_UTENTE'] ?> </td>
                    <td> <?php echo $row['CODICE_LIBRO'] ?> </td>
                    <td> <?php echo $row['TITOLO'] ?> </td>
                    <td> <?php echo $row['ISBN'] ?> </td>
                    <td> <?php echo $row['DATA_INIZIO_PRESTITO'] ?> </td>
                    <td> <?php echo $row['DATA_FINE_PRESTITO'] ?> </td>
                    <td> <?php echo $row['NOME_SUCCURSALE_PRESTITO'] ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>
        <form action="Situazione_prestiti_form.php">
            <button type="submit">
                Nuova Ricerca
            </button>
        </form>
    </p>
</body>

</html>