<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h1>Registro</h1>
	<form method="POST" action="<?=base_url('index.php/workeat/action_add_user')?>">
		<label>Nombre</label><br>
		<input type="text" name="user_name"><br>
		<label>apellido</label><br>
		<input type="text" name="<div class="c-field u-mb-small">
                        <label class="c-field__label" for="input1">Nombre</label> 
                        <input class="c-input" type="text" id="input1" name="user_name"> 
                    </div>"><br>
		<label>empresa</label><br>
		<select  name="user_company">
			<?php foreach ($companies as $cat) { echo ' <option value="'.$cat['company_id'].'">'.$cat['company_name'].'</option>'; } ?>
		</select><br>
		<label>email</label><br>
		<input type="text" name="user_email"><br>
		<label>telefono</label><br>
		<input type="text" name="user_phone"><br>
		<label>password</label><br>
		<input type="text" name="user_password"><br>
		<button type="submit">Registrar</button>
	</form>
</body>
</html>