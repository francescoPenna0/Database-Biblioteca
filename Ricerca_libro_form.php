<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sistema bibliotecario dell'università di Ferrara</title>
    <link rel="stylesheet" type="text/css" href="stylenavbar.css">
    <link rel="shortcut icon" type="image/x-icon" href="http://www.unife.it/favicon.ico">
    <h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
    <?php include_once('navbarRICERCA.html'); ?>

    <style>
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            font-size: 24px;
        }

        input[type="submit"] {
            background-color: navy;
            border: none;
            color: white;
            padding: 10px 40px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: gainsboro;
            color: navy;
        }
    </style>
</head>

<body>
    <h2>Ricerca un libro in tutte le succursali registrate</h2>
    <p>Inserisci il titolo del libro o solo una parte poi Cerca per cercarlo all'interno delle succursali, 
        altrimenti premi Cerca per visualizzarli tutti</p>
    <form action="Ricerca_libro.php" method="POST">

        <fieldset>
            <input type="text" name="TITOLO" placeholder="Search..">
        </fieldset>

        <input type="submit" value="Cerca">
    </form>
</body>

</html>