<?php
include_once 'header.php';



$id = $_REQUEST['cod'];


	if ($id != null) {
		
		
		$sql= mysql_query( "delete from desp_rend where id_desp_rend=".$id);
		
		$sabers = mysql_fetch_assoc($sql);
		
		header("Location: dashboard2.php");
	}
	else
	{
		
		header("Location: dashboard2.php");
		
	}

?>


<html>
<head>
</head>

<title>Excluir Igreja</title>

<body>
</body>



</html>