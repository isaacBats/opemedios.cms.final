<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Registro empresa</h1>
	<form method="POST" action="<?=base_url('index.php/workeat/action_add_company')?>">
		<label>Nombre de la Compañia</label><br>
		<input type="text" name="company_name"><br>
		<label>email</label><br>
		<input type="text" name="company_email"><br>
		<label>telefono</label><br>
		<input type="text" name="company_phone"><br>
		<label>direccion</label><br>
		<textarea name="company_address"></textarea><br>
		<label>no empleados</label><br>
		<input type="text" name="company_employees"><br>
		<label>nombre representante</label><br>
		<input type="text" name="company_nameUser"><br>
		<label>apellido(s) representante</label><br>
		<input type="text" name="company_lastNameUser"><br>
		<label>comentarios</label><br>
		<textarea name="company_comments"></textarea><br>
		<button type="submit">Registrar</button>
	</form>
</body>
</html>