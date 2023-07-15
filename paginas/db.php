<?php

	$host = "localhost";
	$user = "root";
	$pass = "";
	$banco= "cbbnc407_uber";
	// Conecta ao banco de dados
	$mysqli = new mysqli($host, $user, $pass, $banco);
	// Verifica se ocorreu algum erro
	if (mysqli_connect_error()) {
	die('Não foi possível conectar-se ao banco de dados: ' . mysqli_connect_error());
	exit();
	}
	

?>
<html>
<header>
	<meta charset="utf-8">
	
	<style type="text/css">
		html{
			-webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
		       -moz-animation: fadein 2s; /* Firefox < 16 */
		        -ms-animation: fadein 2s; /* Internet Explorer */
		         -o-animation: fadein 2s; /* Opera < 12.1 */
		            animation: fadein 2s;
		}

		@keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Firefox < 16 */
		@-moz-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Safari, Chrome and Opera > 12.1 */
		@-webkit-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Internet Explorer */
		@-ms-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}

		/* Opera < 12.1 */
		@-o-keyframes fadein {
		    from { opacity: 0; }
		    to   { opacity: 1; }
		}}
	</style>
</header>
</html>