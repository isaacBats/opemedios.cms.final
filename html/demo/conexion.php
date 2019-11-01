<?php
$conexion = mysqli_connect ("localhost", "root_opmedios", "tE^T=ykT3.4X") or die (mysqli_error());
mysqli_select_db($conexion,"opemedios_db") or die (mysqli_error());
mysqli_query($conexion,"SET NAMES 'utf8'");
?>