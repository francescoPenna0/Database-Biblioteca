<?php

include_once('connessioneBiblioteca.php');

$N_MATRICOLA = $_POST['N_MATRICOLA'];
$NOME_UTENTE = $_POST['NOME_UTENTE'];
$COGNOME_UTENTE = $_POST['COGNOME_UTENTE'];
$INDIRIZZO = $_POST['INDIRIZZO'];
$N_TELEFONO = $_POST['N_TELEFONO'];

if ($N_MATRICOLA == '' || $NOME_UTENTE == '' || $COGNOME_UTENTE == '') {
    include_once('navbar.html');
    echo "<p>Inserire le informazioni Numero di Matricola, Nome e Cognome</p>";
    exit(-2);
}

$sql = "INSERT INTO UTENTI VALUES('$N_MATRICOLA', '$NOME_UTENTE', '$COGNOME_UTENTE', '$INDIRIZZO', '$N_TELEFONO')";
$query = mysqli_query($link, $sql);

if (!$query) {
    include_once('navbarUTENTE.html');
    echo "<p>Si è verificato un errore nell'inserire i dati</p>";
    echo "<p>$sql</p>";
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
        <h2>Inserimento dell'Utente <?php echo "$N_MATRICOLA $NOME_UTENTE $COGNOME_UTENTE" ?> completato</h1>
            <h3>
                <form action="Utente.php">
                    <button type="submit">
                        Inserisci nuovo Utente
                    </button>
                </form>
            </h3>
    </body>
<html>