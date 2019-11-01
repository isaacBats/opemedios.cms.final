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
	<h1>Empresas</h1>
	<table>
		<thead>
			<tr>
				<th>nombre</th>
				<th>email</th>
				<th>telefono</th>
				<th>direccion</th>
				<th>nombre</th>
				<th>apellidos</th>
				<th>comentarios</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($company as $fo) {
			echo 
			'<tr>
				<td>'.$fo['company_name'].'</td>
				<td>'.$fo['company_email'].'</td>
				<td>'.$fo['company_phone'].'</td>
				<td>'.$fo['company_address'].'</td>
				<td>'.$fo['company_nameUser'].'</td>
				<td>'.$fo['company_lastNameUser'].'</td>
				<td>'.$fo['company_comments'].'</td>
			</tr>';
		} ?>
		</tbody>
	</table>
</body>
</html>