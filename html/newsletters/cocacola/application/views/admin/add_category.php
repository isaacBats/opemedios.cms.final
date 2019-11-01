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
	<h1>Agregar Categoría</h1>
	<form method="POST" action="<?=base_url('index.php/panel/action_add_category')?>">
		<label>Nombre de la Categoría</label><br>
		<input type="text" name="category_name">
		<button type="submit">Registrar</button>
	</form>
</body>
</html>