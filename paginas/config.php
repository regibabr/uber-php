<?php
	include("header.php");


?>

<!-- Codigo para cadastrar configuracao-->

<?php

$naoduplicar = mysql_query("SELECT * FROM config inner join registrar ON config.id_usuario = registrar.
id_usuario WHERE email_usuario='$login_cookie' ");
	
	$registrosEncontrados = mysql_num_rows($naoduplicar);
	
	if (isset($_POST['Cadastrar'])) {
		
		
	$Cod_Mot = $_POST['codmot'];
	$Data = $_POST['data'];
	$Custo_pneu = $_POST['custo_pneu'];
	$Km_troca_pneu = str_replace(".","",$Km_troca_pneu = $_POST ['km_troca_pneu']);
	$Valor_troca_oleo = $_POST['valor_troca_oleo'];
	$Km_troca_oleo = str_replace(".","",$Km_troca_oleo = $_POST['km_troca_oleo']);
	$Preco_combustivel = $_POST['preco_combustivel'];
	$Consumo_combustivel = $_POST['consumo_combustivel'];
	$Valor_veiculo = str_replace(".","", $Valor_veiculo = $_POST ['valor_veiculo']);
	$Valor_seguro = str_replace(".","", $Valor_seguro = $_POST ['valor_seguro']);
	$Prestacao_veiculo = $_POST['prestacao_veiculo'];
	$Despesas_anuais = str_replace(".","", $Despesas_anuais = $_POST['despesas_anuais']);
	$Valor_aluguel = str_replace(".","",$Valor_aluguel = $_POST['valor_aluguel']);
	
	if ($Data == '' or $Preco_combustivel == '' or $Consumo_combustivel == '') {
				echo "<h3 id='mensagem'>Faltou preencher algum campo!</h3>";
				
			
			
				
	} else if ($registrosEncontrados > 0) {
    echo "<h3 id='mensagem'>A configuração só é feita 1 vez!</h3>";
header("Location: configfixo.php");
	
			
			
		}else{

		$query ="INSERT INTO config (id_usuario, data_configuracao, custo_pneu, km_troca_pneu, custo_troca_oleo, km_troca_oleo,
preco_medio_combustivel, consumo_combustivel, valor_veiculo, seguro_anual, prestacao_veiculo, despesas_anuais, valor_aluguel) 
VALUES ('$Cod_Mot', '$Data', '$Custo_pneu', '$Km_troca_pneu', '$Valor_troca_oleo', '$Km_troca_oleo', '$Preco_combustivel',
'$Consumo_combustivel', '$Valor_veiculo', '$Valor_seguro', '$Prestacao_veiculo','$Despesas_anuais', '$Valor_aluguel')";
		$data = mysql_query($query) or die(mysql_error());
		
		if ($data) {
					header("Location: configfixo.php");
				}else{
					echo "Alguma coisa não correu lá muito bem... Tenta outra vez mais tarde";
				}
		
	}		}
?>

<html>
<header>
<title>Configuração</title>
<script type="text/javascript" src="../js\jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../js\jquery.maskMoney.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
			  $("input.custo_pneu").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			  $("input.km_troca_pneu").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			  $("input.valor_troca_oleo").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			  $("input.km_troca_oleo").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			  $("input.preco_combustivel").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.consumo_combustivel").maskMoney({showSymbol:true, symbol:"R$", decimal:".", thousands:","});
			  $("input.valor_veiculo").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			   $("input.valor_seguro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
			    $("input.prestacao_veiculo").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
				$("input.despesas_anuais").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
				$("input.valor_aluguel").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        });
    </script>
</header>
<body>
	
<div id="quadroconfiguracao">
<div id="tituloconfiguracao">
<p>Configuração</p>
</div>
<form method="POST" >

<?php
	
	$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$registrosEncontrados = mysql_num_rows($saberr);
while($saber = mysql_fetch_assoc($saberr)){ ?>
<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>
<?php 
	} 
?>


<label id="labeldata3" >Data</label></br>
<input id="inputdata3" type="date" name="data"   size ="2" width="2"></br></br>
<label id="labelvalorpneu">Custo pneu unidade</label></br> 
<input id="inputvalorpneu" type="text" name="custo_pneu"  class="custo_pneu" ></br></br>
<label id="labelkmpneu">KM Troca pneu</label></br> 
<input id="inputkmpneu"type="text" name="km_troca_pneu" class="km_troca_pneu" ></br></br>
<label id="labelvaloroleo">Valor troca oléo</label></br> 
<input id="inputvaloroleo"type="text" name="valor_troca_oleo" class="valor_troca_oleo" ></br></br>
<label id="labelkmoleo">KM troca oléo</label></br>
<input id="inputkmoleo" type="text" name="km_troca_oleo" class="km_troca_oleo" ></br></br>
<label id="labelprecocombustivel">Preço médio combustivel</label></br> 
<input id="inputprecocombustivel" type="text" name="preco_combustivel" class="preco_combustivel" ></br></br>
<label id="labelconsumo">Consumo combustivel</label></br>
<input id="inputconsumo" type="text" name="consumo_combustivel" class="consumo_combustivel" ></br></br>
<label id="labelvalorveiculo">Valor do veículo</label></br> 
<input id="inputvalorveiculo"type="text" name="valor_veiculo" class="valor_veiculo" ></br></br>
<label id="labelvalorseguro">Valor do Seguro</label></br> 
<input id="inputvalorseguro"type="text" name="valor_seguro" class="valor_seguro" ></br></br>
<label id="labelprestacao">Prestação do veículo</label></br> 
<input id="inputprestacao"type="text" name="prestacao_veiculo" class="prestacao_veiculo" ></br></br>
<label id="labeldespesas">Despesas Anuais</label></br> 
<input id="inputdespesas"type="text" name="despesas_anuais" class="despesas_anuais" ></br></br>
<label id="labelaluguel">Valor do Aluguel</label></br> 
<input id="inputaluguel"type="text" name="valor_aluguel" class="valor_aluguel" ></br></br>

<input id="salvarconfiguracao" type="submit" value="Salvar configuracao" name="Cadastrar">


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