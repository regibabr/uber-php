<?php
	include("header.php");
	
	
$id = $_REQUEST['id_config'];
$data = $_REQUEST['data_configuracao'];
$Custo_pneu = $_REQUEST['custo_pneu'];
$Km_troca_pneu = $_REQUEST ['km_troca_pneu'];
$Valor_troca_oleo = $_REQUEST ['custo_troca_oleo'];
$Km_troca_oleo = $_REQUEST['km_troca_oleo'];
$Preco_combustivel = $_REQUEST['preco_medio_combustivel'];
$Consumo_combustivel = $_REQUEST['consumo_combustivel'];
$Valor_veiculo = $_REQUEST ['valor_veiculo'];
$Valor_seguro = $_REQUEST ['seguro_anual'];
$Prestacao_veiculo = $_REQUEST['prestacao_veiculo'];
$Despesas_Anuais = $_REQUEST['despesas_anuais'];
$Valor_aluguel = $_REQUEST['valor_aluguel'];



$sql = "update config set data_configuracao='".$data."',custo_pneu='".$Custo_pneu."',km_troca_pneu='".$Km_troca_pneu."',
custo_troca_oleo='".$Valor_troca_oleo."',km_troca_oleo='".$Km_troca_oleo."',preco_medio_combustivel='".$Preco_combustivel."',
consumo_combustivel='".$Consumo_combustivel."',valor_veiculo='".$Valor_veiculo."',seguro_anual='".$Valor_seguro."',
prestacao_veiculo='".$Prestacao_veiculo."',despesas_anuais='".$Despesas_Anuais."',valor_aluguel='".$Valor_aluguel."'

where id_config=".$id;


?>