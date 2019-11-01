<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $type ?></title>
  <style type="text/css">
    .content {
      font-size: 16px;
      text-align: center;
    }
    .imagen {
      width: 100%;
    }
    .portada {
      width: 100%;
      margin: 0 auto;
    }
  </style>
</head>
<body class="content">
  <?php foreach ($covers->rows as $img): ?>
    <div class="portada">
      <img class="imagen" src="<?= "http://{$_SERVER['HTTP_HOST']}/{$img['imagen']}" ?>" alt="Opemedios" />
    </div>
  <?php  endforeach; ?>
  <footer style="text-align: center;">
    © Opemedios <?= date('Y') ?>
  </footer>
</body>
</html>