<!DOCTYPE html>
<html>
	<head>
		<title>Alterar</title>
		<style>
			P.blocktext
			{
				margin-left: auto;
			    margin-right: auto;
			    width: 10em
			}
		</style>
	</head>
	<form align="center" method="POST">
		<h1>Alterar usuario: </h1>
		<div align="center">
			<?php
				require_once "Bd.php";
				$query = new Bd();
				$nome = $query->Consulta($_COOKIE['login'], $_COOKIE['senha'], $_GET['id']);
				echo "<P class='blocktext'>ID: ".$nome['0']['idUser']."</br>";
				echo "Nome: ".$nome['0']['userLogin']." <input type='text' name='nome' placeholder='Novo nome'></br>";
				echo "Senha: ".$nome['0']['userPass']." <input type='password' name='senha' placeholder='Nova senha'></br>";
				echo "<input type='password' name='conf' placeholder='Confirmar senha.'></br>";
				echo "Confirma alteracao? ";
				echo "<select name='opc'>
						<option value='sim'>sim</option>
						<option value='nao' selected>nao</option>
					</select>
					<input type='submit' value='OK'></p>";
				if(isset($_POST['opc']))
				{
					if($_POST['opc']==='sim')
					{
						if($_POST['senha']===$_POST['conf'])
						{
						    if($_POST['nome']<>'' && $_POST['senha']<>'')
						    {
							    $valida = true;
        						$cons = $query->Consulta($_COOKIE['login'], $_COOKIE['senha']);
        						foreach ($cons as $nUser => $vetor) 
        						{
        							if($vetor['userLogin']===$_POST['nome'])
        							{
        								if($_POST['senha']===$vetor['userPass'])
        								{
        									$valida = false;
        								}
        							}
        						}
        						if($valida)
							    {
    								$alt = $query->Alterar($_COOKIE['login'], $_COOKIE['senha'], $nome['0']['userLogin'], $nome['0']['userPass'], $_POST['nome'], $_POST['senha'], $_GET['id']);
    								if($alt) 
    								{
    									if($_COOKIE['login'] <> $nome['0']['userLogin'])
    									{
    										header('Location:index.php');
    									}
    									else
    									{
    										header('Location:login.php');
    									}
    								}
    								else
    								{
    									echo "</br>Usuario nao foi alterado.";
    								}
							    }
							    else
							    {
							        echo "</br>Esse usuario ja existe.";
							    }
						    }
						    else
						    {
						        echo "</br>Campo vazio.";
						    }
						}
						else
						{
							echo "</br>Senhas nao conferem.";
						}
					}
				}
			?>
			</br><a href="index.php">Voltar</a>
		</div>
	</form>
</html method="POST">