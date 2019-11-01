<!-- Page Content -->
    <div class="container op-content">

        <!-- Page Heading -->
        <div class="row card-company">
            <div class="col-sm-3">
                <img src="/<?= $this->getCompany()['logo'] ?>" alt="<?= $this->getCompany()['name'] ?>">
            </div>
            <div class="col-sm-8 page-header card-company-name">
                <h1><?= $this->getCompany()['name'] ?></h1>
                <small class="card-filters">
                      Noticias de hoy: <strong><?= $countAsigned['today'] ?></strong> 
                    | Noticias del mes: <strong><?= $countAsigned['mounth'] ?></strong> 
                    | Total: <strong><?= $countAsigned['total'] ?></strong>
                </small>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <form action="" id="bootpag_text_count">
                <div class="form-inline">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Buscar..." name="search" id="search_client">
                        <span class="input-group-btn">
                            <button class="btn" type="submit" style="padding: 8px 40px;">
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

        <?php 
            $num = 1;
            if($news != 0):
                foreach ($news as $key => $notice): ?>
         <?php 
            if ($num % 2 == 0) {
              $addClassZebra = "f-zebra"; //ZEBRA CLASS
            }
            else {
                $addClassZebra = NULL;
            } 
        ?>         
            <div class="row <?=$addClassZebra?> f-col">
                <div class="col-md-4">
                    <div class="bloque-new item-center">
                        <a class="img-responsive">
                          <img src="<?= $notice['logo_fuente'] ?>">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 class="f-h4 text-muted">
                        <?= $notice['fuente'] ?>
                    </h4>
                    <h3 class="f-h3">
                        <?= $notice['encabezado'] ?>
                    </h3>
                    <p class="text-muted f-p">
                         <?= $notice['empresa_fuente'] .' | Autor:'.$notice['autor'] ?>
                    </p>
                    <p class="f-p"><?= cortarTexto($notice['sintesis'], 200) ?></p>
                    <a class="btn btn-primary" href="/noticia/<?= without_accents(strtolower($notice['tipofuente'])) .'/'. $notice['id'] ?>">Ver más<span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>

        <?php 
            $num++;
            endforeach; 
            else:
        ?>

            <strong>No hay Noticias que mostrar</strong>

        <?php endif; ?>
        <div class="col-md-6">
            <p id="bootpag_text">
                Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
            </p>
        </div>
        <!-- Pagination -->
        <?php if(isset($_GET['search'])): ?>
        <!--<div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li><a href="#">&laquo;</a></li>
                    <?=$pagination?>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>-->
        <?endif;?>
        <!-- /.row -->
        <hr>
    </div>
<!-- /.container -->
