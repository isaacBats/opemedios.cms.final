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
	<h1>Usuarios</h1>
	<table>
		<thead>
			<tr>
				<th>nombre</th>
				<th>apellidos</th>
				<th>email</th>
				<th>telefono</th>
				<th>empresa</th>
				<th>status</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($user as $fo) {
			if($fo['user_status'] == 1 ) {
				$status = "Activo";
			}		
			else 
			{
				$status = "Inactivo";
			}
			echo 
			'<tr>
				<td>'.$fo['user_name'].'</td>
				<td>'.$fo['user_lastName'].'</td>
				<td>'.$fo['user_email'].'</td>
				<td>'.$fo['user_phone'].'</td>
				<td>'.$fo['company_name'].'</td>
				<td>'.$status.'</td>
			</tr>';
		} ?>
		</tbody>
	</table>
</body>
</html>