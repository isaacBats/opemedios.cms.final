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
		<a href="<?=base_url('index.php/panel')?>">Panel</a> | 
		<a href="<?=base_url('index.php/panel/food')?>">Menu</a>
	</nav>
	<h1>Categorias</h1>
	<nav>
		<a href="<?=base_url('index.php/panel/add_category')?>">Añadir Categoría</a>
	</nav>
	<br><br>
	<table>
		<thead>
			<tr>
				<th>Categoría</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($categories as $cat) {
			echo 
			'<tr>
				<td>'.$cat['category_name'].'</td>
				<td>
					<a href="'.base_url('index.php/panel/edit_category/'.$cat['category_id']).'">Editar</a> |
					<a href="'.base_url('index.php/panel/delete_category/'.$cat['category_id']).'">Borrar</a>
				</td>
			</tr>';
		} ?>
		</tbody>
	</table>
</body>
</html>