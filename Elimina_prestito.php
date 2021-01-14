<?php

include_once('connessioneBiblioteca.php');

$CODICE_PRESTITO = $_POST['CODICE_PRESTITO'];

// query per trovare il numero di copie e aggiornarlo 
$getNumeroCopie = "SELECT NUMERO_COPIE, NOME_SUCCURSALE_PRESTITO, CODICE_LIBRO_PRESENTE_IN
                        FROM PRESTITO, CONCESSO, PRESENTE_IN
                        WHERE CODICE_PRESTITO=$CODICE_PRESTITO AND $CODICE_PRESTITO=CODICE_PRESTITO_CONCESSO
                        AND CODICE_LIBRO_CONCESSO=CODICE_LIBRO_PRESENTE_IN 
                        AND NOME_SUCCURSALE_PRESTITO=NOME_SUCCURSALE_PRESENTE_IN";
$queryNumeroCopie = mysqli_query($link, $getNumeroCopie);
if (!$queryNumeroCopie) {
    include('navbar.html');
    echo "<p>Si è verificato un errore nell'ottenere il numero di copie</p>";
    exit(-3);
}
while ($row = mysqli_fetch_array($queryNumeroCopie)) {

    $NUMERO_COPIE = $row['NUMERO_COPIE'];
    $NOME_SUCCURSALE_PRESTITO = $row['NOME_SUCCURSALE_PRESTITO'];
    $CODICE_LIBRO_PRESENTE_IN = $row['CODICE_LIBRO_PRESENTE_IN'];
}
$NUMERO_COPIE = $NUMERO_COPIE + 1;
$aggiornaCopie = "UPDATE PRESENTE_IN SET NUMERO_COPIE='$NUMERO_COPIE' 
                      WHERE $CODICE_LIBRO_PRESENTE_IN=CODICE_LIBRO_PRESENTE_IN 
                      AND NOME_SUCCURSALE_PRESENTE_IN='$NOME_SUCCURSALE_PRESTITO'";
$queryAggiornaCopie = mysqli_query($link, $aggiornaCopie);
if (!$queryAggiornaCopie) {

    include('navbar.html');
    echo "<p>Si è verificato un errore nell'aggiornare le copie</p>";
    exit(-2);
}

// query per eliminare il prestito
$deleteEffettua = "DELETE FROM EFFETTUA WHERE $CODICE_PRESTITO=CODICE_PRESTITO_EFFETTUA";
$queryDeleteEffettua = mysqli_query($link, $deleteEffettua);
if (!$queryDeleteEffettua) {
    include('navbar.html');
    echo "<p>Si è verificato un errore nell'inserimento dei dati</p>";
    exit(-3);
}

$deleteConcesso = "DELETE FROM CONCESSO WHERE $CODICE_PRESTITO=CODICE_PRESTITO_CONCESSO";
$queryDeleteConcesso = mysqli_query($link, $deleteConcesso);
if (!$queryDeleteConcesso) {

    include('navbar.html');
    echo "<p>Si è verificato un errore nell'inserimento dei dati</p>";
    exit(-4);
}

$deletePrestito = "DELETE FROM PRESTITO WHERE $CODICE_PRESTITO=CODICE_PRESTITO";
$queryDeletePrestito = mysqli_query($link, $deletePrestito);
if (!$queryDeletePrestito) {
    include('navbar.html');
    echo "<p>Si è verificato un errore nell'inserimneto dei dati</p>";
    exit(-5);
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
        <h2>Rientro completato</h2>
        <h3>
            <form action="Elimina_prestito_form.php">
                <button type="submit">
                    Elimina un altro Prestito
                </button>
            </form>
            <h3>
    </body>

</html>