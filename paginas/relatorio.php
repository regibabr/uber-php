<?php
	include("header.php");
	
?>

<html>
<head>

<title>Relatório por período</title>


<style type="text/css">
	#datas{float: left; margin-top: 20px; margin-left: 80px; font-family: 'Open Sans';
			width: 700px; height: 50px; font-size:13px;}
	#label1{float: left;margin-top:14px;}
	#input1{ border: solid 1px #CCC; margin-left: 10px; width: 150px; height: 30px; margin-top: 10px; font-family: 'Open Sans';
	font-size: 13px; padding-left:15px;}
	
	#label2{margin-left: 270px; margin-top: -26px; float:left;}
	
	#input2{float: left; border: solid 1px #CCC; width: 150px; height: 30px; margin-left: 350px; margin-top: -30px; font-family: 'Open Sans'; font-size: 13px; padding-left:15px;}
	#botao{float: left; margin-top: -30px; width: 110px; height: 30px; margin-left: 530px; background: #ff7518; color: white;}
	
	#resumo{ float: left; margin-left:-10px; margin-top: 15px;}
	th{font-family: 'Open Sans'; font-size:10px;}
	td{font-family: 'Open Sans'; font-size:9px;}
	

	
	</style>

</head>



<body>

<div id="datas">
<form action="" method="post">

<!-- Não apagar após submit -->
<?php
$data = (!empty($_POST['data'])) ? $_POST['data'] : '';
?>
<p>	
<label id="label1" for="data">Data inicial</label>
<input id="input1" type="date" id="data" name="data" value="<?php echo $data?>">
</p>

<!-- Não apagar após submit -->
<?php
$data2 = (!empty($_POST['data2'])) ? $_POST['data2'] : '';
?>
<p>	
<label id="label2" for="data2">Data final</label>
<input id="input2" type="date" id="data2" name="data2" value="<?php echo $data2?>">
</p>

<input id="botao" type="submit" name="Buscar" value="Buscar">
</form>

</div>


<table id="resumo" border="1" >
<thead>
    <tr align="center"  bgcolor="#f5f5f5">
        <th width="40">Data</th>
        <th width="40">Km rodado</th>
        
		<th width="30">Viagens</th>
        <th width="40">Alimentação</th>
        <th width="40">Agua</th>
		<th width="40">Bala</th>
		<th width="40">Outros</th>
		
		<th width="40">Pneu</th>
        <th width="40">Óleo</th>
		<th width="40">Combustível</th>
        <th width="40">Depreciação</th>
        <th width="40">Seguro</th>
		<th width="40">Prestação</th>
		<th width="40">Despesas Anuais</th>
		<th width="40">Custo total</th>
		<th width="40">Ganhos</th>
		<th width="40">Resultado</th>
		
		
		
        </thead>

<?php 


if(isset($_POST['data'])){

 $tabela = mysql_query ("SELECT id_desp_rend,
 data_trabalho, email_usuario, tempo_online, numero_viagens,
					   ganhos, ganhos_indicacao,
km_rodado, gasto_alimento, gasto_agua, gasto_bala,outros_gastos,

(custo_pneu*4*km_rodado)/km_troca_pneu 
as custoPneu, (custo_troca_oleo*km_rodado)/km_troca_oleo as custoOleo, (preco_medio_combustivel/consumo_combustivel)*km_rodado as custoCombustivel, (valor_veiculo*0.20)/365 as depreciacao,
seguro_anual/365 as custoSeguro, prestacao_veiculo/30 as Prestacao, despesas_anuais/365 as Anuais,
data_trabalho, email_usuario
				   
 FROM desp_rend 
 inner join config ON config.id_usuario = desp_rend.id_usuario 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 

  
  
 WHERE data_trabalho between '$_POST[data]' and '$_POST[data2]'
 
  
 
AND email_usuario='$login_cookie' order by data_trabalho

 ") ;

 $totalkm=0;
 
 $totalviagens=0;
 $totalalimento=0;
 $totalagua=0;
 $totalbala=0;
 $totaloutros=0;
 
 $custoPneu =0;
$custoOleo=0;
$custoCombustivel=0;
$depreciacao=0;
$custoSeguro=0;
$valorPrestacao=0;
$despesasAnuais=0;
$ganhos=0;



 while($dado = mysql_fetch_assoc($tabela)){ 
  $totalkm += $dado['km_rodado'];
  $totalviagens += $dado['numero_viagens']; 
  $totalalimento += $dado['gasto_alimento']; 
  $totalagua += $dado['gasto_agua'];
  $totalbala += $dado['gasto_bala'];
  $totaloutros += $dado['outros_gastos'];
  $ganhos += $dado['ganhos'];
  
   $custoPneu += $dado['custoPneu'];
  $custoOleo += $dado['custoOleo'];
  $custoCombustivel += $dado ['custoCombustivel'];
  $depreciacao += $dado ['depreciacao'];
  $custoSeguro += $dado ['custoSeguro'];
  $valorPrestacao += $dado ['Prestacao'];
  $despesasAnuais += $dado ['Anuais'];
  
  
  
  
 
 
  
?>



 <tr align="center">
        <td><?php echo $dado['data_trabalho'];?></td>
        <td><?php echo $dado['km_rodado'];?></td>
        
		<td><?php echo $dado['numero_viagens'];?></td>
        <td><?php echo "R$"." ". number_format($dado['gasto_alimento'],2,",",".");?></td>
        <td><?php echo "R$"." ". $dado['gasto_agua'];?></td>
		<td><?php echo"R$"." ".  $dado['gasto_bala'];?></td>
        <td><?php echo "R$"." ". $dado['outros_gastos'];?></td>
		
		
        <td><?php echo "R$"." ". number_format($dado['custoPneu'],2,",",".");?></td>
       <td><?php echo "R$"." ". number_format($dado['custoOleo'],2,",",".");?></td>
       <td><?php echo "R$"." ". number_format($dado['custoCombustivel'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['depreciacao'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['custoSeguro'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['Prestacao'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['Anuais'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['custoPneu'] + $dado['custoOleo'] + $dado['custoCombustivel'] + 
$dado['depreciacao'] + $dado['custoSeguro'] + $dado['Prestacao'] + $dado['Anuais'] + $dado['gasto_alimento'] +
$dado['gasto_agua'] + $dado['gasto_bala'] + $dado['outros_gastos']
		,2,",",".");?></td>
        
		<td><?php echo "R$"." ". number_format($dado['ganhos'],2,",",".");?></td>
		
		<td><?php echo "R$"." ". number_format($dado['ganhos'] - ($dado['custoPneu'] + $dado['custoOleo'] + $dado['custoCombustivel'] + $dado['depreciacao'] + $dado['custoSeguro'] + $dado['Prestacao'] + $dado['Anuais'] + $dado['gasto_alimento'] +$dado['gasto_agua'] + $dado['gasto_bala'] + $dado['outros_gastos']) ,2,",",".");?></td>
    </tr>
   
<?php } ?>


<thead>
	<tr align="center">
        <td><?php ?></td>
        <td><?php echo number_format($totalkm,2,",","."); ?></td>
		
       
		
		<td><?php echo $totalviagens; ?></td>
        <td><?php echo "R$"." ". number_format($totalalimento,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($totalagua,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($totalbala,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($totaloutros,2,",",".");?></td>
       
	    <td><?php echo "R$"." ". number_format( $custoPneu,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format( $custoOleo,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format( $custoCombustivel,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($depreciacao,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($custoSeguro,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($valorPrestacao,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($despesasAnuais,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($totalalimento + $totalagua + $totalbala + $totaloutros + $custoPneu + $custoOleo + $custoCombustivel + $depreciacao + $custoSeguro + $valorPrestacao + $despesasAnuais
		,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($ganhos,2,",","."); ?></td>
		
		<td><?php echo "R$"." ". number_format($ganhos - ($totalalimento + $totalagua + $totalbala + $totaloutros + $custoPneu + $custoOleo + $custoCombustivel + $depreciacao + $custoSeguro + $valorPrestacao + $despesasAnuais)
		,2,",","."); ?></td>
	   
	   <?php } ?>
        </thead>
        
    </tr>


</table>
</body>

</html>