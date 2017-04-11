<!--Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $title ?></h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Buscar <?= strtolower($title) ?> por fecha  
                </div>
                <div class="panel-body">
                    <form method="get" action="">
                        <div class="form-inline">
                            <div class="input-group custom-search-form">
                                <label for="fecha">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" value=<?= isset($_GET['fecha']) ? $_GET['fecha'] : ""?>>
                                <span class="input-group-btn">
                                    <button class="btn" type="submit" style="padding: 8px 40px; margin-top: 24px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>    
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
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