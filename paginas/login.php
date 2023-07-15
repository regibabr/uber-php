<?php
	include("db.php");

	if (isset($_POST['entrar'])) {
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$verifica = ("SELECT * FROM registrar WHERE email_usuario = '$email' AND senha_usuario='$pass'");
		$query = mysqli_query($mysqli,$verifica) or die(mysql_error());
$row = mysqli_num_rows($query);

if ($row<=0) {
	echo "<h3>E-MAIL OU SENHA INVÁLIDA. </br>POR FAVOR TENTE NOVAMENTE.</h3>";
}else{
	setcookie("login",$email);
	header("location: dashboard.php");
}
}
		

?>
<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
	*{font-family: 'Montserrat', cursive;}
	
	form{text-align: center; margin-top: 20px;}
	input[type="email"]{border : 1px solid #CCC; width: 360px; height: 50px; padding-left: 10px; }
	input[type="password"]{border: 1px solid #CCC; width: 360px; height: 50px; padding-left: 10px;  }
	input[type="submit"]{border: none; width: 360px; height: 50px; margin-top: 20px;  background:#11939a; color: white;}
	input[type="submit"]:hover{background-color: #0c6c71; color: white; cursor: pointer;}
	h2{text-align: center; color:#000000; margin-top: 150px;}
	h3{text-align: center; color: red;}
	legend{margin: auto; }
	p{text-align: center; color:#c0c0c0; }
	#cadastrar{text-decoration: none; color: #5ba0c3;}
	#esqueci{text-decoration: none; color: #5ba0c3; margin-left: 120px; }

	
	</style>
	<link rel="shortcut icon" href="../img/favicon.ico" />
</head>
<body>
<span style="color: rgb(255, 0, 0);"><marquee behavior=scroll>Ajude este projeto, faça uma doação. Banco Itaú - 8270 12402-0</marquee></span>
	<h2>PLANILHA UBER</h2>
	<fieldset style = "width: 300px; margin: 0px auto; border-left: 0px; border-right:0px;  border-color:#f5f5f5;  margin-top: 50px;">

	<legend>Entrar</legend>

	<form method="POST">
		<input type="email" placeholder="Endereço email" name="email"><br />
		<input type="password" placeholder="Senha" name="pass"><br />
		<input type="submit" value="Entrar" name="entrar">
	</form>
	<a id="esqueci" href="#"> Esqueci a senha</a></p>
	<p>Não tem uma conta? <a id="cadastrar" href="registar.php"> Cadastre-se!</a></p>
	</fieldset>
</body>
</html>