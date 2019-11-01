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
	<h1>Editar Platillo <?=$food['food_name']?></h1>
	<form method="POST" action="<?=base_url('index.php/panel/action_edit_food')?>">
		<label>ID Platillo</label><br>
		<input type="text" name="food_id" value="<?=$food['food_id']?>" readonly><br><br>
		<label>Categoría</label><br>
		<select  name="food_category">
		<?php
		foreach ($categories as $cat) {
			if ($cat['category_id'] == $food['food_category']) {
				$select = 'selected';
			}
			else {
				$select = NULL;
			}
			echo ' <option value="'.$cat['category_id'].'" '.$select.'>'.$cat['category_name'].'</option>'; 
		} ?>

		</select><br><br>
		<label>Nombre del Platillo</label><br>
		<input type="text" name="food_name" value="<?=$food['food_name']?>"><br><br>
		<label>Descripción del Platillo</label><br>
		<textarea name="food_description" maxlength="255"><?=$food['food_description']?></textarea><br><br>
		<button type="submit">Registrar</button>
	</form>
</body>
</html>