<!--Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $new['encabezado'] ?>
                    <br>
                    <small style="font-size: 12px"><?= getFechaLarga($new['fecha']) ?></small>
                    <br>                
                    <small><?= $media['icon'] ?> <?= $new['fuente'] .'('.$new['seccion'].')'?></small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <!-- <img class="img-responsive" src="http://placehold.it/750x500" alt=""> -->
                <?= $media['file'] ?>
            </div>

            <div class="col-md-4">
                <!-- <h3>Sintesis</h3> -->
                <p><?= $new['sintesis'] ?></p>
                <!-- <h3>Detalles</h3> -->
                <!-- <ul style="list-style: none">
                    <li><span class="label-red">Autor:</span> <?php //echo $new['autor'] .'('.$new['tipoautor'].')'?></li>
                    <li><span class="label-red">Alcance:</span> <?php //echo $new['alcance'] ?></li>
                    <li><span class="label-red">Genero:</span> <?php //echo $new['genero'] ?></li>
                    <li><span class="label-red">Tendencia:</span> <?php //echo $new['tendencia'] ?></li>
                </ul> -->
                <span class="label-red">Autor:</span> <?= $new['autor'] .'('.$new['tipoautor'].')'?>
                <br>
                <span class="label-red">Alcance:</span> <?= $new['alcance'] ?>
                <br>
                <span class="label-red">Genero:</span> <?= $new['genero'] ?>
                <br>
                <span class="label-red">Tendencia:</span> <?= $new['tendencia'] ?>
                <?php if (isset($newInternet)): ?>
                    <br>
                    <span class="label-red">URL:</span> <a target="_blank" href="<?= $newInternet['url'] ?>">Ver pagina</a>                    
                <?php endif ?>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <!-- <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

        </div> -->
        <!-- /.row -->
        <hr>

    </div>
<!-- /.container -->