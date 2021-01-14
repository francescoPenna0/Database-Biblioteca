<?php

include_once('connessioneBiblioteca.php');

$sql = "SELECT CODICE_EDITORE,NOME_EDITORE,N_LIBRI_PUBBLICATI
            FROM EDITORE AS E, (SELECT CODICE_EDITORE_PUBBLICA, COUNT(CODICE_EDITORE_PUBBLICA) AS N_LIBRI_PUBBLICATI
                                FROM PUBBLICA  
                                GROUP BY CODICE_EDITORE_PUBBLICA
                                HAVING COUNT(CODICE_EDITORE_PUBBLICA)=(SELECT MAX(N) 
                                                                        FROM (SELECT CODICE_EDITORE_PUBBLICA, COUNT(CODICE_EDITORE_PUBBLICA) AS N 
                                                                                FROM PUBBLICA
                                                                                GROUP BY CODICE_EDITORE_PUBBLICA) AS CASA_EDITRICE)) AS N_LIBRI
    WHERE E.CODICE_EDITORE=N_LIBRI.CODICE_EDITORE_PUBBLICA";

$query = mysqli_query($link, $sql);
if (!$query) {
    include_once('navbar.html');
    echo "<p>Si è verificato un errore nel caricare i dati</p>";
    echo "<p>$sql</p>";
    exit(-2);
}

mysqli_close($link);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="http://www.unife.it/favicon.ico">
    <title>Sistema bibliotecario dell'università di Ferrara</title>
    <link rel="stylesheet" type="text/css" href="stylenavbar.css">
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

    <h2>L'Editore che ha pubblicato più libri</h2>

    <table>
        <thead>
            <tr>
                <th>Codice Editore</th>
                <th>Editore</th>
                <th>Numero Libri Pubblicati</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td> <?php echo $row['CODICE_EDITORE'] ?> </td>
                    <td> <?php echo $row['NOME_EDITORE'] ?> </td>
                    <td> <?php echo $row['N_LIBRI_PUBBLICATI'] ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>