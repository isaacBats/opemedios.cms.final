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
      max-width: 100%;
    }
    .portada {
      width: 800px;
      margin: 25px auto;
    }
  </style>
</head>
<body class="content">
  <?php foreach ($covers->rows as $img): ?>
    <div class="portada">
      <p>
        Titulo : <?= $img['titulo'] ?>
      </p>
      <p>
        Fuente : <?= $img['fuente_id'] ?>
      </p>
      <p>
        Autor : <?= $img['autor'] ?>
      </p>
      <p>
        Contenido : <p><?= $img['contenido'] ?></p>
      </p>
      <img class="imagen" src="<?= "http://{$_SERVER['HTTP_HOST']}/{$img['imagen']}" ?>" alt="Opemedios" />
    </div>
  <?php  endforeach; ?>
  <footer style="text-align: center;">
    © Opemedios <?= date('Y') ?>
  </footer>
</body>
</html>