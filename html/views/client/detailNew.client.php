<!--Page Content -->
    <div class="container">

        <div class="row padding-top-40">
            <div class="col-lg-12">
               <img class="thumbnail new" style="max-width: 220px;" src="<?=$new['thumbnail_empresa']?>" alt="">
                <small style="position: absolute; right: 0px; top: 0px"><?= getFechaLarga($new['fecha']) ?></small>
            </div>
        </div>

        <!-- NOTICIA HEADER -->
        <div class="row spacer-20">
            <div class="col-lg-12">
                <h1 class="new"><?= $new['encabezado'] ?></h1>
                <small style="font-size: 12px">SECCION: <?=$new['seccion']?></small>
            </div>
        </div>

        <div class="row spacer-20">
            <div class="col-lg-12">
                <?=$new['sintesis']?>
            </div>
        </div>
        <div class="row spacer-20">
            <div class="col-lg-8">

                <?php if (isset($_SESSION['user'])): ?>
                <div class="col-lg-4">
                    <p><span class="label-red">Autor:</span> <?= $new['autor'] ?></p>
                    <p><span class="label-red">Alcance:</span> <?= number_format($new['alcance']) ?></p>
                </div>
                <div class="col-lg-4">
                    <p><span class="label-red">Genero:</span> <?= $new['genero'] ?></p>
                    <p><span class="label-red">Tendencia:</span> <?= $new['tendencia'] ?></p>
                </div>
                <div class="col-lg-4">
                    <?php if (isset($noticiaTipoData)): ?>
                       <!-- <p><span class="label-red">URL:</span> <a target="_blank" href="<?= $noticiaTipoData['url'] ?>">Ver pagina</a></p> -->
                    <?php endif ?>
                    <?php if (isset($noticiaTipoData)): ?>
                        <p><span class="label-red">Costo beneficio:</span> <?=isset( $noticiaTipoData['costo']) ? "$".$noticiaTipoData['costo']: '$0' ?></p> 
                    <?php endif ?>
                    <?php if (isset($noticiaTipoData['porcentaje_pagina'])): ?>
                        <p><span class="label-red">Tamaño de la nota:</span> <?=isset( $noticiaTipoData['porcentaje_pagina']) ? $noticiaTipoData['porcentaje_pagina']."%": '' ?> </p>
                    <?php endif ?>
                </div>
                <?php endif ?>
            </div>
            <div class="col-lg-4 text-right">
                <?php 
                    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                ?>
                <a href="https://facebook.com/sharer.php?u=<?=$new['share']?>" onclick="window.open(this.href, 'Share', 'width=480, height=500, left=24, top=24, scrollbars, resizable'); return false;" class="btn btn-facebook btn-sm">Facebook</a>
                 <a href="https://twitter.com/intent/tweet?url=<?=$new['share']?>&text=<?=$new['encabezado'].' - '.$new['autor'].', '.$new['fuente'] ?>&via=DeMonitoreo" onclick="window.open(this.href, 'Share', 'width=480, height=500, left=24, top=24, scrollbars, resizable'); return false;" class="btn btn-twitter btn-sm">Twitter</a>
            </div>
        </div>

        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-12">
                <?= $media['file'] ?>
            </div>
        </div>
        <hr>
    </div>
<!-- /.container -->