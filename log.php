<!DOCTYPE html>
<html>
<head>
	<title>Historico</title>
	<style>
			table, th, td 
			{
			  border: 1px solid black;
			  border-collapse: collapse;
			}
			th, td 
			{
			  padding: 5px;
			  text-align: left;
			}
		</style>
</head>
<body>
	<div align="center">
		<h1>Historico</h1>
		<a href='index.php'>Voltar</a>
		<?php 
			require_once "Bd.php";
			if(isset($_COOKIE['login']))
			{
				echo "<table align='center'>
				<tr>
					<th>LOG ID</th>
					<th>Usuario</th>
					<th>Descricao</th>
					<th>Data</th>
				</tr>";
				$query = new Bd();
				$cons = $query->Log($_COOKIE['login'],$_COOKIE['senha']);
				foreach ($cons as $linha => $user) 
				{
					echo "<tr>";
					foreach ($user as $dado => $valor) 
					{
						echo "<td>$valor</td>";
					}
					echo "</tr>";
				}
			}
		?>




	</div>
</body>
</html>