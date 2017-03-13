<!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row card-company">
            <div class="col-sm-4">
                <img src="/<?= $this->getCompany()['logo'] ?>" alt="<?= $this->getCompany()['name'] ?>">
            </div>
            <div class="col-sm-8 page-header card-company-name">
                <h1><?= $this->getCompany()['name'] ?></h1>
                <small class="card-filters">
                        <!-- <a class="card-company-filters" href="javascript_void(0);">Noticias de hoy: <strong>10</strong></a> -->
                      Noticias de hoy: <strong><?= count($newsToday) ?></strong> 
                    | Noticias del mes: <strong><?= count($newsMonth) ?></strong> 
                    | Total: <strong><?= count($news) ?></strong>
                </small>
            </div>
        </div>
        <!-- /.row -->

        <?php foreach (array_reverse($news) as $key => $notice): ?>            
            <div class="row">
                <div class="col-md-7 adjunto-icon color-<?= without_accents(strtolower($notice['tipofuente'])) ?>" >
                    <a href="/noticia/<?= without_accents(strtolower($notice['tipofuente'])) .'/'. $notice['id'] ?>" class="adjunto-link">
                        <!-- <img class="img-responsive" src="http://placehold.it/700x300" alt="" width="700" height="300"> -->
                        <?= $notice['adjunto']['icon'] ?>
                    </a>
                </div>
                <div class="col-md-5" style="margin-top: -30px;">
                    <h3><?= $notice['encabezado'] ?></h3>
                    <h4>
                        <?= $notice['fuente'] ?>
                        <br>
                        <small class="text-muted">Autor: <?= $notice['autor'] ?></small>        
                    </h4>
                    <p><?= cortarTexto($notice['sintesis'], 200) ?></p>
                    <a class="btn btn-primary" href="/noticia/<?= without_accents(strtolower($notice['tipofuente'])) .'/'. $notice['id'] ?>">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>

        
        <!-- Pagination -->
        <!-- <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div> -->
        <!-- /.row -->

        <hr>


    </div>
<!-- /.container -->
