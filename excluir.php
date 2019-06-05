<!DOCTYPE html>
<html>
	<head>
		<title>Excluir</title>
	</head>
	<form align="center" method="POST">
		<h1>Excluir usuario:</h1>
			<?php
				require_once "Bd.php";
				$query = new Bd();
				$nome = $query->Consulta($_COOKIE['login'], $_COOKIE['senha'], $_GET['id']);
				if($_COOKIE['login'] <> $nome['0']['userLogin'])
				{
					echo "ID: ".$nome['0']['idUser']."</br>";
					echo "NOME: ".$nome['0']['userLogin']."</br>";
					echo "<select name='opc'>
							<option value='sim'>sim</option>
							<option value='nao' selected>nao</option>
						</select>
						<input type='submit' value='OK'>";
					if(isset($_POST['opc']))
					{
						if($_POST['opc']==='sim')
						{
							$rem = $query->Remover($_COOKIE['login'], $_COOKIE['senha'], $_GET['id']);
							if($rem) 
							{
								header('Location:index.php');
							}
							else
							{
								echo "</br>Usuario nao foi removido.";
							}
						}
					}
				}
				else
				{
					header('Location:index.php');
				}
			?>
		</br><a href="index.php">Voltar</a>
	</form>
</html method="POST">