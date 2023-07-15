<?php
include_once 'header.php';


$id = $_REQUEST['codigo'];
$Data_trabalho = $_REQUEST['data'];
$Km_rodado = $_REQUEST['km_rodado'];
$Tempo = $_REQUEST['tempo'];
$Viagens = $_REQUEST['viagens'];
$Alimento = $_REQUEST['alimento'];
$Agua = $_REQUEST['agua'];
$Bala = $_REQUEST['bala'];
$Outros = $_REQUEST['outros'];
$Ganhos = $_REQUEST['ganhos'];
$Ganhosindicacao = $_REQUEST['ganhosindicacao'];





$sql = "update desp_rend set data_trabalho='".$Data_trabalho."',km_rodado='".$Km_rodado."',tempo_online='".$Tempo."',
numero_viagens='".$Viagens."', gasto_alimento='".$Alimento."', gasto_agua='".$Agua."', gasto_bala='".$Bala."', 
outros_gastos='".$Outros."', ganhos='".$Ganhos."', ganhos_indicacao='".$Ganhosindicacao."' 

where id_desp_rend=".$id;
$data = mysql_query($sql);

header("Location: dashboard2.php");



?>
