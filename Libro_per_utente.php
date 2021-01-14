<?php

include_once('connessioneBiblioteca.php');

$N_MATRICOLA = $_POST['N_MATRICOLA'];
$NOME_UTENTE = $_POST['NOME_UTENTE'];
$COGNOME_UTENTE = $_POST['COGNOME_UTENTE'];

$sql = "SELECT CODICE_LIBRO,ISBN,TITOLO, LINGUA, ANNO_PUBBLICAZIONE
            FROM UTENTI AS U,EFFETTUA AS E,LIBRO AS L,CONCESSO AS C
            WHERE L.CODICE_LIBRO=C.CODICE_LIBRO_CONCESSO 
            AND E.CODICE_PRESTITO_EFFETTUA=C.CODICE_PRESTITO_CONCESSO 
            AND E.N_MATRICOLA_EFFETTUA=U.N_MATRICOLA
            AND (U.N_MATRICOLA = '$N_MATRICOLA' OR U.NOME_UTENTE='$NOME_UTENTE' OR U.COGNOME_UTENTE='$COGNOME_UTENTE') 
            ORDER BY CODICE_LIBRO ASC;";

$query = mysqli_query($link, $sql);

if (!$query) {
    include_once('navbar.html');
    echo "<p>Si è verificato un errore nel cercare i dati</p>";
    echo "<p>$sql</p>";
    exit(-2);
}

mysqli_close($link);

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
    <?php include_once('navbarRICERCA.html'); ?>

    <h2>Prestiti di <?php echo "$N_MATRICOLA $NOME_UTENTE $COGNOME_UTENTE" ?> </h2>

    <table>
        <thead>
            <tr>
                <th>Codice Libro</th>
                <th>ISBN</th>
                <th>Titolo</th>
                <th>Lingua</th>
                <th>Anno di Pubblicazione</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td> <?php echo $row['CODICE_LIBRO'] ?> </td>
                    <td> <?php echo $row['ISBN'] ?> </td>
                    <td> <?php echo $row['TITOLO'] ?> </td>
                    <td> <?php echo $row['LINGUA'] ?> </td>
                    <td> <?php echo $row['ANNO_PUBBLICAZIONE'] ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>
        <form action="Libro_per_utente_form.php">
            <button type="submit">
                Nuova Ricerca
            </button>
        </form>
    </p>
</body>

</html>