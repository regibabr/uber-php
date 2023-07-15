<?php
	include("db.php");

	if (isset($_POST['criar'])) {
		$nome = $_POST['nome'];
		$apelido = $_POST['apelido'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$data = date("Y/m/d");

		$email_check = mysql_query("SELECT email_usuario FROM registrar WHERE email_usuario='$email'");
		$do_email_check = mysql_num_rows($email_check);
		if ($do_email_check >= 1) {
			echo '<h3>Este email já está registado, faz o login <a href="login.php">aqui</a></h3>';
		}elseif ($nome == '' OR strlen($nome)<3) {
			echo '<h3>Escreva o teu nome corretamente!</h3>';
			
		}elseif (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
			echo '<h3>Email invalido!</h3>';

			
		}elseif ($email == '' OR strlen($email)<10) {
			echo '<h3>Escreva o teu email corretamente!</h3>';
		}elseif ($pass == '' OR strlen($pass)<8) {
			echo '<h3>Escreva a tua palavra-passe corretamente, deve ter mais que 8 caracteres!</h3>';
		}else{
			$query = "INSERT INTO registrar (`nome_usuario`,`sobrenome_usuario`,`email_usuario`,`senha_usuario`,`data_registro_usuario`) VALUES ('$nome','$apelido','$email','$pass','$data')";
			$data = mysql_query($query) or die(mysql_error());
			if ($data) {
				setcookie("login",$email);
				header("Location: dashboard.php");
			}else{
				echo "<h3>Desculpa, houve um erro ao registar-te...</h3>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
	*{font-family: 'Montserrat', cursive;}
	img{display: block; margin: auto; margin-top: 20px; width: 200px;}
	form{text-align: center; margin-top: 10px;}
	input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
	input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
	input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
	input[type="submit"]{border: none; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px;}
	input[type="submit"]:hover{background-color: #1E90FF; color: #FFF; cursor: pointer;}
	h2{text-align: center; margin-top: 20px;}
	h3{text-align: center; color: #1E90FF; margin-top: 15px;}
	a{text-decoration: none; color: #333;}
	</style>
</head>
<body>
	<img src="../img/tela.jpg"><br />
	<h2>Crie uma conta</h2>
	<form method="POST">
		<input type="text" placeholder="Primeiro nome" name="nome"><br />
		<input type="text" placeholder="Sobrenome" name="apelido"><br />
		<input type="email" placeholder="Endereço email" name="email"><br />
		<input type="password" placeholder="Senha" name="pass"><br />
		<input type="submit" value="Criar uma conta" name="criar">
	</form>
	<h3>Já tens uma conta? <a href="login.php">Entra aqui!</a></h3>
</body>
</html>