<?php
	include("header.php");

?>


<?php
	$saberr = mysql_query("SELECT * FROM config inner join registrar ON config.id_usuario = registrar.id_usuario
	WHERE email_usuario='$login_cookie'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $saber["email_usuario"];
?>

<html>
<header>
	
</header>
<body>
	


<div id="tabela">

<table>
<tr>
	
	<td class="td">Data</td>
	<td class="td">Custo Pneu</td>
	<td class="td">Km troca pneu</td>
	<td class="td">Valor troca oleo</td>
	<td class="td">Km troca oleo</td>
	<td class="td">Preço médio combustivel</td>
	<td class="td">Consumo combustivel</td>
	<td class="td">Valor do veículo</td>
	<td class="td">Valor do seguro</td>
	<td class="td">Prestação do veículo</td>
	<td class="td">Despesas Anuais</td>
	<td class="td">Valor do aluguel</td>
</tr>
	
	
	<?php while($dado = mysql_fetch_assoc($saberr)){ 
	$url_alterar_config = "form_alterar_config.php?cod=".$dado['id_config'];
	/*$url_excluir_igreja = "form_excluir_igreja.php?cod=".$dado['id_igreja'];*/
	
	?>
	
	
	
	
	<tr>
		
		<td><?php echo $dado['data_configuracao'];?></td>
		<td><?php echo $dado['custo_pneu']; ?></td>
		<td><?php echo $dado['km_troca_pneu'];?></td>
		<td><?php echo $dado['custo_troca_oleo'];?></td>
		<td><?php echo $dado['km_troca_oleo'];?></td>
		<td><?php echo $dado['preco_medio_combustivel'];?></td>
		<td><?php echo $dado['consumo_combustivel']; ?></td>
		<td><?php echo $dado['valor_veiculo'];?></td>
		<td><?php echo $dado['seguro_anual'];?></td>
		<td><?php echo $dado['prestacao_veiculo'];?></td>
		<td><?php echo $dado['despesas_anuais'];?></td>
		<td><?php echo $dado['valor_aluguel'];?></td>
		<?php echo "<td><a href=".$url_alterar_config.">Alterar</a></td>";?>
		<?php /* echo "<td><a href=".$url_excluir_igreja.">Excluir</a></td>"; */ ?>
		</tr>
		<?php } ?>
		</table>
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