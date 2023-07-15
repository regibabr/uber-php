<?php
	include("header.php");
	
	$infoo = mysql_query("SELECT * FROM config inner join registrar ON config.id_usuario = registrar.id_usuario
	WHERE email_usuario='$login_cookie'");
	$saber = mysql_fetch_assoc($infoo);

	if (isset($_POST['editar'])) {
$data_configuracao = $_POST['data1'];
$Custo_pneu = $_POST['custo_pneu1'];
$Km_troca_pneu = str_replace(".","",$Km_troca_pneu = $_POST ['km_troca_pneu1']);
$Valor_troca_oleo = $_POST ['valor_troca_oleo1'];
$Km_troca_oleo = str_replace(".","",$Km_troca_oleo = $_POST['km_troca_oleo1']);
$Preco_combustivel = $_POST['preco_combustivel1'];
$Consumo_combustivel = $_POST['consumo_combustivel1'];
$Valor_veiculo = str_replace(".","", $Valor_veiculo = $_POST ['valor_veiculo1']);
$Valor_seguro = str_replace(".","", $Valor_seguro = $_POST ['valor_seguro1']);
$Prestacao_veiculo = $_POST['prestacao_veiculo1'];
$Despesas_anuais = str_replace(".","", $Despesas_anuais = $_POST['despesas_anuais1']);
$Valor_aluguel = str_replace(".","",$Valor_aluguel = $_POST['valor_aluguel1']);

		if($data_configuracao==""){
			echo "<h2>Digite a data</h2>";
		}elseif($Preco_combustivel==""){
			echo "<h2>Digite o valor do pneu</h2>";
		}elseif($Consumo_combustivel==""){
			echo "<h2>Digite o consumo médio de combustivel</h2>";
		}else{
			$query = "UPDATE config inner join registrar ON config.id_usuario = registrar.id_usuario SET `data_configuracao`='$data_configuracao', `custo_pneu`='$Custo_pneu', `km_troca_pneu`='$Km_troca_pneu',
`custo_troca_oleo`='$Valor_troca_oleo', `km_troca_oleo`='$Km_troca_oleo', `preco_medio_combustivel`='$Preco_combustivel',
`consumo_combustivel`='$Consumo_combustivel', `valor_veiculo`='$Valor_veiculo', `seguro_anual`='$Valor_seguro',
`prestacao_veiculo`='$Prestacao_veiculo', `despesas_anuais`='$Despesas_anuais', `valor_aluguel`='$Valor_aluguel'
WHERE email_usuario='$login_cookie'";
			$data = mysql_query($query);
			if ($data) {
				header("Location: configfixo.php");
			}else{
				echo "<h2>Algo não correu como esperávamos...</h2>";
			}
		}
	}

	if (isset($_POST['cancelar'])) {
		header("Location: dashboard2.php");
	}
	

?>



<html>
<header>
<title>Editar configuração</title>
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

<label id="labelidmot">Codigo do Motorista </label><input id="inputidmot" type="text" readonly="true" name="codmot" value="<?php echo $saber['id_usuario'];?>"></br>





<label id="labeldata3">Data</label></br>
<input id="inputdata3" type="text" name="data1" size ="2" width="2" value="<?php echo $saber['data_configuracao'];?>"></br></br>


<label id="labelvalorpneu">Custo Pneu</label></br> 
<input id="inputvalorpneu" type="text" name="custo_pneu1" class="custo_pneu" value="<?php echo number_format($saber['custo_pneu'],2,",",".");?>"></br></br>


<label id="labelkmpneu">KM Troca Pneu</label></br> 
<input id="inputkmpneu"type="text" name="km_troca_pneu1" class="km_troca_pneu" value="<?php echo number_format($saber['km_troca_pneu'],2,",",".");?>"></br></br>


<label id="labelvaloroleo">Valor troca oléo</label></br> 
<input id="inputvaloroleo"type="text" name="valor_troca_oleo1" class="valor_troca_oleo" value="<?php echo number_format($saber['custo_troca_oleo'],2,",",".");?>"></br></br>


<label id="labelkmoleo">KM troca oléo</label></br>
<input id="inputkmoleo" type="text" name="km_troca_oleo1" class="km_troca_oleo" value="<?php echo number_format($saber['km_troca_oleo'],2,",",".");?>"></br></br>


<label id="labelprecocombustivel">Preço médio combustivel</label></br> 
<input id="inputprecocombustivel" type="text" name="preco_combustivel1" class="preco_combustivel" OnKeyPress="formatar('#.##', this)" value="<?php echo $saber['preco_medio_combustivel'];?>"></br></br>

<label id="labelconsumo">Consumo combustivel</label></br>
<input id="inputconsumo" type="text" name="consumo_combustivel1" class="consumo_combustivel" value="<?php echo $saber['consumo_combustivel'];?>"></br></br>


<label id="labelvalorveiculo">Valor do veículo</label></br> 
<input id="inputvalorveiculo"type="text" name="valor_veiculo1" class="valor_veiculo" value="<?php echo number_format($saber['valor_veiculo'],2,",",".");?>"></br></br>


<label id="labelvalorseguro">Valor do Seguro</label></br> 
<input id="inputvalorseguro"type="text" name="valor_seguro1" class="valor_seguro" value="<?php echo number_format($saber['seguro_anual'],2,",",".");?>"></br></br>


<label id="labelprestacao">Prestação do veículo</label></br> 
<input id="inputprestacao"type="text" name="prestacao_veiculo1" class="prestacao_veiculo" value="<?php echo number_format($saber['prestacao_veiculo'],2,",",".");?>"></br></br>


<label id="labeldespesas">Despesas Anuais</label></br> 
<input id="inputdespesas"type="text" name="despesas_anuais1" class="despesas_anuais" value="<?php echo number_format($saber['despesas_anuais'],2,",",".");?>"></br></br>


<label id="labelaluguel">Valor do Aluguel</label></br> 
<input id="inputaluguel"type="text" name="valor_aluguel1" class="valor_aluguel" value="<?php echo number_format($saber['valor_aluguel'],2,",",".");?>"></br></br>

<input id="cancelarconfiguracao" type="submit" value="Cancelar" name="cancelar">
<input id="editarconfiguracao" type="submit" value="Atualizar" name="editar">

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