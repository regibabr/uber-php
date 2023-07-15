<?php

include("header.php");

$saberr = mysql_query("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
	$saber = mysql_fetch_assoc($saberr);
	$email = $saber["email_usuario"];


	

	if (isset($_POST['settings'])){
		header("Location: settings.php");
	}

?>






<html>
<head>

<link href="../css\style.css" rel="stylesheet" type="text/css"/>

<title>Dashboard 2</title>

</head>

<body>

<div id= "corpo">

<!-- SALDO SEMANA -->
<p>Dashboard</p>
<h5>
<?php
$configsemana = mysql_query("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as SaldoCustoSemana, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
  $custoconfigsemana = mysql_fetch_assoc($configsemana);
?>

<?php
$despesassemana = mysql_query("SELECT (valor_aluguel/4.285714 + (valor_veiculo*0.20)/52.14286 + seguro_anual/52.14286 + prestacao_veiculo/4.285714 +
despesas_anuais/52.14286)  
as SaldoCustoSemana2, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
  $custodespesassemana = mysql_fetch_assoc($despesassemana);
?>

<?php
$ganhosemana = mysql_query("SELECT SUM(ganhos + ganhos_indicacao) as SaldoGanhosSemana,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
  AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie'");
  $ganhossemana = mysql_fetch_assoc($ganhosemana);
?>
<?php 
$numsemana = number_format($ganhossemana['SaldoGanhosSemana']-($custoconfigsemana['SaldoCustoSemana'] + $custodespesassemana['SaldoCustoSemana2']),2,",",".");
if($numsemana < 0){
echo "<span class='negativo'>Saldo da semana R$" ." "." $numsemana</span>";
}else{
echo "<span class='positivo'>Saldo da semana R$" ." "." $numsemana</span>";	
}?></h5>	

<!-- SALDO MÊS -->

<h5>
<?php
$configmes = mysql_query("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as SaldoCustoMes, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
  $custoconfigmes = mysql_fetch_assoc($configmes);
?>

<?php
$despesasmes = mysql_query("SELECT (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo +
despesas_anuais/12)  
as SaldoCustoMes2, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
  $custodespesasmes = mysql_fetch_assoc($despesasmes);
?>

<?php
$ganhomes = mysql_query("SELECT SUM(ganhos + ganhos_indicacao) as SaldoGanhoMes,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
  WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
  AND email_usuario='$login_cookie'");
  $ganhosmes = mysql_fetch_assoc($ganhomes);
?>
<?php 
$nummes = number_format($ganhosmes['SaldoGanhoMes']-($custoconfigmes['SaldoCustoMes'] + $custodespesasmes['SaldoCustoMes2']),2,",",".");
if($nummes < 0){
echo "<span class='negativo'>Saldo do mês R$" ." "." $nummes</span>";
}else{
echo "<span class='positivo'>Saldo do mês R$" ." "." $nummes</span>";	
}?></h5>
	

	
	
<!-- RENDA DA SEMANA -->

<div id="quadro1">
<?php


$sql = mysql_query("SELECT SUM(ganhos + ganhos_indicacao) as custo5,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
   
  WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
  
  AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  
  AND email_usuario='$login_cookie'");
  $sabe = mysql_fetch_assoc($sql);
?>

<div id="valor1">
<p><?php echo "R$"." ". number_format($sabe['custo5'],2,",",".");?><p/>
<div id="descricao1">
<p>Renda da semana</p>
</div>
</div>
</div>


<!-- DESPESA DA SEMANA -->

<div id="quadro2">
<?php
$sqll = mysql_query("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as custo6, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
 AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
  $sab = mysql_fetch_assoc($sqll);
?>

<?php
$sqlll = mysql_query("SELECT (valor_aluguel/4.285714 + (valor_veiculo*0.20)/52.14286 + seguro_anual/52.14286 + prestacao_veiculo/4.285714 +
despesas_anuais/52.14286)  
as custo7, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
  $sa = mysql_fetch_assoc($sqlll);
?>



<div id="valor2">
<p><?php echo "R$"." ". number_format($sab['custo6']+ $sa['custo7'],2,",",".");?><p/>
<div id="descricao2">
<p>Despesa da semana</p>
</div>
</div>
</div>




<!-- RENDA DO MÊS -->

<div id="quadro3">
<div id="valor3">
<?php

$mess_atual = date("m");
$saberree = mysql_query( "SELECT SUM(ganhos + ganhos_indicacao) 
as custo3, email_usuario
FROM desp_rend
inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 

WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");
$saberee = mysql_fetch_assoc($saberree);	
	
?>

<p><?php echo "R$"." ". number_format($saberee['custo3'],2,",",".");?><p/>
<div id="descricao3">
<p>Renda do mês</p>
</div>
</div>
</div>



<!-- DESPESA DO MÊS -->

<div id="quadro4">
<div id="valor4">
<?php

$mes_atual = date("m");
$saberr = mysql_query( "SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos) 
as custo, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mes_atual'  and email_usuario='$login_cookie'");
$saber = mysql_fetch_assoc($saberr);	
	
?>

<?php

$mess_atual = date("m");
$saberre = mysql_query( "SELECT (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo+
despesas_anuais/12) 
as custo2, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");
$sabere = mysql_fetch_assoc($saberre);	
	
?>

<p><?php echo "R$"." ". number_format($sabere['custo2'] + $saber['custo']  ,2,",",".");?><p/>
<div id="descricao4">
<p>Despesa do mês</p>
</div>
</div>
</div>



<!-- TABELA RESUMO -->

<div id="tabela">
<div id="titulotabela">
<p>Custos e ganhos variáveis da semana atual<p>
<table border="1" >
<thead>
    <tr align="center">
        <th width="90">Data</th>
        <th width="90">Km rodado</th>
        <th width="90">Tempo On</th>
		<th width="70">Viagens</th>
        <th width="80">Alimentação</th>
        <th width="70">Agua</th>
		<th width="70">Bala</th>
		<th width="70">Outros</th>
		<th width="90">Ganhos</th>
		<th width="80">Alterar</th>
		<th width="80">Excluir</th>
		
        </thead>
 <?php 
 $tabela = mysql_query ("SELECT id_desp_rend,
 data_trabalho, email_usuario, tempo_online, numero_viagens,
					   ganhos, ganhos_indicacao,
km_rodado, gasto_alimento, gasto_agua, gasto_bala,outros_gastos					   
 FROM desp_rend 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
  
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie' order by data_trabalho ") ;

 $totalkm=0;
 $totaltempo=0;
 $totalviagens=0;
 $totalalimento=0;
 $totalagua=0;
 $totalbala=0;
 $totaloutros=0;
 $totalganhos=0;
$totalindicacao=0;


 while($dado = mysql_fetch_assoc($tabela)){ 
  $totalkm += $dado['km_rodado'];
  $totalviagens += $dado['numero_viagens']; 
  $totalalimento += $dado['gasto_alimento']; 
  $totalagua += $dado['gasto_agua'];
  $totalbala += $dado['gasto_bala'];
  $totaloutros += $dado['outros_gastos'];
  $totalganhos += $dado['ganhos'];
  $totalindicacao += $dado['ganhos_indicacao'];
  
  /* COMANDO FAZ PARTE DA FORM ALTERAR TRANSAÇÃO */
  $url_alterar_transacao = "form_alterar_transacao.php?cod=".$dado['id_desp_rend'];
	$url_excluir_transacao = "form_excluir_transacao.php?cod=".$dado['id_desp_rend'];
	 /* _______________________________________________ */
 ?>
 
    </tr>
	
    <tr align="center">
        <td><?php echo $dado['data_trabalho'];?></td>
        <td><?php echo $dado['km_rodado'];?></td>
        <td><?php echo $dado['tempo_online'];?></td>
		<td><?php echo $dado['numero_viagens'];?></td>
        <td><?php echo "R$"." ". number_format($dado['gasto_alimento'],2,",",".");?></td>
        <td><?php echo "R$"." ". $dado['gasto_agua'];?></td>
		<td><?php echo"R$"." ".  $dado['gasto_bala'];?></td>
        <td><?php echo "R$"." ". $dado['outros_gastos'];?></td>
        <td><?php echo "R$"." ". $dado['ganhos'];?></td>
		
		<!-- COMANDO FAZ PARTE DA FORM ALTERAR TRANSAÇÃO -->
       <?php echo "<td><a href=".$url_alterar_transacao.">Alterar</a></td>";?>
		<?php echo "<td><a href=".$url_excluir_transacao.">Excluir</a></td>"; ?>
        <!-- ______________________________________________________ -->
		
    </tr>
   
<?php } ?>

<!-- Consulta para somar o total do tempo Online em horas-->
 <?php 
 $tabela2 = mysql_query ("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( tempo_online ) ) ) AS total_tempo from desp_rend 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
 WHERE MONTH( data_trabalho ) = MONTH( NOW( ) ) AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie' order by data_trabalho ") ;

 $totaltempo=0;
 
 while($dado2 = mysql_fetch_assoc($tabela2)){ 
  $totaltempo = $dado2['total_tempo'];
  
 ?>

<?php } ?>
<!-- --------------------------------------------------> 

<thead>
	<tr align="center">
        <td><?php ?></td>
        <td><?php echo number_format($totalkm,2,",","."); ?></td>
		
        <td><?php echo "tempo"; ?></td>
		
		<td><?php echo $totalviagens; ?></td>
        <td><?php echo "R$"." ". number_format($totalalimento,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($totalagua,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($totalbala,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($totaloutros,2,",",".");?></td>
        <td><?php echo "R$"." ". number_format($totalganhos,2,",","."); ?></td>
		
        </thead>
        
    </tr>
</table>

</div>
</div>














<!-- TABELA RESUMO 2 -->

<div id="tabela">
<div id="titulotabela">
<p>Custo fixo da semana atual<p>
<table border="1" >
<thead>
    <tr align="center">
        <th width="80">Data</th>
        <th width="80">Pneu</th>
        <th width="80">Óleo</th>
		<th width="70">Combustível</th>
        <th width="80">Depreciação</th>
        <th width="80">Seguro</th>
		<th width="80">Prestação</th>
		<th width="80">Despesas Anuais</th>
		<th width="80">Total</th>
		
        </thead>
 <?php 

$tab2 = mysql_query( "SELECT (custo_pneu*4*km_rodado)/km_troca_pneu 
as custoPneu, (custo_troca_oleo*km_rodado)/km_troca_oleo as custoOleo, (preco_medio_combustivel/consumo_combustivel)*km_rodado as custoCombustivel, (valor_veiculo*0.20)/365 as depreciacao,
seguro_anual/365 as custoSeguro, prestacao_veiculo/30 as Prestacao, despesas_anuais/365 as Anuais,
data_trabalho, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )  
   and email_usuario='$login_cookie' order by data_trabalho");
$custoPneu =0;
$custoOleo=0;
$custoCombustivel=0;
$depreciacao=0;
$custoSeguro=0;
$valorPrestacao=0;
$despesasAnuais=0;

 while($dado = mysql_fetch_assoc($tab2)){ 
  $custoPneu += $dado['custoPneu'];
  $custoOleo += $dado['custoOleo'];
  $custoCombustivel += $dado ['custoCombustivel'];
  $depreciacao += $dado ['depreciacao'];
  $custoSeguro += $dado ['custoSeguro'];
  $valorPrestacao += $dado ['Prestacao'];
  $despesasAnuais += $dado ['Anuais'];
 ?>
 
    </tr>
	
    <tr align="center">
        <td><?php echo $dado['data_trabalho'];?></td>
        <td><?php echo "R$"." ". number_format($dado['custoPneu'],2,",",".");?></td>
       <td><?php echo "R$"." ". number_format($dado['custoOleo'],2,",",".");?></td>
       <td><?php echo "R$"." ". number_format($dado['custoCombustivel'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['depreciacao'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['custoSeguro'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['Prestacao'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['Anuais'],2,",",".");?></td>
		<td><?php echo "R$"." ". number_format($dado['custoPneu'] + $dado['custoOleo'] + $dado['custoCombustivel'] + 
$dado['depreciacao'] + $dado['custoSeguro'] + $dado['Prestacao'] + $dado['Anuais'] 
		,2,",",".");?></td>
    </tr>
   
<?php } ?>


<thead>
	<tr align="center">
        <td><?php ?></td>
        <td><?php echo "R$"." ". number_format( $custoPneu,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format( $custoOleo,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format( $custoCombustivel,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($depreciacao,2,",","."); ?></td>
        <td><?php echo "R$"." ". number_format($custoSeguro,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($valorPrestacao,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($despesasAnuais,2,",","."); ?></td>
		<td><?php echo "R$"." ". number_format($custoPneu + $custoOleo +  $custoCombustivel + $depreciacao + $custoSeguro + $valorPrestacao + $despesasAnuais
		,2,",","."); ?></td>
		
        </thead>
        
    </tr>
</table>

</div>
</div>



<!-- GRAFICO 1-->

<?php 
$dia = array();
$ganhos = array();
$custo = array();

$i = 0;

$sq = mysql_query( "SELECT 
(CASE WEEKDAY(data_trabalho) 
                       when 0 then 'Segunda'
                       when 1 then 'Terça'
                       when 2 then 'Quarta'
                       when 3 then 'Quinta'
                       when 4 then 'Sexta'
                       when 5 then 'Sábado'
                       when 6 then 'Domingo'                 
                       END) AS DiaDaSemana,
(valor_aluguel/4.285714 + (valor_veiculo*0.20)/52.14286 + seguro_anual/52.14286 + prestacao_veiculo/4.285714 + despesas_anuais/52.14286)/7+
((custo_pneu*4*km_rodado) /km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo + 
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + 
outros_gastos )as custo, 
(ganhos + ganhos_indicacao) as ganhos, 
email_usuario, data_trabalho FROM config inner join registrar ON registrar.id_usuario = 
config.id_usuario inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
  AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  
  AND email_usuario='$login_cookie' order by data_trabalho" );
 
while ($row = mysql_fetch_assoc($sq)){
     
	$dia[$i] = $row['DiaDaSemana'];
 $ganhos[$i] = $row['ganhos'];
 $custo[$i] = $row['custo'];
 
 $i = $i + 1;
}

?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
 google.load('visualization', '1', {'packages':['corechart']});
 google.setOnLoadCallback(desenhaGrafico);
 
 function desenhaGrafico() {
  
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Data');
  data.addColumn('number', 'Ganhos');
  data.addColumn('number', 'Custo');
   
  data.addRows(<?php echo $i ?>);
  
  <?php
  $k = $i;
  for ($i = 0; $i < $k; $i++) {
  ?>
   data.setValue(<?php echo $i ?>, 0, '<?php echo $dia[$i] ?>');
     
   data.setValue(<?php echo $i ?>, 1, <?php echo $ganhos[$i] ?>);
   
    data.setValue(<?php echo $i ?>, 2, <?php echo $custo[$i] ?>);
   
  <?php
  }
  ?>
  
    var options = {
     title: 'Receita & despesas semana atual',
     width: 650, height: 300,
     colors: ['#3fb618', '#ff0039' ],
	 lineWidth: 3,
     legend: { position: 'bottom' }
          };
  
  // cria grafico
  var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
  
  // desenha grafico 
  chart.draw(data, options);
  
 }

</script>
<div id="chart_div" style="width: 980px; height: 300px;"></div>








<!-- GRAFICO 2-->

<?php

$mes_atual = date("m");
$GraficoCusto = mysql_query( "SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos) 
as GraficCusto, (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo+
despesas_anuais/12) 
as GraficCusto2, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mes_atual'  and email_usuario='$login_cookie'");
	while ($somar = mysql_fetch_assoc($GraficoCusto)){
		$custografico = $somar['GraficCusto'] + $somar['GraficCusto2'];
	}
?>


<?php

$mess_atual = date("m");
$GraficoRenda = mysql_query( "SELECT SUM(ganhos + ganhos_indicacao) 
as graficRenda, email_usuario
FROM desp_rend
inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 

WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");


while ($somarRenda = mysql_fetch_assoc($GraficoRenda)){
		$rendagrafico = $somarRenda['graficRenda'];
	}
	
?>



   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Renda',      <?php echo $rendagrafico; ?>],
          ['Custo',       <?php echo $custografico; ?>],
          
        ]);

        var options = {
          title: 'Custo x renda mensal',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  
    <div id="piechart_3d" style="width: 440px; height: 300px;"></div>




 



<!-- GRAFICO 3-->












</div>


</body>

</html>