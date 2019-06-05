<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro</title>
	</head>
	<form method="POST" align="center">
		<h1>Cadastro</h1>
		<input type="text" name="log" placeholder="Login"><br/>
		<input type="password" name="sen" placeholder="Senha"><br/>
		<input type="password" name="conf" placeholder="Confirmar senha"><br/>
		<input type="submit" name="ok" value="Cadastrar"><br/>
		<a href="index.php">Voltar</a></br>
		<?php 
			require_once "Bd.php";
			if(isset($_POST['ok']))
			{
				if($_POST['log']<>'' && $_POST['sen']<>'')
				{
					if($_POST['sen']===$_POST['conf'])
					{
						$login = $_POST['log'];
						$senha = $_POST['sen'];
						$valida = true;
						$cad = new Bd();
						$cons = $cad->Consulta($_COOKIE['login'], $_COOKIE['senha']);
						foreach ($cons as $nUser => $vetor) 
						{
							if($vetor['userLogin']===$login)
							{
								$valida = false;
							}
						}
						if($valida)
						{
							$res = $cad->Adicionar($_COOKIE['login'], $_COOKIE['senha'], $login, $senha);
							if($res)
							{
								echo "Usuario cadastrado.";
							}
							else
							{
								echo "Erro ao cadastrar.";
							}
						}						
						else
						{
							echo "Este usuario ja existe.";
						}
					}
					else
					{
						echo "As senhas nao conferem.";
					}
				}
				else
				{
					echo "Campo vazio.";
				}
			}
		?>
	</form>
</html>