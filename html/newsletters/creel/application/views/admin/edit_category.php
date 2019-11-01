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
		<a href="<?=base_url('index.php/panel/categories')?>">Categorias</a>
	</nav>
	<h1>Editar Categoría <?=$category['category_name']?></h1>
	<form method="POST" action="<?=base_url('index.php/panel/action_edit_category')?>">
		<label>ID Categoría</label><br>
		<input type="text" name="category_id" value="<?=$category['category_id']?>" readonly><br><br>
		<label>Renomabrar Categoría</label><br>
		<input type="text" name="category_name"><br><br>
		<button type="submit">Cambiar</button>
	</form>
</body>
</html>