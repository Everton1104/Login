<!DOCTYPE html>
<html>
	<head>
		<title>Inicio</title>
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
	<form method="POST">
		<div align="center">
			<h1>Bem vindo 
			<?php 
				require_once "Bd.php";
				if(isset($_COOKIE['login']))
				{
					echo $_COOKIE['login']."</h1>";
					echo "<p><b>Tabela de usuarios</b></p>";
					echo "<table align='center'>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Senha</th>
						<th>Data</th>
					</tr>";
					$query = new Bd();
					$cons = $query->Consulta($_COOKIE['login'],$_COOKIE['senha']);
					foreach ($cons as $linha => $user) 
					{
						echo "<tr>";
						foreach ($user as $dado => $valor) 
						{
							echo "<td>$valor</td>";
						}
						$id = $user['idUser'];
						echo "<td><input type='submit' value='Excluir' formaction='excluir.php?id=$id'></td>
							<td><input type='submit' value='Alterar' formaction='alterar.php?id=$id'></td>
							</tr>";
					}
					echo "<a href='cadastro.php'>Cadastro</a> - ";
					echo "<a href='log.php'>Historico</a> - ";
				}
				else
				{
					echo "Convidado </h1><p>Por favor <a href='login.php'>identifique-se</a></p>";
				}
				echo "<input type='submit' value='SAIR' name='logout' formaction='login.php'>";
			?>
		</div>
	</form>
</html>