<?php
	include("header.php");

?>


<html>
<header>
	
</header>
<body>
	
<div id="quadroconfiguracao">
<div id="tituloconfiguracao">
<p>Configuração</p>
</div>






<?php
$id = $_REQUEST['cod'];

$sql = "select * from config where id_config=".$id;
$query = mysql_query($sql) or die(mysql_error());
$row = mysqli_fetch_object($query);




$data_alterar = $row->data_configuracao;
$custo_pneu_alterar = $row->custo_pneu;
$km_troca_pneu_alterar = $row->km_troca_pneu;
$custo_troca_oleo_alterar = $row->custo_troca_oleo;
$km_troca_oleo_alterar = $row->km_troca_oleo;
$preco_combustivel_alterar = $row->preco_medio_combustivel;
$consumo_alterar = $row->consumo_combustivel;
$valor_veiculo_alterar = $row->valor_veiculo;
$seguro_anual_alterar = $row->seguro_anual;
$prestacao_veiculo_alterar = $row->prestacao_veiculo;
$despesas_anuais_alterar = $row->despesas_anuais;
$valor_aluguel_alterar = $row->valor_aluguel;
?>


<form method="GET" action="alterar_gravar_config.php" >
<input type="hidden" name="codigo" value="<?php echo $id ?>">

<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$email = $saber["email_usuario"];
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>
<?php 
	} 
?>


<label id="labeldata3">Data</label></br>
<input id="inputdata3" type="text" name="data" value="<?php if($data_alterar != null) { echo $data_alterar;}else{"";} ?>"  size ="2" width="2"></br></br>
<label id="labelvalorpneu">Custo Pneu</label></br> 
<input id="inputvalorpneu" type="text" name="custo_pneu"  value="<?php if($custo_pneu_alterar != null) { echo $custo_pneu_alterar;}else{"";} ?>"></br></br>
<label id="labelkmpneu">KM Troca Pneu</label></br> 
<input id="inputkmpneu"type="text" name="km_troca_pneu" value="<?php if($km_troca_pneu_alterar != null) { echo $km_troca_pneu_alterar;}else{"";} ?>"></br></br>
<label id="labelvaloroleo">Valor troca oléo</label></br> 
<input id="inputvaloroleo"type="text" name="valor_troca_oleo" value="<?php if($custo_troca_oleo_alterar != null) { echo $custo_troca_oleo_alterar;}else{"";} ?>"></br></br>
<label id="labelkmoleo">KM troca oléo</label></br>
<input id="inputkmoleo" type="text" name="km_troca_oleo" value="<?php if($km_troca_oleo_alterar != null) { echo $km_troca_oleo_alterar;}else{"";} ?>"></br></br>
<label id="labelprecocombustivel">Preço médio combustivel</label></br> 
<input id="inputprecocombustivel" type="text" name="preco_combustivel" value="<?php if($preco_combustivel_alterar != null) { echo $preco_combustivel_alterar;}else{"";} ?>"></br></br>
<label id="labelconsumo">Consumo combustivel</label></br>
<input id="inputconsumo" type="text" name="consumo_combustivel" value="<?php if($consumo_alterar != null) { echo $consumo_alterar;}else{"";} ?>"></br></br>
<label id="labelvalorveiculo">Valor do veículo</label></br> 
<input id="inputvalorveiculo"type="text" name="valor_veiculo" value="<?php if($valor_veiculo_alterar != null) { echo $valor_veiculo_alterar;}else{"";} ?>"></br></br>
<label id="labelvalorseguro">Valor do Seguro</label></br> 
<input id="inputvalorseguro"type="text" name="valor_seguro" value="<?php if($seguro_anual_alterar != null) { echo $seguro_anual_alterar;}else{"";} ?>"></br></br>
<label id="labelprestacao">Prestação do veículo</label></br> 
<input id="inputprestacao"type="text" name="prestacao_veiculo" value="<?php if($prestacao_veiculo_alterar != null) { echo $prestacao_veiculo_alterar;}else{"";} ?>""></br></br>
<label id="labeldespesas">Despesas Anuais</label></br> 
<input id="inputdespesas"type="text" name="despesas_anuais" value="<?php if($despesas_anuais_alterar != null) { echo $despesas_anuais_alterar;}else{"";} ?>"></br></br>
<label id="labelaluguel">Valor do Aluguel</label></br> 
<input id="inputaluguel"type="text" name="valor_aluguel" value="<?php if($valor_aluguel_alterar != null) { echo $valor_aluguel_alterar;}else{"";} ?>"></br></br>

<input id="editarconfiguracao" type = "submit" class="bt" value="Alterar"/>


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