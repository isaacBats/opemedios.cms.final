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
	<h1>Añadir Platillo</h1>
	<form method="POST" action="<?=base_url('index.php/panel/action_add_food')?>">
		<label>Categoría</label><br>
		<select  name="food_category">
			<?php foreach ($categories as $cat) { echo ' <option value="'.$cat['category_id'].'">'.$cat['category_name'].'</option>'; } ?>
		</select><br><br>
		<label>Nombre del Platillo</label><br>
		<input type="text" name="food_name"><br><br>
		<label>Descripción del Platillo</label><br>
		<textarea name="food_description" maxlength="255"></textarea><br><br>
		<button type="submit">Registrar</button>
	</form>
</body>
</html>