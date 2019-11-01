<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Op Medios Newsletters</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="<?=base_url('assets/css/styles.css');?>" rel="stylesheet">
    </head>
  <body class="text-center signin">
    <form class="form-signin" id="loginForm">
      <h1 class="h3 mb-3 font-weight-normal">OP Medios</h1>
      <div class="alert alert-danger hidden" role="alert" id="error">Usuario o contraseña no válida.</div>
      <label for="logemail" class="sr-only">Usuario</label>
      <input type="text" id="logemail" name="logemail" class="form-control" placeholder="Usuario" required autofocus>
      <label for="logpassword" class="sr-only">Password</label>
      <input type="password" id="logpassword"  name="logpassword" class="form-control" placeholder="Password" required>
      <button class="btn btn-lg btn-primary btn-block" id="validar">Entrar</button>
    </form>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="<?=base_url('assets/jquery/richtext/jquery.richtext.js');?>"></script>
  <script src="<?=base_url('assets/js/scripts.js');?>"></script>
  </body>
</html>