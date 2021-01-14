<?php

    include_once('connessioneBiblioteca.php');

    $N_MATRICOLA = $_POST['N_MATRICOLA'];
    $NOME_UTENTE = $_POST['NOME_UTENTE'];
    $COGNOME_UTENTE = $_POST['COGNOME_UTENTE'];
    $INDIRIZZO = $_POST['INDIRIZZO'];
    $N_TELEFONO = $_POST['N_TELEFONO'];

    // la filosofia è: se nel form una variabile non è inserita assumo di non volerla cambiare, quindi eseguo una query per ottenere la chiave da 
    // non cambiare e nella query di modifica reinserisco lo stesso valore
    if($NOME_UTENTE == '') { // la strcmp è identica al c, quindi se le due stringhe sono uguali

        $nonModificare = "SELECT NOME_UTENTE FROM UTENTI WHERE N_MATRICOLA='$N_MATRICOLA'";
        $query = mysqli_query($link, $nonModificare);
        if(!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore nell'ottenere il nome utente</p>";
            exit(-1);
        }
        while($row = mysqli_fetch_array($query)) {
            $NOME_UTENTE = $row['NOME_UTENTE']; // se non ho inserito nel form il nome utente inserisco quello che c'è già presente -> non lo cambio
        }
    }

    if($COGNOME_UTENTE == '') { 

        $nonModificare = "SELECT COGNOME_UTENTE FROM UTENTI WHERE N_MATRICOLA='$N_MATRICOLA'";
        $query = mysqli_query($link, $nonModificare);
        if(!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore nell'ottenere il cognome utente</p>";
            exit(-1);
        }
        while($row = mysqli_fetch_array($query)) {
            $COGNOME_UTENTE = $row['COGNOME_UTENTE']; 
        }
    }

    if($INDIRIZZO == '') { 

        $nonModificare = "SELECT INDIRIZZO FROM UTENTI WHERE N_MATRICOLA='$N_MATRICOLA'";
        $query = mysqli_query($link, $nonModificare);
        if(!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore nell'ottenere l'indirizzo utente</p>";
            exit(-1);
        }
        while($row = mysqli_fetch_array($query)) {
            $INDIRIZZO = $row['INDIRIZZO']; 
        }
    }

    if($N_TELEFONO == '') { 

        $nonModificare = "SELECT N_TELEFONO FROM UTENTI WHERE N_MATRICOLA='$N_MATRICOLA'";
        $query = mysqli_query($link, $nonModificare);
        if(!$query) {
            include_once('navbar.html');
            echo "<p>Si è verificato un errore nell'ottenere il numero di telefono</p>";
            exit(-1);
        }
        while($row = mysqli_fetch_array($query)) {

            $N_TELEFONO = $row['N_TELEFONO']; 

        }
    }

    $sql = "UPDATE UTENTI SET NOME_UTENTE='$NOME_UTENTE', COGNOME_UTENTE='$COGNOME_UTENTE', INDIRIZZO='$INDIRIZZO', N_TELEFONO='$N_TELEFONO' WHERE N_MATRICOLA='$N_MATRICOLA'";
    $query = mysqli_query($link, $sql);
    if(!$query) {
        include_once('navbar.html');
        echo "<p>Si è verificato un errore nell'inserire i dati</p>";
        exit(-2);
    }

    mysqli_close($link);

?>

<!DOCTYPE html>
<html>

    <head>
        <h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
        <?php include_once('navbarUTENTE.html'); ?>
    </head>

    <body>
        <h2>Modifica dell'Utente eseguita</h1>
        <h2>
        <form action="Modifica_utente_form.php">
            <button type="submit">
                Modifica un altro Utente
            </button>
        </form>
    </h2>
    </body>
<html>