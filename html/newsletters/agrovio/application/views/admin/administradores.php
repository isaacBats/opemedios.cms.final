<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<nav>
		<a href="<?=base_url('index.php/panel')?>">Panel</a>
		<a href="<?=base_url('index.php/panel/food')?>">Menu</a>
	</nav>
	<h1>Administradores</h1>
	<table>
		<thead>
			<tr>
				<th>nombre</th>
				<th>apellidos</th>
				<th>email</th>
				<th>telefono</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($user as $fo) {
		
			echo 
			'<tr>
				<td>'.$fo['user_name'].'</td>
				<td>'.$fo['user_lastName'].'</td>
				<td>'.$fo['user_email'].'</td>
				<td>'.$fo['user_phone'].'</td>
			</tr>';
		} ?>
		</tbody>
	</table>
</body>
</html>