<?php

	include_once('connessioneBiblioteca.php');

	$sql = "SELECT * FROM SUCCURSALE";
	$query = mysqli_query($link, $sql);
	if(!$query) {

		include('navbar.html');
		echo "<h2>Errore nel caricamento della home</h2>";
		exit(-1);

	}

	mysqli_close($link);

?>

<!DOCTYPE html>
<html>

	<head>
		<?php include('navbar.html'); ?>
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
		<h2>Contatti delle sedi delle biblioteche di ateneo</h2>
		<table>
			<thead>
				<tr>
					<th>Nome Succursale</th>
					<th>Indirizzo Succursale</th>
					<th>Numero di telefono</th>
				</tr>
			</thead>

			<tbody>
				<?php while($row = mysqli_fetch_array($query)) { ?>
					<tr>
						<td> <?php echo $row['NOME_SUCCURSALE'] ?> </td>
						<td> <?php echo $row['INDIRIZZO_SUCCURSALE'] ?> </td>
						<td> <?php echo $row['NUMERO_TELEFONO'] ?> </td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</body>

</html>