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
	</nav>
	<h1>Menu</h1>
	<nav>
		<a href="<?=base_url('index.php/panel/categories')?>">Categorias</a> | 
		<a href="<?=base_url('index.php/panel/add_food')?>">Añadir Platillo</a>
	</nav>
	<h2>Filtros</h2>
	<nav>
		<?php foreach ($categories as $cat) {
			echo '<a href="'.base_url('index.php/panel/food/filter/').$cat['category_id'].'">'.$cat['category_name'].'</a><br>';
		} ?>
		<a href="<?=base_url('index.php/panel/food')?>">Todos</a>
	</nav>
	<br><br>
	<table>
		<thead>
			<tr>
				<th>Imagen</th>
				<th>Categoría</th>
				<th>Nombre</th>
				<th>Descripción</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($food as $fo) {
			if( $fo['food_status'] == 0 ) {
				$status = "Inactivo";
				$link = base_url('index.php/panel/active_food/'.$fo['food_id']);
				$link_text = "Activar";
			}
			else 
			{
				$status = "Activo";
				$link = base_url('index.php/panel/inactive_food/'.$fo['food_id']);
				$link_text = "Desactivar";
			}
			echo 
			'<tr>
				<td><img src="'.base_url('assets/food').'/'.$fo['food_thumb'].'""></td>
				<td>'.$fo['category_name'].'</td>
				<td>'.$fo['food_name'].'</td>
				<td>'.$fo['food_description'].'</td>
				<td>'.$status.'</td>
				<td>
					<a href="'.$link.'">'.$link_text.'</a> |
					<a href="'.base_url('index.php/panel/thumb_food/'.$fo['food_id']).'">Subir imagen</a> |
					<a href="'.base_url('index.php/panel/edit_food/'.$fo['food_id']).'">Editar</a> |
					<a href="'.base_url('index.php/panel/delete_food/'.$fo['food_id']).'">Borrar</a> |
				</td>
			</tr>';
		} ?>
		</tbody>
	</table>
</body>
</html>