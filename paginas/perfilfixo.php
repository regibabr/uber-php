<?php
	include("header.php");
	
	
$infoo = ("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
$query = mysqli_query($mysqli,$infoo);
	$saber = mysqli_fetch_assoc($query);
	

	
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
	<form id="dados" method="POST" action="perfil.php"  >
		<label for="cNome"> Nome<input type="text" readonly="true" placeholder="Primeiro nome" name="nome" value="<?php echo $saber['nome_usuario'];?>"></label><br />
		<label id="sNome"> Sobrenome<input type="text" readonly="true" placeholder="Sobrenome" name="apelido" value="<?php echo $saber['sobrenome_usuario'];?>"></label><br />
		<label id="sEmail"> Email<input type="email" readonly="true" placeholder="Endereço email" name="email" value="<?php echo $saber['email_usuario'];?>"></label><br />
		<label id="stel"> Telefone<input type="text" readonly="true" placeholder="Número do celular" name="tel" value="<?php echo $saber['celular_usuario'];?>"></label><br />
		
		
		
		<input id="editarperfilfixo" type="submit" value="Editar perfil" name="editar">


	</form>
	</div>
</body>
</html>