<?php 
	class Bd extends PDO
	{
		private $conn;
		public function __construct()
		{
			try
			{
				$this->conn = new PDO("mysql:host=www.evertonrs.com.br;dbname=db_php", "", "");
			}
			catch(Exception $e)
			{
				$this->conn = new PDO("mysql:host=localhost;dbname=db_php", "root", "");
			}
		}

		public function Valida($login, $password)
		{
			$query = $this->conn->prepare("SELECT userLogin FROM tb_users WHERE userLogin = '$login' AND userPass = '$password';");
			$query->execute();
			$res = $query->fetchAll();
			if(isset($res[0]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function Adicionar($login, $senha, $user, $pass)
		{
			if($this->valida($login, $senha))
			{
				$query = $this->conn->prepare("INSERT INTO tb_users (userLogin, userPass) VALUES('$user', '$pass')");
				$query->execute();
				$log = $this->conn->prepare("INSERT INTO log_users (log_name, log_text) VALUES('$login', '$login cadastrou o usuario $user com a senha $pass')");
				$log->execute();
				return true;
			}
			else
			{
				return false;
			}
		}

		public function Remover($login, $senha, $id)
		{
			if($this->valida($login, $senha))
			{
				$cons = $this->Consulta($login, $senha, $id);
				$nome = $cons['0']['userLogin'];
				$log = $this->conn->prepare("INSERT INTO log_users (log_name, log_text) VALUES('$login', '$login deletou o usuario ID: $id  NOME: $nome.')");
				$log->execute();
				$query = $this->conn->prepare("DELETE FROM tb_users WHERE `idUser`='$id';");
				$query->execute();
				return true;
			}
			else
			{
				return false;
			}
		}

		public function Consulta($login, $senha, $id=0)
		{
			if($this->valida($login, $senha))
			{
				if($id > 0)
				{
					$query = $this->conn->prepare("SELECT * FROM tb_users WHERE idUser = $id");
					$query->execute();
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}
				else
				{
					$query = $this->conn->prepare("SELECT * FROM tb_users ORDER BY idUser");
					$query->execute();
					return $query->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			else
			{
				return false;
			}
		}

		public function Log($login, $senha)
		{
			if($this->valida($login, $senha))
			{
				$query = $this->conn->prepare("SELECT * FROM log_users ORDER BY id_Log");
				$query->execute();
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}
		}

		public function Alterar($login, $pass, $nomeOld, $senhaOld, $nome, $senha, $id)
		{
			if($this->valida($login, $pass))
			{
				$log = $this->conn->prepare("INSERT INTO log_users (log_name, log_text) VALUES('$login', '$login alterou o usuario ID: $id  NOME: $nomeOld para $nome e SENHA: $senhaOld para $senha.');");
				$log->execute();
				$query = $this->conn->prepare("UPDATE tb_users SET `userLogin`='$nome', `userPass`='$senha' WHERE `idUser`='$id';");
				$query->execute();
				return true;
			}
			else
			{

			}
		}
	}
?>
