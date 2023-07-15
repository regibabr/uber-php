<?php
	include("header.php");

?>

<!-- Codigo para cadastrar despesas-->
<?php



$id = $_REQUEST['cod'];

$infoo = mysql_query("select * from desp_rend inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
WHERE email_usuario='$login_cookie' and id_desp_rend=".$id);
	$sabers = mysql_fetch_assoc($infoo);
	

	
	$Data_alterar = $Data_alterar = isset($_REQUEST['data']);
	$Km_alterar = $Km_alterar = isset($_REQUEST['km_rodado']);
	$Tempo_alterar = $Tempo_alterar = isset($_REQUEST['tempo']);
	$Numero_viagens_alterar = $Numero_viagens_alterar = isset($_REQUEST['viagens']);
	$Gasto_alimento_alterar = $Gasto_alimento_alterar = isset($_REQUEST['alimento']);
	$Gasto_agua_alterar = $Gasto_agua_alterar = isset($_REQUEST['agua']);
	$Gasto_bala_alterar = $Gasto_bala_alterar = isset($_REQUEST['bala']);
	$Outros_gastos_alterar = $Outros_gastos_alterar = isset($_REQUEST['outros']);
	$Ganhos_alterar = $Ganhos_alterar = isset($_REQUEST['ganhos']);
	$Ganhos_indicacao_alterar = $Ganhos_indicacao_alterar = isset($_REQUEST['ganhosindicacao']);

if (isset($_POST['cancelar'])) {
		header("Location: dashboard2.php");
	}	

?>



<html>
<header>
<title>Transação 2</title>
<script type="text/javascript" src="../js\jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js\jquery.maskMoney.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			  $("input.km_rodado").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.alimento").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.agua").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.bala").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.outros").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.ganhos").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.ganhosindicacao").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
        });
    </script>
	
<script>
function formatar(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}
</script>
	
</header>
<body>
	
<div id="quadrotransacao12">
<div id="titulotransacao12">
<p>Dados</p>
</div>
<form method ="GET" action="alterar_gravar_transacao.php" >
<input type="hidden" name="codigo" value="<?php echo $id ?>">

<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	
	$email = $saber["email_usuario"];
	

while($saber = mysql_fetch_assoc($saberr)){ ?>

<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>




<?php 
	} 
?>


<label id="labeldata2">Data</label></br>
<input id="inputdata2" type="date" name="data"  size ="2" width="2" value="<?php if($sabers['data_trabalho'] != null) { echo $sabers['data_trabalho'];}else{"";} ?>"></br></br>

<label id="labelkm2">Km rodados</label></br> 
<input id="inputkm2" type="text" name="km_rodado" class="km_rodado" value="<?php if($sabers['km_rodado'] != null) { echo $sabers['km_rodado'];}else{"";} ?>"  ></br></br>

<label id="labeltempo2">Tempo online</label></br> 
<input id="inputtempo2"type="text" name="tempo" class="tempo" OnKeyPress="formatar('##:##', this)" value="<?php if($sabers['tempo_online'] != null) { echo $sabers['tempo_online'];}else{"";} ?>"></br></br>

<label id="labelviagens2">Nº de viagens</label></br> 
<input id="inputviagens2"type="text" name="viagens" class="viagens" value="<?php if($sabers['numero_viagens'] != null) { echo $sabers['numero_viagens'];}else{"";} ?>"></br></br>

<label id="labelgastoalimento2">Gastos alimentação</label></br>
<input id="inputgastoalimento2" type="text" name="alimento" class="alimento" value="<?php if($sabers['gasto_alimento'] != null) { echo $sabers['gasto_alimento'];}else{"";} ?>"></br></br>

<label id="labelgastoagua2">Gastos com água</label></br> 
<input id="inputgastoagua2" type="text" name="agua" class="agua" value="<?php if($sabers['gasto_agua'] != null) { echo $sabers['gasto_agua'];}else{"";} ?>"></br></br>

<label id="labelgastobala2">Gastos com bala</label></br>
<input id="inputgastobala2" type="text" name="bala" class="bala" value="<?php if($sabers['gasto_bala'] != null) { echo $sabers['gasto_bala'];}else{"";} ?>"></br></br>

<label id="labeloutrosgastos2">Outros gastos</label></br> 
<input id="inputoutrosgastos2"type="text" name="outros" class="outros" value="<?php if($sabers['outros_gastos'] != null) { echo $sabers['outros_gastos'];}else{"";} ?>"></br></br>

<label id="labelganhos2">Ganhos diário</label></br> 
<input id="inputganhos2" type="text" name="ganhos"  class="ganhos" value="<?php if($sabers['ganhos'] != null) { echo $sabers['ganhos'];}else{"";} ?>"></br></br>

<label id="labelganhosindicacao2">Ganhos indicação</label></br> 
<input id="inputganhosindicacao2" type="text" name="ganhosindicacao"  class="ganhosindicacao" value="<?php if($sabers['ganhos_indicacao'] != null) { echo $sabers['ganhos_indicacao'];}else{"";} ?>"></br></br>

<input id="cancelardespesa2" type="submit" value="Cancelar" name="cancelar">

<input id="alterardespesa2" type="submit" value="Alterar" />

</form>
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