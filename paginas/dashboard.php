<?php

include("header.php");

$saberr = ("SELECT * FROM registrar WHERE email_usuario='$login_cookie'");
$query = mysqli_query($mysqli,$saberr);
	$saber = mysqli_fetch_assoc($query);
	$email = $saber["email_usuario"];


	

	if (isset($_POST['settings'])){
		header("Location: settings.php");
	}

?>






<html>
<head>

<link href="../css\style.css" rel="stylesheet"/>
<title>Dashboard</title>

</head>

<body>

<div id= "corpo">

<!-- SALDO -->
<p>Dashboard</p>
<h4>
<?php
$config =("SELECT SUM((custo_pneu*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as custo49, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
$query2 = mysqli_query($mysqli,$config);
$custoconfig = mysqli_fetch_assoc($query2);
?>

<?php
$despesass = ("SELECT (valor_aluguel + (valor_veiculo*0.20)/12 + seguro_anual/12 + prestacao_veiculo +
despesas_anuais/12)  
as custo50, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
AND email_usuario='$login_cookie'");
$query3 = mysqli_query($mysqli,$despesass);
  $custodespesas = mysqli_fetch_assoc($query3);
?>

<?php
$ganho = ("SELECT SUM(ganhos + ganhos_indicacao) as custo5,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
  AND email_usuario='$login_cookie'");
  $query4 = mysqli_query($mysqli,$ganho);
  $ganhos = mysqli_fetch_assoc($query4);
?>
<?php /*
$num = number_format($ganhos['custo5']-($custoconfig['custo49'] + $custodespesas['custo50']),2,",",".");
if($num < 0){
echo "<span class='negativo'>Saldo do mês R$" ." "." $num</span>";
}else{
echo "<span class='positivo'>Saldo do mês R$" ." "." $num</span>";	
}*/?></h4>
<?php
if (isset($ganhos['custo5']) && isset($custoconfig['custo49']) && isset($custodespesas['custo50'])) {
    $num = number_format($ganhos['custo5'] - ($custoconfig['custo49'] + $custodespesas['custo50']), 2, ",", ".");
    if ($num < 0) {
        echo "<span class='negativo'>Saldo do mês R$" . " " . $num . "</span>";
    } else {
        echo "<span class='positivo'>Saldo do mês R$" . " " . $num . "</span>";
    }
} else {
    echo "Algumas das chaves do array não estão definidas.";
}
?>


	
<!-- RENDA DA SEMANA -->

<div id="quadro1">
<?php


$sql = ("SELECT SUM(ganhos + ganhos_indicacao) as custo5,  email_usuario
  FROM desp_rend
  inner join registrar ON registrar.id_usuario = desp_rend.id_usuario
   
  WHERE MONTH( data_trabalho) = MONTH( NOW( ) )
  
  AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) )
  
  AND email_usuario='$login_cookie'");
  $query5 = mysqli_query($mysqli,$sql);
  $sabe = mysqli_fetch_assoc($query5);
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
$sqll = ("SELECT SUM((custo_pneu*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos)  
as custo6, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
 AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) )
AND email_usuario='$login_cookie'");
$query6 = mysqli_query($mysqli,$sqll);
  $sab = mysqli_fetch_assoc($query6);
?>

<?php
$sqlll =("SELECT (valor_aluguel + (valor_veiculo*0.20)/52 + seguro_anual/52 + prestacao_veiculo/4 +
despesas_anuais/52)  
as custo7, email_usuario FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) )
AND email_usuario='$login_cookie'");
$query7 = mysqli_query($mysqli,$sqlll);
  $sa = mysqli_fetch_assoc($query7);
?>



<div id="valor2">
  
<p><?php 
if (isset($sab['custo6']) && isset($sa['custo7'])) {
echo "R$"." ". number_format($sab['custo6']+ $sa['custo7'],2,",",".");
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
$query8 = mysqli_query($mysqli,$saberree);
$saberee = mysqli_fetch_assoc($query8);	
	
?>

<p><?php 
if (isset($saberee['custo3'])) {
echo "R$"." ". number_format($saberee['custo3'],2,",",".");
}
?><p/>
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
$saberr = ( "SELECT SUM((custo_pneu*km_rodado)/km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo +
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + outros_gastos) 
as custo, email_usuario
FROM config 
inner join registrar ON registrar.id_usuario = config.id_usuario 
inner join desp_rend on desp_rend.id_usuario = config.id_usuario 
WHERE MONTH(data_trabalho) = '$mes_atual'  and email_usuario='$login_cookie'");
$query9 = mysqli_query($mysqli,$saberr);
$saber = mysqli_fetch_assoc($query9);	
	
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
$query10 = mysqli_query($mysqli,$saberre);
$sabere = mysqli_fetch_assoc($query10);	
	
?>

<p><?php 
if (isset($sabere['custo2']) && isset($saber['custo'])) {
echo "R$"." ". number_format($sabere['custo2'] + $saber['custo']  ,2,",",".");
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
<p>Resumo da semana atual<p>
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
		
        </thead>
 <?php 
 $tabela = ("SELECT 
 data_trabalho, email_usuario, tempo_online, numero_viagens,
					   ganhos, ganhos_indicacao,
km_rodado, gasto_alimento, gasto_agua, gasto_bala,outros_gastos					   
 FROM desp_rend /*inner join desp_rend ON desp_rend.id_usuario = desp_rend.id_usuario */
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
 /*AND desp_rend.data_trabalho = desp_rend.data_trabalho AND desp_rend.id_usuario = desp_rend.id_usuario */
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) )
  AND email_usuario='$login_cookie' order by data_trabalho ") ;
  $query11 = mysqli_query($mysqli,$tabela);

 $totalkm=0;
 $totaltempo=0;
 $totalviagens=0;
 $totalalimento=0;
 $totalagua=0;
 $totalbala=0;
 $totaloutros=0;
 $totalganhos=0;
$totalindicacao=0;


 while($dado = mysqli_fetch_assoc($query11)){ 
  $totalkm += $dado['km_rodado'];
  $totalviagens += $dado['numero_viagens']; 
  $totalalimento += $dado['gasto_alimento']; 
  $totalagua += $dado['gasto_agua'];
  $totalbala += $dado['gasto_bala'];
  $totaloutros += $dado['outros_gastos'];
  $totalganhos += $dado['ganhos'];
  $totalindicacao += $dado['ganhos_indicacao'];
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
		
       <td><a href="#">Alterar</a></td>
		<td><a href="#">Excluir</a></td>
        
    </tr>
   
<?php } ?>

<!-- Consulta para somar o total do tempo Online em horas-->
 <?php 
 $tabela2 = ("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( tempo_online ) ) ) AS total_tempo from desp_rend 
 /*inner join rendimentos ON despesas.id_usuario = rendimentos.id_usuario*/ 
 inner join registrar ON registrar.id_usuario = desp_rend.id_usuario 
WHERE MONTH( data_trabalho ) = MONTH( NOW( ) ) 
 AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) ) 
  AND email_usuario='$login_cookie' order by data_trabalho ") ;
$query12 = mysqli_query($mysqli,$tabela2);
 $totaltempo=0;
 
 while($dado2 = mysqli_fetch_assoc($query12)){ 
  $totaltempo = $dado2['total_tempo'];
  
 ?>

<?php } ?>
<!-- --------------------------------------------------> 

<thead>
	<tr align="center">
        <td><?php ?></td>
        <td><?php echo number_format($totalkm,2,",","."); ?></td>
		
        <td><?php echo $totaltempo; ?></td>
		
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

<!-- GRAFICO -->

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
(valor_aluguel + (valor_veiculo*0.20)/52 + seguro_anual/52 + prestacao_veiculo/4 + despesas_anuais/52)/7+
((custo_pneu*km_rodado) /km_troca_pneu + (custo_troca_oleo*km_rodado)/km_troca_oleo + 
(preco_medio_combustivel/consumo_combustivel)*km_rodado + gasto_alimento + gasto_agua + gasto_bala + 
outros_gastos )as custo, 
(ganhos + ganhos_indicacao) as ganhos, 
email_usuario, data_trabalho FROM config inner join registrar ON registrar.id_usuario = 
config.id_usuario inner join desp_rend on desp_rend.id_usuario = config.id_usuario /*inner join rendimentos on 
rendimentos.id_usuario = config.id_usuario AND rendimentos.data_trabalho_rendimento = despesas.data_trabalho */
   
  WHERE MONTH( data_trabalho ) = MONTH( NOW( ) )
   AND YEARWEEK ( data_trabalho ,1) = YEARWEEK( NOW( ) )
  
  
  AND email_usuario='$login_cookie' order by data_trabalho " );
  $query13 = mysqli_query($mysqli,$sq);
 
while ($row = mysqli_fetch_assoc($query13)){
     
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
     title: 'Receita & Despesas semana atual',
     width: 980, height: 300,
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






</div>


</body>

</html>