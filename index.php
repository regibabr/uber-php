<?php
include_once("paginas/header.php");

	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $saber["email_usuario"];

	

	if (isset($_POST['settings'])){
		header("Location: settings.php");
	}
?>




<html>
<head>
<title>Resultado de pesquisa Mysql</title>
</head>




<body>


<form action="" method="post">

<p>	
<label for="data">Data Inicio</label>
<input type="date" id="data" name="data">
</p>


<p>	
<label for="data2">Data Fim</label>
<input type="date" id="data2" name="data2">
</p>

<input type="submit" name="Buscar">
</form>




<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT * FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]' GROUP BY data_trabalho";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($dado = $resultado_usuario->fetch_array()){


	echo 'Data: ' . $dado ['data_trabalho'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Ganhos: ' . $dado ['ganhos'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Km: ' . $dado ['Km_rodado'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Tempo On: ' . $dado ['tempo_online'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Viagens: ' . $dado ['numero_viagens'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Custo Combustivel: ' . $dado ['custo_combustivel'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Gasto com Alimentação: ' . $dado ['gasto_alimento'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Outros Gastos: ' . $dado ['outros_gastos'] .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'. '|' .'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	echo 'Resultado: ' . ($dado ['ganhos'] - $dado ['custo_combustivel'] - $dado ['gasto_alimento'] - $dado ['outros_gastos'] ) . '<br>';
	
	
		echo "<Hr>";
		
		


	}



}else{


	echo 'Erro ao executar sua busca.';
}
}

?>







<!--TOTAL GANHOS-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(ganhos) as somaGanhos FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Ganhos total: ' . $calcular ['somaGanhos']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>


<!--TOTAL KM-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(km_rodado) as somakm FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'KM total: ' . $calcular ['somakm']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>

<!--TOTAL TEMPO ONLINE-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(tempo_online) as somaTempo FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Tempo Online total: ' . $calcular ['somaTempo']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>



<!--TOTAL VIAGENS-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(numero_viagens) as somaViagens FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Viagens total: ' . $calcular ['somaViagens']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>



<!--TOTAL CUSTO COMBUSTIVEL-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(custo_combustivel) as somaCombustivel FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Custo combustivel total: ' . $calcular ['somaCombustivel']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>



<!--TOTAL ALIMENTAÇÃO-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(gasto_alimento) as somaAlimento FROM resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Gasto alimentação total: ' . $calcular ['somaAlimento']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>


<!--TOTAL OUTROS GASTOS-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT SUM(outros_gastos) as somaOutros FROM cad_resumo where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Outros gastos total: ' . $calcular ['somaOutros']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>





<!--RESULTADO-->

<?php
if(isset($_POST['data_trabalho'])){

$sql = "SELECT ganhos, custo_combustivel, gasto_alimento, outros_gastos, 
SUM(ganhos - custo_combustivel - gasto_alimento -  outros_gastos) as somaResultado FROM resumo 
where data_trabalho between '$_POST[data]' and '$_POST[data2]'";
$resultado_usuario= mysqli_query($mysqli,$sql);

if($resultado_usuario){

	while($calcular = $resultado_usuario->fetch_array()){


	
	echo 'Resultado: ' . $calcular ['somaResultado']. '<br>' ;	

	}

}else{

	echo 'Erro ao executar sua busca.';
}
}

?>




</body>




</html>