<?php

	include_once('connessioneBiblioteca.php');

	$sql = "SELECT * FROM UTENTI";
	$query = mysqli_query($link, $sql);
	if(!$query) {

		include('navbarUTENTE.html');
		echo "<h2>Errore nel caricamento della home</h2>";
		exit(-1);

	}

	mysqli_close($link);

?>

<!DOCTYPE html>
<html>

	<head>
		<h1><a href="http://www.unife.it/it"><img src="https://i.ibb.co/g7bkSj3/logo-unife-navy.jpg" alt="logo-unife-navy" border="0"></a></h1>
		<?php include('navbarUTENTE.html'); ?>
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
		<h2>Utenti registrati alle biblioteche di ateneo</h2>
		<table>
			<thead>
				<tr>
					<th>Numero di matricola</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Indirizzo</th>
					<th>Numero di telefono</th>
				</tr>
			</thead>

			<tbody>
				<?php while($row = mysqli_fetch_array($query)) { ?>
					<tr>
						<td> <?php echo $row['N_MATRICOLA'] ?> </td>
                        <td> <?php echo $row['NOME_UTENTE'] ?> </td>
                        <td> <?php echo $row['COGNOME_UTENTE'] ?> </td>
                        <td> <?php echo $row['INDIRIZZO'] ?> </td>
						<td> <?php echo $row['N_TELEFONO'] ?> </td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>

</html>