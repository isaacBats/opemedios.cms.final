<!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row card-company">
            <div class="col-sm-3">
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

        <div class="row">
            <form action="" id="bootpag_text_count">
                <div class="form-inline">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search..." name="search">
                        <span class="input-group-btn">
                            <button class="btn" type="button" style="padding: 8px 40px;">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <div class="col-sm-12" id="bootpag_nummc" style="padding: 15px 0;">
                        <label for="exampleInputName2">Mostrar &nbsp;</label>
                        <input type="hidden" value="1" name="page" id="current_page">
                        <select name="numpp" id="bootpag_text_count_select" class="form-control input-sm">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label for="exampleInputName2">&nbsp; Noticias</label>
                    </div>                  
                </div>
            </form>
        </div> 

        <?php foreach ($news as $key => $notice): ?>            
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
        <div class="col-md-6">
            <p id="bootpag_text">
                Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
            </p>
        </div>
        <div class="col-md-6"><p id="bootpag_pag" data-count="<?= $count ?>"></p></div> 

        
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
