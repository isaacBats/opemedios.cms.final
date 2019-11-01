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
		<a href="<?=base_url('index.php/panel/categories')?>">Categorias</a>
		<a href="<?=base_url('index.php/panel/food')?>">Menu</a>
	</nav>
	<h1>Platillo <?=$food['food_name']?></h1>
	<form  action="<?=base_url('index.php/panel/upload_thumb/')?>" method="post" enctype="multipart/form-data">
		<label>ID Platillo</label><br>
		<input type="text" name="food_id" value="<?=$food['food_id']?>" readonly><br><br>
		<label>Imagen</label><br>
		<input type="file" name="file"/>
		<button type="submit">Subir Imagen</button>
	</form>
</body>
</html>