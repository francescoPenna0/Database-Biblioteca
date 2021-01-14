<?php

include_once('connessioneBiblioteca.php');

$TITOLO = $_POST['TITOLO'];

if (strlen($TITOLO) == 1) {

    $query = "SELECT TITOLO, CODICE_LIBRO, ISBN, LINGUA, ANNO_PUBBLICAZIONE, NOME_SUCCURSALE_PRESENTE_IN, NUMERO_COPIE
              FROM LIBRO, PRESENTE_IN 
              WHERE CODICE_LIBRO=CODICE_LIBRO_PRESENTE_IN and TITOLO LIKE '$TITOLO%'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore nel cercare il libro</p>";
        exit(-2);
    }
    
} else {

    $query = "SELECT TITOLO, CODICE_LIBRO, ISBN, LINGUA, ANNO_PUBBLICAZIONE, NOME_SUCCURSALE_PRESENTE_IN, NUMERO_COPIE
                FROM LIBRO, PRESENTE_IN 
                WHERE CODICE_LIBRO=CODICE_LIBRO_PRESENTE_IN and TITOLO LIKE '%$TITOLO%'";
    $result = mysqli_query($link, $query);
    if (!$result) {
        include_once('navbar.html');
        echo "<p>Si è verificato un nel cercare il libro</p>";
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
    <?php include_once('navbarRICERCA.html'); ?>
    <table>
        <thead>
            <tr>
                <th>Titolo</th>
                <th>Codice</th>
                <th>ISBN</th>
                <th>Lingua</th>
                <th>Anno di Pubblicazione</th>
                <th>Copie Disponibili</th>
                <th>Succursale</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td> <?php echo $row['TITOLO'] ?> </td>
                    <td> <?php echo $row['CODICE_LIBRO'] ?> </td>
                    <td> <?php echo $row['ISBN'] ?> </td>
                    <td> <?php echo $row['LINGUA'] ?> </td>
                    <td> <?php echo $row['ANNO_PUBBLICAZIONE'] ?> </td>
                    <td> <?php echo $row['NUMERO_COPIE'] ?> </td>
                    <td> <?php echo $row['NOME_SUCCURSALE_PRESENTE_IN'] ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>
        <form action="Ricerca_libro_form.php">
            <button type="submit">
                Ricerca un libro
            </button>
        </form>
    </p>
    <p>
        <form action="disponibilitaPrestito.php">
            <button type="submit">
                Vai a Prestiti
            </button>
        </form>
    </p>
</body>

</html>