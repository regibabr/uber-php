<?php

include("header.php");

$saberr = ("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
$query= mysqli_query($mysqli,$saberr);
	$saber= mysqli_fetch_assoc($query);
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
$configsemana = ("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as SaldoCustoSemana, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
$query2=mysqli_query($mysqli,$configsemana);
  $custoconfigsemana = mysqli_fetch_assoc($query2);
?>

<?php
$despesassemana =("SELECT (valor_aluguel/4.285714 + (valor_veiculo*0.20)/52.14286 + seguro_anual/52.14286 + prestacao_veiculo/4.285714 +
despesas_anuais/52.14286)  
as SaldoCustoSemana2, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
$query3=mysqli_query($mysqli,$despesassemana);
  $custodespesassemana = mysqli_fetch_assoc($query3);
?>

<?php
$ganhosemana = ("SELECT SUM(ganhos + ganhos_indicacao) as SaldoGanhosSemana,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
  AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie'");
  $query4=mysqli_query($mysqli,$ganhosemana);
  $ganhossemana = mysqli_fetch_assoc($query4);
?>
<?php if (isset($numsemana['SaldoGanhosSemana']) && isset($custoconfig['SaldoCustoSemana']) && isset($custodespesas['custo50SaldoCustoSemana2'])) {
$numsemana = number_format($ganhossemana['SaldoGanhosSemana
']-($custoconfigsemana['SaldoCustoSemana'] + $custodespesassemana['SaldoCustoSemana2']),2,",",".");
if($numsemana < 0){
echo "<span class='negativo'>Saldo da semana R$" ." "." $numsemana</span>";
}else{
echo "<span class='positivo'>Saldo da semana R$" ." "." $numsemana</span>";	
}}?></h5>	

<!-- SALDO MÊS -->

<h5>
<?php
$configmes =("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as SaldoCustoMes, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
$query5=mysqli_query($mysqli,$configmes);
  $custoconfigmes = mysqli_fetch_assoc($query5);
?>

<?php
$despesasmes = ("SELECT (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo +
despesas_anuais/12)  
as SaldoCustoMes2, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
$query6=mysqli_query($mysqli,$despesasmes);
  $custodespesasmes = mysqli_fetch_assoc($query6);
?>

<?php
$ganhomes = ("SELECT SUM(ganhos + ganhos_indicacao) as SaldoGanhoMes,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
  WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
  AND email_usuario='$login_cookie'");
  $query7=mysqli_query($mysqli,$ganhomes);
  $ganhosmes = mysqli_fetch_assoc($query7);
?>
<?php 
 if (isset($nummes['SaldoGanhosMes']) && isset($custoconfig['SaldoCustoMes']) && isset($custodespesas['SaldoCustoMes2'])) {
$nummes = number_format($ganhosmes['SaldoGanhoMes']-($custoconfigmes['SaldoCustoMes'] + $custodespesasmes['SaldoCustoMes2']),2,",",".");
if($nummes < 0){
echo "<span class='negativo'>Saldo do mês R$" ." "." $nummes</span>";
}else{
echo "<span class='positivo'>Saldo do mês R$" ." "." $nummes</span>";	
}}?></h5>
	

	
	
<!-- RENDA DA SEMANA -->

<div id="quadro1">
<?php


$sql = ("SELECT SUM(ganhos + ganhos_indicacao) as custo5,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
   
  WHERE MONTH(data_trabalho) = MONTH( NOW( ) )
  
  AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  
  AND email_usuario='$login_cookie'");
  $query8=mysqli_query($mysqli,$sql);
  $sabe = mysqli_fetch_assoc($query8);
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
$sqll = ("SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as custo6, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
 AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
$query9=mysqli_query($mysqli,$sqll);
  $sab = mysqli_fetch_assoc($query9);
?>

<?php
$sqlll = ("SELECT (valor_aluguel/4.285714 + (valor_veiculo*0.20)/52.14286 + seguro_anual/52.14286 + prestacao_veiculo/4.285714 +
despesas_anuais/52.14286)  
as custo7, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
AND email_usuario='$login_cookie'");
$query10=mysqli_query($mysqli,$sqlll);
  $sa = mysqli_fetch_assoc($query10);
?>



<div id="valor2">
  <p><?php 
    if (isset($sa['custo6'])){
    echo "R$"." ". number_format($sab['custo6']+ $sa['custo7'],2,",",".");
}else{
 echo "R$ 0,00";
}
  ?><p/>
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
$saberree = ( "SELECT SUM(ganhos + ganhos_indicacao) 
as custo3, email_usuario
FROM desp_rend
inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 

WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");
$query11=mysqli_query($mysqli,$saberree);
$saberee = mysqli_fetch_assoc($query11);	
	
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
$saberr = ( "SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos) 
as custo, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mes_atual'  and email_usuario='$login_cookie'");
$query12=mysqli_query($mysqli,$saberr);
$saber = mysqli_fetch_assoc($query12);	
	
?>

<?php

$mess_atual = date("m");
$saberre = ( "SELECT (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo+
despesas_anuais/12) 
as custo2, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");
$query13=mysqli_query($mysqli,$saberre);
$sabere = mysqli_fetch_assoc($query13);	
	
?>

<p><?php 
if (isset($sabere['custo2'])){
echo "R$"." ". number_format($sabere['custo2'] + $saber['custo'],2,",",".");
}else{
  echo "R$ 0,00";
}

?><p/>
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
 $tabela = ("SELECT id_desp_rend,
 data_trabalho, email_usuario, tempo_online, numero_viagens,
					   ganhos, ganhos_indicacao,
km_rodado, gasto_alimento, gasto_agua, gasto_bala,outros_gastos					   
 FROM desp_rend 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
  
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie' order by data_trabalho ") ;
  $query14=mysqli_query($mysqli,$tabela);

 $totalkm=0;
 $totaltempo=0;
 $totalviagens=0;
 $totalalimento=0;
 $totalagua=0;
 $totalbala=0;
 $totaloutros=0;
 $totalganhos=0;
$totalindicacao=0;


 while($dado = mysqli_fetch_assoc($query14)){ 
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
 $tabela2 = ("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( tempo_online ) ) ) AS total_tempo from desp_rend 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
 WHERE MONTH( data_trabalho ) = MONTH( NOW( ) ) AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )
  AND email_usuario='$login_cookie' order by data_trabalho ") ;
  $query15=mysqli_query($mysqli,$tabela2);

 $totaltempo=0;
 
 while($dado2 = mysqli_fetch_assoc($query15)){ 
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

$tab2 =( "SELECT (custo_pneu*4*km_rodado)/km_troca_pneu 
as custoPneu, (custo_troca_oleo*km_rodado)/km_troca_oleo as custoOleo, (preco_medio_combustivel/consumo_combustivel)*km_rodado as custoCombustivel, (valor_veiculo*0.20)/365 as depreciacao,
seguro_anual/365 as custoSeguro, prestacao_veiculo/30 as Prestacao, despesas_anuais/365 as Anuais,
data_trabalho, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK (data_trabalho ,1) = YEARWEEK( NOW( ),1 )  
   and email_usuario='$login_cookie' order by data_trabalho");
   $query16=mysqli_query($mysqli,$tab2);
$custoPneu =0;
$custoOleo=0;
$custoCombustivel=0;
$depreciacao=0;
$custoSeguro=0;
$valorPrestacao=0;
$despesasAnuais=0;

 while($dado = mysqli_fetch_assoc($query16)){ 
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

$sq =( "SELECT 
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
  $query17=mysqli_query($mysqli,$sq);
 
while ($row = mysqli_fetch_assoc($query17)){
     
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
$GraficoCusto = ( "SELECT SUM((custo_pneu*4*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos) 
as GraficCusto, (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo+
despesas_anuais/12) 
as GraficCusto2, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mes_atual'  and email_usuario='$login_cookie'");
$query18=mysqli_query($mysqli,$GraficoCusto);
	while ($somar = mysqli_fetch_assoc($query18)){
		$custografico = $somar['GraficCusto'] + $somar['GraficCusto2'];
	}
?>


<?php

$mess_atual = date("m");
$GraficoRenda = ( "SELECT SUM(ganhos + ganhos_indicacao) 
as graficRenda, email_usuario
FROM desp_rend
inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 

WHERE MONTH(data_trabalho) = '$mess_atual'  and email_usuario='$login_cookie'");
$query19=mysqli_query($mysqli,$GraficoRenda);


while ($somarRenda = mysqli_fetch_assoc($query19)){
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