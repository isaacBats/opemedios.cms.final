<html>
<head><title>::Opemedios</title>
</head>
	<body link="#42475b" alink="#786178" vlink="#6A7186">	
	<?
	include 'conexion.php';
	$sql = mysqli_query($conexion,"select * from noticia order by id_noticia limit 100");	
    while ($row = mysqli_fetch_array($sql))
    {				
		print $row['encabezado']."<br>";	
    }
    mysqli_free_result($sql); 
    mysqli_close ($conexion);
	?>
	</body>
</html>