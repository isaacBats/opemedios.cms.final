<!--Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $title ?></h1>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Related Projects Row -->
        <div class="row">

            <?php foreach ($covers as $cover): ?>
                <div class="col-sm-3 col-xs-6" style="margin-bottom: 10px;">
                    <a href="/columnas/<?= $segment .'/'. $cover['id'] ?>">
                        <img class="img-responsive portfolio-item" src="/<?= $cover['imagen'] ?>" alt="<?= $cover['tipo_portada'] ?>" style="max-height: 350px;">
                        <figcaption class="items-descripcion">
                            <strong><?= $cover['nombre_fuente'] ?></strong>
                            <p><?= $cover['created_at'] ?></p>
                        </figcaption>
                    </a>
                </div>                
            <?php endforeach ?>

        </div>
        <!-- /.row -->
        <hr>

    </div>
<!-- /.container -->