<?php
	include("header.php");

?>

<!-- Codigo para cadastrar despesas-->

<?php
	
	if (isset($_POST['Cadastrar'])) {
		
	$Cod_Mot = $_POST['codmot'];
	$Data = $_POST['data'];
	$Km_rodado = $_POST['km_rodado'];
	$Tempo_on = $_POST['tempo'];
	$Viagens = $_POST['viagens'];
	$Gasto_alimento = $_POST['alimento'];
	$Gasto_agua = $_POST['agua'];
	$Gasto_bala = $_POST['bala'];
	$Outros_Gastos = $_POST['outros'];
	$Ganhos = $_POST['ganhos'];
	$Ganhos_indicacao = $_POST['ganhosindicacao'];
	
	
	
		if($_POST['km_rodado'] == ''){
			
			echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao2.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir o km rodado.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
	}else if($_POST['data'] == ''){
	
	echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao2.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir a data.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
	}else if($_POST['ganhos'] == ''){
			
			echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao2.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir os ganhos.\");
	</script>
	";
	
	
		}else{
			
		echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=dashboard2.php'>
	<script type=\"text/javascript\">
	alert(\"Dados inseridos com sucesso!\");
	</script>
	";	
		
		

		$query ="INSERT INTO desp_rend (id_usuario, data_trabalho,Km_rodado,
		tempo_online,numero_viagens, gasto_alimento, gasto_agua, gasto_bala, outros_gastos, ganhos, ganhos_indicacao ) 
VALUES ('$Cod_Mot', '$Data',  '$Km_rodado','$Tempo_on', 
'$Viagens', '$Gasto_alimento', '$Gasto_agua', '$Gasto_bala', '$Outros_Gastos', '$Ganhos', '$Ganhos_indicacao')";
		$data = mysql_query($query) or die(mysql_error());

		
		
		
		
		
	}}
			
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
<form method="POST" >

<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	
	$email = $saber["email_usuario"];
	

while($saber = mysql_fetch_assoc($saberr)){ ?>

<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>




<?php 
	} 
?>


<label id="labeldata2">Data</label></br>
<input id="inputdata2" type="date" name="data"  size ="2" width="2"></br></br>
<label id="labelkm2">Km rodados</label></br> 
<input id="inputkm2" type="text" name="km_rodado" class="km_rodado" ></br></br>
<label id="labeltempo2">Tempo online</label></br> 
<input id="inputtempo2"type="text" name="tempo" class="tempo" OnKeyPress="formatar('##:##', this)" placeholder="hh:mm" ></br></br>
<label id="labelviagens2">Nº de viagens</label></br> 
<input id="inputviagens2"type="text" name="viagens" class="viagens"></br></br>
<label id="labelgastoalimento2">Gastos alimentação</label></br>
<input id="inputgastoalimento2" type="text" name="alimento" class="alimento"></br></br>
<label id="labelgastoagua2">Gastos com água</label></br> 
<input id="inputgastoagua2" type="text" name="agua" class="agua" ></br></br>
<label id="labelgastobala2">Gastos com bala</label></br>
<input id="inputgastobala2" type="text" name="bala" class="bala"></br></br>
<label id="labeloutrosgastos2">Outros gastos</label></br> 
<input id="inputoutrosgastos2"type="text" name="outros" class="outros"></br></br>

<label id="labelganhos2">Ganhos diário</label></br> 
<input id="inputganhos2" type="text" name="ganhos"  class="ganhos"></br></br>

<label id="labelganhosindicacao2">Ganhos indicação</label></br> 
<input id="inputganhosindicacao2" type="text" name="ganhosindicacao"  class="ganhosindicacao"></br></br>

<input id="salvardespesa22" type="submit" value="Salvar" name="Cadastrar">

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