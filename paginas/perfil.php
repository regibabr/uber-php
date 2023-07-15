<?php
	include("header.php");
	
	
$infoo = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$saber = mysql_fetch_assoc($infoo);
	
	if (isset($_POST['editar'])) {
$Nome = $_POST['nome'];
$Sobrenome = $_POST['apelido'];
$Email = $_POST ['email'];
$Tel = $_POST ['tel'];


$query = "UPDATE registrar SET `nome_usuario`='$Nome', `sobrenome_usuario`='$Sobrenome', `email_usuario`='$Email',
 `celular_usuario`='$Tel'
WHERE email_usuario='$login_cookie'";
			$data = mysql_query($query);
			if ($data) {
				header("Location: perfil.php");
			}else{
				echo "<h2>Algo não correu como esperávamos...</h2>";
	}}
	
	if (isset($_POST['cancelar'])) {
		header("Location: dashboard2.php");
	}
	
	
?>


<!DOCTYPE html>
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<style type="text/css">
	
	
	#dados{text-align: center; margin-top: 30px; font-family: 'Montserrat', cursive;}
	input[type="text"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
	input[type="email"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; border-radius: 3px; margin-top: 10px;}
	input[type="password"]{border: 1px solid #CCC; width: 250px; height: 25px; padding-left: 10px; margin-top: 10px; border-radius: 3px;}
	input[type="submit"]{border: none; width: 120px; height: 30px; margin-top: 20px; border-radius: 3px;}
	input[type="submit"]:hover{background-color: #1E90FF; color: #FFF; cursor: pointer;}
	h2{text-align: center; margin-top: 20px;font-family: 'Montserrat', cursive;}
	
	label {font-size: 13px;  font-weight: bold; font-family: 'Montserrat', cursive;}
	#sNome{margin-left: -38px;}
	#sEmail{margin-left: 3px;}
	#sTel{margin-left: -15px;}
	
	#form{float: left; margin-left: 50px; width: 400px; height: 300px; border: 1px solid #CCC; margin-top:10px;}
	
	</style>
</head>
<body>
	<div id="form">
	<h2>Meus dados</h2>
	<form id="dados" method="POST">
		<label for="cNome"> Nome<input type="text" placeholder="Primeiro nome" name="nome" value="<?php echo $saber['nome_usuario'];?>"></label><br />
		<label id="sNome"> Sobrenome<input type="text" placeholder="Sobrenome" name="apelido" value="<?php echo $saber['sobrenome_usuario'];?>"></label><br />
		<label id="sEmail"> Email<input type="email" placeholder="Endereço email" name="email" value="<?php echo $saber['email_usuario'];?>"></label><br />
		<label id="stel"> Telefone<input type="text" placeholder="Número do celular" name="tel" value="<?php echo $saber['celular_usuario'];?>"></label><br />
		
		<input id="editarperfil" type="submit" value="Atualizar" name="editar">
		<input id="cancelarperfil" type="submit" value="Cancelar" name="cancelar">
		
		
	</form>
	</div>
</body>
</html>