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
	
	
	
		if($_POST['km_rodado'] == ''){
			
			echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir o km rodado.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
	}else if($_POST['data'] == ''){
	
	echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir a data.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
		}else{
			
		echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao.php'>
	<script type=\"text/javascript\">
	alert(\"Despesa inserida com sucesso! Insira os ganhos!\");
	</script>
	";	
		
		

		$query ="INSERT INTO despesas (id_usuario, data_trabalho,Km_rodado,
		tempo_online,numero_viagens, gasto_alimento, gasto_agua, gasto_bala, outros_gastos ) 
VALUES ('$Cod_Mot', '$Data',  '$Km_rodado','$Tempo_on', 
'$Viagens', '$Gasto_alimento', '$Gasto_agua', '$Gasto_bala', '$Outros_Gastos')";
		$data = mysql_query($query) or die(mysql_error());

		
		
		
		
		
	}}
			
?>






<!-- Codigo para cadastrar rendimentos-->

<?php
	
	if (isset($_POST['Cadastrar2'])) {
		
	$Cod_Mot = $_POST['codmot'];
	$Data = $_POST['data'];
	$Ganhos = $_POST['ganhos'];
	$Ganhos_indicacao = $_POST['ganhosindicacao'];
		

		if($_POST['ganhos'] == ''){
			
			echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir os ganhos.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
	}else if($_POST['data'] == ''){
	
	echo"
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=transacao.php'>
	<script type=\"text/javascript\">
	alert(\"Faltou inserir a data.\");
	</script>
	";
	echo "<script language='javascript'>history.back()</script>";
	
		}else{
			
		echo "
	<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=dashboard.php'>
	<script type=\"text/javascript\">
	alert(\"Ganhos inserido com sucesso!\");
	</script>
	";	
		
		
		
		$query ="INSERT INTO rendimentos (id_usuario, data_trabalho_rendimento,ganhos,
		ganhos_indicacao ) 
VALUES ('$Cod_Mot', '$Data',  '$Ganhos','$Ganhos_indicacao')";
		$data = mysql_query($query) or die(mysql_error());

		
	}}		
?>







<html>
<header>
<title>Transação</title>
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
	
<div id="quadrotransacao1">
<div id="titulotransacao1">
<p>- Despesas</p>
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


<label id="labeldata">Data</label></br>
<input id="inputdata" type="date" name="data"  size ="2" width="2"></br></br>
<label id="labelkm">Km rodados</label></br> 
<input id="inputkm" type="text" name="km_rodado" class="km_rodado" ></br></br>
<label id="labeltempo">Tempo online</label></br> 
<input id="inputtempo"type="text" name="tempo" class="tempo" OnKeyPress="formatar('##:##', this)" placeholder="hh:mm" ></br></br>
<label id="labelviagens">Nº de viagens</label></br> 
<input id="inputviagens"type="text" name="viagens" class="viagens"></br></br>
<label id="labelgastoalimento">Gastos alimentação</label></br>
<input id="inputgastoalimento" type="text" name="alimento" class="alimento"></br></br>
<label id="labelgastoagua">Gastos com água</label></br> 
<input id="inputgastoagua" type="text" name="agua" class="agua" ></br></br>
<label id="labelgastobala">Gastos com bala</label></br>
<input id="inputgastobala" type="text" name="bala" class="bala"></br></br>
<label id="labeloutrosgastos">Outros gastos</label></br> 
<input id="inputoutrosgastos"type="text" name="outros" class="outros"></br></br>

<input id="salvardespesa" type="submit" value="Salvar despesa" name="Cadastrar">

</form>
</div>

<div id="quadrotransacao2">
<div id="titulotransacao2">
<p>+ Rendimentos</p>
</div>
<form method="POST" >

<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	
	$email = $saber["email_usuario"];
	

while($saber = mysql_fetch_assoc($saberr)){ ?>

<label id="labelidmot">Codigo do Motorista</label> <input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>




<?php 
	} 
?>

<label id="labeldata2">Data</label></br>
<input id="inputdata2" type="date" name="data"  size ="2" width="2"></br></br>

<label id="labelganhos">Ganhos diário</label></br> 
<input id="inputganhos" type="text" name="ganhos"  class="ganhos"></br></br>

<label id="labelganhosindicacao">Ganhos indicação</label></br> 
<input id="inputganhosindicacao" type="text" name="ganhosindicacao"  class="ganhosindicacao"></br></br>




<input id="salvarrendimentos"type="submit" name="Cadastrar2" value="Salvar rendimentos" >

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