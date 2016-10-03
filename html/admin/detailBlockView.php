<div class="row">
    <div class="col-lg-12 page-header">
        <h1 class="col-sm-6 col-md-8 col-lg-8"><?= $block->rows['name'] ?></h1>
        <button class="btn btn-outline btn-default pull-right mb-10 mt-20" id="block-edit">Editar bloque</button>
        <button class="btn btn-outline btn-default pull-right mb-10 mt-20 invisible" id="block-cancel">Cancelar</button>
    </div>    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-20">
        <form method="post" action="/panel/block/edit" class="form-inline invisible" id="form-block-edit">
        	<fieldset id="activ-form-edit" disabled>
	            <input type="hidden" name="blockId" value="<?= base64_encode( $id ) ?>" />                
	            <div class="form-group">
	                <label for="nombre del bloque">Nombre del bloque: </label>
	                <input class="form-control" name="blockName" value="<?= $block->rows['name'] ?>" required>                
	            </div>
	            <div class="form-group">
	                <label for="empresa">Empresa: </label>
	                <select class="select2"  name="empresaId" required>
	                    <option value="">Selecciona una Empresa</option>
	                    <?php if( is_array( $companies->rows ) ) {
	                            foreach ($companies->rows as $key => $empresa) { 
	                            	if( $empresa['id_empresa'] == $block->rows['empresa_id'] ){ ?>
	                                	<option value="<?= $empresa['id_empresa'] ?>" selected><?= $empresa['nombre'] ?></option>
	                          <?php }else{ ?>
	                                	<option value="<?= $empresa['id_empresa'] ?>"><?= $empresa['nombre'] ?></option>
	                    <?php } } }?>
	                </select>                
	            </div>
	            <input type="submit" class="btn btn-success" value="Editar">
	        </fieldset>
        </form>
    </div>
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3><?= $block->rows['empresa'] ?></h3>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
            <?php if( is_array( $noticiasBloque ) ) {
            		foreach ($noticiasBloque as $tema => $noticias){ ?>
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
            <?php } } }else{ ?>
            	<div class="alert alert-success"><?= $noticiasBloque ?></div>
            <?php }?>

            </div><!-- /.panel-body -->
        </div> <!-- /.panel-default -->
    </div> <!-- /.col-lg-12 -->
</div>