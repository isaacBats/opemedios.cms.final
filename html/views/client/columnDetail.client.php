<!--Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?= $column['titulo'] ?>
                    <br>
                    <small style="font-size: 12px"><?= getFechaLarga($column['created_at']) ?></small>
                    <br>                
                    <small>
                        <i class="fa fa-newspaper-o" ></i> <?= $font['nombre'] ?>
                        <span style="font-size: 12px"> ( Autor: <cite><?= $column['autor'] ?></cite> )</span>
                    </small>
                            
                </h1>
            </div>
        </div>
        <!-- /.row -->
        
        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-sm-2">
                <img class="img-responsive portfolio-item" src="/<?= $column['imagen'] ?>" alt="<?= $column['tipo_columna'] ?>" style="max-height: 250px;">
                <figcaption class="items-descripcion">
                    <!-- <strong><a href="javaScripts:void(0);">Descargar Documento</a></strong> -->
                </figcaption>
            </div>
            <div class="col-sm-8">
                <p>
                    <?= $column['contenido'] ?>
                </p>
            </div>
        </div>
        <!-- /.row -->
        
        <hr>

    </div>
<!-- /.container -->