<?php

    include_once('connessioneBiblioteca.php');

    $N_MATRICOLA = $_POST['N_MATRICOLA'];

    $verificaPrestiti = "SELECT CODICE_PRESTITO_EFFETTUA FROM EFFETTUA
                        WHERE $N_MATRICOLA=N_MATRICOLA_EFFETTUA";
    $queryVerificaPrestiti = mysqli_query($link, $verificaPrestiti);
    if(!$queryVerificaPrestiti) {

        include('navbar.html');
        echo "<p>Si è verificato un errore nel controllare la situazione prestiti dell'utente</p>";
        exit(-2);

    }
    $row = mysqli_fetch_array($queryVerificaPrestiti); // basta che ci sia una riga perché ci siano prestiti registrati
    if($row['CODICE_PRESTITO_EFFETTUA'] != '') {

        include('navbar.html');
        echo "<h2>Impossibile eliminare l'utente $N_MATRICOLA in quanto ha ancora prestiti in sospeso</h2>";
        exit(-2);

    }

    $sql = "DELETE FROM UTENTI WHERE N_MATRICOLA = '$N_MATRICOLA'";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        include('navbar.html');
        echo "<p>Si è verificato un errore nell'eliminare l'utente</p>";
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
        <h2>Eliminazione completata</h2>
        <h3>
            <form action="Elimina_utente_form.php">
                <button type="submit">
                    Elimina un altro Utente
                </button>
            </form>
            <h3>
    </body>

</html>