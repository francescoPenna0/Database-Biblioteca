<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">

        <link rel="shortcut icon" type="image/x-icon" href="http://www.unife.it/favicon.ico">

        <title>Sistema bibliotecario dell'università di Ferrara</title>
        
        <link rel="stylesheet" type="text/css" href="stylenavbar.css"> 

    <body>
        <h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
        <?php include_once('navbarUTENTE.html'); ?>

        <h2>Registrazione di un Utente</h2>
        <p>Compila il modulo qua sotto per modificare un utente</p>
        
        <form action="Inserimento_utente.php" method="POST">

            <fieldset>
                <label>Numero di Matricola: </label></br>
                <input type="text" name="N_MATRICOLA"  minlength="6" maxlength="6">
            </fieldset>

            <fieldset>
                <label>Nome: </label></br>
                <input type="text" name="NOME_UTENTE">
            </fieldset>

            <fieldset>
                <label>Cognome: </label></br>
                <input type="text" name="COGNOME_UTENTE">
            </fieldset>

            <fieldset>
                <label>Indirizzo: </label></br>
                <input type="text" name="INDIRIZZO">
            </fieldset>

            <fieldset>
                <label>Numero di Telefono: </label></br>
                <input type="text" name="N_TELEFONO" minlength="10" maxlength="15">
            </fieldset>

            <input type="submit" value="Salva">
        </form>
    </body>
</html>