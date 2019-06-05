<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
	</head>
	<form align="center" method="POST">
	    <h1>Login</h1>
		<input type="text" name="log" placeholder="Login"><br/>
		<input type="password" name="sen" placeholder="Senha"><br/>
		<input type="submit" name="ok" value="Login"><br/>
	    <?php 
        	require_once "Bd.php";
        	if(isset($_POST['ok']))
        	{
        		$login = $_POST['log'];
        		$senha = $_POST['sen'];
        		$valida = new Bd();
        		$res = $valida->Valida($login, $senha);
        		if($res)
        		{
        			setcookie('login',$login);
        			setcookie('senha',$senha);
        			header('Location: index.php');
        		}
        		else
        		{
        			echo "Login e/ou Senha incorretos.";
        		}
        	}
        ?>
	</form>
</html>