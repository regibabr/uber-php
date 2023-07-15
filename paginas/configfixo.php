<?php
	include("header.php");

?>

<!-- Codigo para cadastrar configuracao-->









<html>
<header>
	<title>Editar configuração</title>
</header>
<body>
	
<div id="quadroconfiguracao">
<div id="tituloconfiguracao">
<p>Configuração</p>
</div>
<form method="POST"  action="alterar.php" >
<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>
<?php 
	} 
?>



<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labeldata3">Data</label></br>
<input id="inputdata3" type="text" name="data" size ="2" width="2" readonly="true" value="<?php echo $saber['data_configuracao'];?>"></br></br><?php } ?>


<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelvalorpneu">Custo Pneu</label></br> 
<input id="inputvalorpneu" type="text" name="custo_pneu" readonly="true" value="<?php echo number_format($saber['custo_pneu'],2,",",".");?>"></br></br><?php } ?>


<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelkmpneu">KM Troca Pneu</label></br> 
<input id="inputkmpneu"type="text" name="km_troca_pneu" readonly="true" value="<?php echo number_format($saber['km_troca_pneu'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelvaloroleo">Valor troca oléo</label></br> 
<input id="inputvaloroleo"type="text" name="valor_troca_oleo" readonly="true" value="<?php echo number_format($saber['custo_troca_oleo'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelkmoleo">KM troca oléo</label></br>
<input id="inputkmoleo" type="text" name="km_troca_oleo" readonly="true" value="<?php echo number_format($saber['km_troca_oleo'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelprecocombustivel">Preço médio combustivel</label></br> 
<input id="inputprecocombustivel" type="text" name="preco_combustivel" readonly="true" value="<?php echo $saber['preco_medio_combustivel'];?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelconsumo">Consumo combustivel</label></br>
<input id="inputconsumo" type="text" name="consumo_combustivel" readonly="true" value="<?php echo $saber['consumo_combustivel'];?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelvalorveiculo">Valor do veículo</label></br> 
<input id="inputvalorveiculo"type="text" name="valor_veiculo" readonly="true" value="<?php echo number_format( $saber['valor_veiculo'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelvalorseguro">Valor do Seguro</label></br> 
<input id="inputvalorseguro"type="text" name="valor_seguro" readonly="true" value="<?php echo number_format($saber['seguro_anual'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelprestacao">Prestação do veículo</label></br> 
<input id="inputprestacao"type="text" name="prestacao_veiculo" readonly="true" value="<?php echo number_format($saber['prestacao_veiculo'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labeldespesas">Despesas Anuais</label></br> 
<input id="inputdespesas"type="text" name="despesas_anuais" readonly="true" value="<?php echo number_format($saber['despesas_anuais'],2,",",".");?>"></br></br><?php } ?>

<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON registrar.id_usuario = config.id_usuario
	WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelaluguel">Valor do Aluguel</label></br> 
<input id="inputaluguel"type="text" name="valor_aluguel" readonly="true" value="<?php echo number_format($saber['valor_aluguel'],2,",",".");?>"></br></br><?php } ?>


<input id="editarconfigfixo" type="submit" value="Editar configuracao" name="Editar"
onClick="alterar.php">

</form>
</div>


</div>
</div>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	










<!--
    ABAIXO FORMULARIO CADASTRO ONDE O id_usuario, nome_usuario e id_config VEM DO BANCO
 -->


	





<!-- LOGOUT  -->
<!--
<a href="logout.php">Sair</a>

 -->



	
</body>
</html>