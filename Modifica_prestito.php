<?php

    include_once('connessioneBiblioteca.php');

    $CODICE_PRESTITO = $_POST['CODICE_PRESTITO'];
    $CODICE_LIBRO_CONCESSO = $_POST['CODICE_LIBRO_CONCESSO'];
    $N_MATRICOLA_EFFETTUA = $_POST['N_MATRICOLA_EFFETTUA'];
    $DATA_INIZIO_PRESTITO = $_POST['DATA_INIZIO_PRESTITO'];
    $DATA_FINE_PRESTITO = $_POST['DATA_FINE_PRESTITO'];
    $NOME_SUCCURSALE_PRESTITO = $_POST['NOME_SUCCURSALE_PRESTITO'];

    // query per verificare che esistano i parametri passati
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

    // verifica dei dati inseriti
    if ($CODICE_LIBRO_CONCESSO == '') {

        $nonModificare = "SELECT CODICE_LIBRO_CONCESSO FROM CONCESSO WHERE CODICE_PRESTITO_CONCESSO=$CODICE_PRESTITO";
        $query = mysqli_query($link, $nonModificare);
        if (!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore in: $nonModificare</p>";
            exit(-1);
        }
        while ($row = mysqli_fetch_array($query)) {
            $CODICE_LIBRO_CONCESSO = $row['CODICE_LIBRO_CONCESSO'];
        }
    }

    if ($N_MATRICOLA_EFFETTUA == '') {

        $nonModificare = "SELECT N_MATRICOLA_EFFETTUA FROM EFFETTUA WHERE CODICE_PRESTITO_EFFETTUA=$CODICE_PRESTITO";
        $query = mysqli_query($link, $nonModificare);
        if (!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore in: $nonModificare</p>";
            exit(-1);
        }
        while ($row = mysqli_fetch_array($query)) {
            $N_MATRICOLA_EFFETTUA = $row['N_MATRICOLA_EFFETTUA'];
        }
    }

    if ($DATA_INIZIO_PRESTITO == '') {

        $nonModificare = "SELECT DATA_INIZIO_PRESTITO FROM PRESTITO WHERE CODICE_PRESTITO=$CODICE_PRESTITO";
        $query = mysqli_query($link, $nonModificare);
        if (!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore in: $nonModificare</p>";
            exit(-1);
        }
        while ($row = mysqli_fetch_array($query)) {
            $DATA_INIZIO_PRESTITO = $row['DATA_INIZIO_PRESTITO'];
        }
    }

    if ($DATA_FINE_PRESTITO == '') {

        $nonModificare = "SELECT DATA_FINE_PRESTITO FROM PRESTITO WHERE CODICE_PRESTITO=$CODICE_PRESTITO";
        $query = mysqli_query($link, $nonModificare);
        if (!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore in: $nonModificare</p>";
            exit(-1);
        }
        while ($row = mysqli_fetch_array($query)) {
            $DATA_FINE_PRESTITO = $row['DATA_FINE_PRESTITO'];
        }
    }

    if ($NOME_SUCCURSALE_PRESTITO == '') {

        $nonModificare = "SELECT NOME_SUCCURSALE_PRESTITO FROM PRESTITO WHERE CODICE_PRESTITO=$CODICE_PRESTITO";
        $query = mysqli_query($link, $nonModificare);
        if (!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore in: $nonModificare</p>";
            exit(-1);
        }
        while ($row = mysqli_fetch_array($query)) {
            $NOME_SUCCURSALE_PRESTITO = $row['NOME_SUCCURSALE_PRESTITO'];
        }
    }

    // verifica succursale di rientro, se è presente in PRESENTE_IN per quel libro allora non devo modificare, sennò la aggiungo per permettere il rientro
    $getSuccursali = "SELECT NOME_SUCCURSALE_PRESENTE_IN
                            FROM PRESENTE_IN
                            where CODICE_LIBRO_PRESENTE_IN=$CODICE_LIBRO_CONCESSO";
    $queryGetSuccursali = mysqli_query($link, $getSuccursali);
    if (!$queryGetSuccursali) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore con: $getSuccursali</p>";
        exit(-1);
    }
    while ($row = mysqli_fetch_array($queryGetSuccursali)) { // scorro l'output per verificare che nome_succursale_prestito sia in presente_in

        if ($row['NOME_SUCCURSALE_PRESENTE_IN'] == $NOME_SUCCURSALE_PRESTITO) {
            $succursalePresente = 1; // se trovo la succursale in presente in esco
            break;
        }
        $succursalePresente = 0; // se non la trovo setto la variabile a false

    }
    if ($succursalePresente == 0) { // se la succursale non era presente

        $inserisciSuccursale = "INSERT INTO PRESENTE_IN VALUES('$CODICE_LIBRO_CONCESSO', '$NOME_SUCCURSALE_PRESTITO', '0')"; // inserisco 0 copie per inizializzare
        $queryInserisciSuccursale = mysqli_query($link, $inserisciSuccursale);
        if (!$queryInserisciSuccursale) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore con: $inserisciSuccursale</p>";
            exit(-1);
        }
    }

    // modifica dei dati inseriti
    $updatePrestito = "UPDATE PRESTITO SET DATA_INIZIO_PRESTITO='$DATA_INIZIO_PRESTITO', DATA_FINE_PRESTITO='$DATA_FINE_PRESTITO', 
        NOME_SUCCURSALE_PRESTITO='$NOME_SUCCURSALE_PRESTITO' WHERE CODICE_PRESTITO='$CODICE_PRESTITO'";
    $queryUpdatePrestito = mysqli_query($link, $updatePrestito);
    if (!$queryUpdatePrestito) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore in: $updatePrestito</p>";
        exit(-1);
    }

    $updateConcesso = "UPDATE CONCESSO SET CODICE_LIBRO_CONCESSO=$CODICE_LIBRO_CONCESSO WHERE CODICE_PRESTITO_CONCESSO=$CODICE_PRESTITO";
    $queryUpdateConcesso = mysqli_query($link, $updateConcesso);
    if (!$queryUpdateConcesso) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore in: $updateConcesso</p>";
        exit(-1);
    }

    $updateEffettua = "UPDATE EFFETTUA SET N_MATRICOLA_EFFETTUA=$N_MATRICOLA_EFFETTUA WHERE CODICE_PRESTITO_EFFETTUA=$CODICE_PRESTITO";
    $queryUpdateEffettua = mysqli_query($link, $updateEffettua);
    if (!$queryUpdateEffettua) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore in: $updateEffettua</p>";
        exit(-1);
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
        <h2>Modifica del prestito eseguita</h2>
        <h3>
            <form action="Modifica_prestito_form.php">
                <button type="submit">
                    Nuova Ricerca
                </button>
            </form>
            <h3>
    </body>

</html>