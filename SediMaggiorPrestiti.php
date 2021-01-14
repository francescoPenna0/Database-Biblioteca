<?php

include_once('connessioneBiblioteca.php');

$sql = "SELECT NOME_SUCCURSALE_PRESTITO,COD_P
        FROM    (SELECT NOME_SUCCURSALE_PRESTITO, COUNT(CODICE_PRESTITO) AS COD_P
		        FROM PRESTITO
		        GROUP BY NOME_SUCCURSALE_PRESTITO
		        HAVING COUNT(CODICE_PRESTITO)=  (SELECT MAX(CP)
						                        FROM(SELECT NOME_SUCCURSALE_PRESTITO, COUNT(CODICE_PRESTITO) AS CP
						                        FROM PRESTITO
                                        	    GROUP BY NOME_SUCCURSALE_PRESTITO
                                        	    ORDER BY CP DESC)AS MAX)) AS MAX_PRESTITO
ORDER BY NOME_SUCCURSALE_PRESTITO ASC;";



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

    <h2>La Sede che registra il numero più alto di prestiti</h2>

    <table>
        <thead>
            <tr>
                <th>Sede</th>
                <th>Numero di Prestiti</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td> <?php echo $row['NOME_SUCCURSALE_PRESTITO'] ?> </td>
                    <td> <?php echo $row['COD_P'] ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>