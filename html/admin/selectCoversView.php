<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <?php foreach ($covers as $cover): ?>
      <img class="img-responsive" src="/<?= $cover['imagen'] ?>">
    <?php endforeach; ?>
  </div>
</div>