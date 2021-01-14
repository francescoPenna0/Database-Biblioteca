<?php

    include_once('connessioneBiblioteca.php');

    $CODICE_LIBRO_CONCESSO = $_POST['CODICE_LIBRO_CONCESSO']; /*COSA*/
    $N_MATRICOLA_EFFETTUA = $_POST['N_MATRICOLA_EFFETTUA']; /*A CHI*/
    $DATA_INIZIO_PRESTITO = $_POST['DATA_INIZIO_PRESTITO']; /*QUANDO*/
    $DATA_FINE_PRESTITO = $_POST['DATA_FINE_PRESTITO']; /*FINO A*/
    $NOME_SUCCURSALE_PRESTITO = $_POST['NOME_SUCCURSALE_PRESTITO']; /*DOVE*/

    // query per verificare i dati inseriti
    $verificaMatricola = "SELECT N_MATRICOLA FROM UTENTI WHERE N_MATRICOLA=$N_MATRICOLA_EFFETTUA";
    $queryVerificaMatricola = mysqli_query($link, $verificaMatricola);
    if(!$queryVerificaMatricola) {

        include_once('navbar.html');
        echo "<p>Errore nel cercare il numero di matricola</p>";
        exit(-2);

    }
    $row = mysqli_fetch_array($queryVerificaMatricola);
    if($row['N_MATRICOLA'] == '') {

        include_once('navbar.html');
        echo "<p>Errore, il numero di matricola selezionato non è registrato</p>";
        exit(-2);

    }

    $verificaLibro = "SELECT CODICE_LIBRO FROM LIBRO WHERE CODICE_LIBRO=$CODICE_LIBRO_CONCESSO";
    $queryVerificaLibro = mysqli_query($link, $verificaLibro);
    if(!$queryVerificaLibro) {

        include_once('navbar.html');
        echo "<p>Errore nel cercare il codice del libro</p>";
        exit(-2);

    }
    $row = mysqli_fetch_array($queryVerificaLibro);
    if($row['CODICE_LIBRO'] == '') {

        include_once('navbar.html');
        echo "<p>Errore, il libro selezionato non è registrato<p>";
        exit(-2);

    } 

    // query per generare il codice del prestito
    $getMaxCod = "SELECT MAX(CODICE_PRESTITO) FROM PRESTITO";
    $queryMax = mysqli_query($link, $getMaxCod);
    if (!$queryMax) {

        include_once('navbar.html');
        echo "<p>Si è verificato nell'ottenere il codice prestito</p>";
        exit(-2);
    }
    while ($row = mysqli_fetch_array($queryMax)) {

        $CODICE_PRESTITO = $row['MAX(CODICE_PRESTITO)'];
    }
    $CODICE_PRESTITO = $CODICE_PRESTITO + 1;

    // query per trovare il numero di copie
    $sql3 = "SELECT NUMERO_COPIE FROM PRESENTE_IN WHERE $CODICE_LIBRO_CONCESSO=CODICE_LIBRO_PRESENTE_IN 
            AND '$NOME_SUCCURSALE_PRESTITO'=NOME_SUCCURSALE_PRESENTE_IN";
    $query3 = mysqli_query($link, $sql3);
    if (!$query3) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore</p>";
        exit(-3);
    }
    while ($row = mysqli_fetch_array($query3)) {

        $NUMERO_COPIE = $row['NUMERO_COPIE'];
    }
    if ($NUMERO_COPIE == 0) {

        include_once('navbar.html');
        echo "<h2>Prestito attualmente non disponibile in questa succursale</h2>";
        exit(-6);
    } else {

        $NUMERO_COPIE = $NUMERO_COPIE - 1;
        $aggiornaCopie = "UPDATE PRESENTE_IN SET NUMERO_COPIE='$NUMERO_COPIE' WHERE $CODICE_LIBRO_CONCESSO=CODICE_LIBRO_PRESENTE_IN AND NOME_SUCCURSALE_PRESENTE_IN='$NOME_SUCCURSALE_PRESTITO'";
        $queryAggiornaCopie = mysqli_query($link, $aggiornaCopie);
        if (!$queryAggiornaCopie) {

            include_once('navbar.html');
            echo "<p>Si è verificato un errore nell'inserire i dati</p>";
            exit(-2);
        }
    }

    // inserimento in prestito, effetua e concesso
    $sql = "INSERT INTO PRESTITO VALUES('$CODICE_PRESTITO','$DATA_INIZIO_PRESTITO','$DATA_FINE_PRESTITO','$NOME_SUCCURSALE_PRESTITO')";
    $query = mysqli_query($link, $sql);
    if (!$query) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore nell'inserire i dati</p>";
        exit(-2);
    }

    $CODICE_PRESTITO_EFFETTUA = $CODICE_PRESTITO;
    $sql1 = "INSERT INTO EFFETTUA VALUES('$N_MATRICOLA_EFFETTUA','$CODICE_PRESTITO_EFFETTUA')";
    $query1 = mysqli_query($link, $sql1);
    if (!$query1) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore nell'inserire i dati</p>";
        exit(-3);
    }

    $CODICE_PRESTITO_CONCESSO = $CODICE_PRESTITO;
    $sql2 = "INSERT INTO CONCESSO VALUES('$CODICE_LIBRO_CONCESSO','$CODICE_PRESTITO_CONCESSO')";
    $query2 = mysqli_query($link, $sql2);
    if (!$query2) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore nell'inserire i dati</p>";
        exit(-4);
    }

    mysqli_close($link);

?>

<!DOCTYPE html>
<html>
    <head>
        <h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
        <?php include_once('navbarPRESTITO.html'); ?>
    </head>

    <body>
        
        <h2>Registrazione prestito completata</h2>
        <h3>
            <form action="Prestito.php">
                <button type="submit">
                    Inserisci nuovo Prestito
                </button>
            </form>
            <h3>
    </body>

</html>