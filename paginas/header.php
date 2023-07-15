<?php
	include("db.php");

	$login_cookie = $_COOKIE['login'];
	if (!isset($login_cookie)) {
		header("Location: paginas/login.php");
	}
?>


<?php

$saberr = ("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
$query = mysqli_query($mysqli,$saberr);
	$saber = mysqli_fetch_assoc($query);
	$email = $saber["email_usuario"];

	

	if (isset($_POST['settings'])){
		header("Location: settings.php");
	}

?>


<html>
<head>
<link rel="shortcut icon" href="../img/favicon.ico" />
<meta charset="UTF-8">


<link href="../css\style.css" rel="stylesheet" type="text/css" />



<body>

<div id="menu100porcento">
<div id="menu">

<p>Gerenciador Financeiro</p>
<div id="usuario">
<form method="POST">
			<p><?php echo 'Olá,' .' '. $saber['nome_usuario'].'&nbsp'.'&nbsp'.'|'  ; ?></p><br />
		</form>
</div>
<div id="sair">
<a href="logout.php">Sair</a>
</div>
</div>
</div>

<div id="vertical">
<ul id="nav">

	<li><a href="dashboard2.php">Dashboard</a></li>
	<li><a href="transacao2.php">Lançamento diário</a></li>
	<li><a href="relatorio.php">Relatório diário</a></li>
	<li><a href="#">Configurações</a>
	
		<ul>
		<li><a href="config.php">Cadastro</a>
		<li><a href="configfixo.php">Editar</a>
		</ul>
	
	
	</li>
	
		<li><a href="perfilfixo.php">Perfil</a>
		<li><a href="logout.php">Sair</a>
</ul>

</div>



</body>
</html>