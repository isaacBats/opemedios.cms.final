<div class="row">
    <div class="col-lg-12 page-header">
        <h1><?= $block->rows['name'] ?></h1>
    </div>    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><?= $block->rows['empresa'] ?></h3>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
            <?php foreach ($noticiasBloque as $tema => $noticias){ ?>
            		<h4 class="page-header"><?= $tema ?></h4>
            		<?php foreach ($noticias as $noticia) { ?>
            			<article class="panel-body">
            				<!-- <button type="button" class="close" >&times;</button> -->
            				<dl>
                                <dt>Encabezado</dt>
                                <dd><?= $noticia['encabezado'] ?></dd>
                                <dt>Sintesis</dt>
                                <dd><?= $noticia['sintesis'] ?></dd>
                            </dl>
            			</article>
            <?php } }?>

            </div><!-- /.panel-body -->
        </div> <!-- /.panel-default -->
    </div> <!-- /.col-lg-12 -->
</div>