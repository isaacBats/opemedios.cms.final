<div class="row">
    <div class="col-lg-12 page-header">
        <h1 class="col-sm-6 col-md-8 col-lg-8"><?= $block->rows['name'] ?></h1>
        <button class="btn btn-primary pull-right mb-10 mt-20 ml-20" id="block-add-new"><i class="fa fa-plus"></i> Agregar noticia</button>
        <button class="btn btn-primary pull-right mb-10 mt-20 ml-20" id="block-save"><i class="fa fa-save"></i> Guardar</button>
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
    <div class="col-sm-12 col-md-12 col-lg-12 mb-20">
        <form method="get" id="bootpag_text_count">
        	<fieldset id="activ-form-edit">
	            <div class="form-group col-sm-12 col-md-6 col-lg-6">
					<label>Por Titulo</label>
					<input id="bootpag_text_titulo" type="text" name="titulo" class="form-control">
				</div>
				<div class="form-group col-sm-12 col-md-6 col-lg-6">
	                <label>Tipo de Fuente</label>
	                <select class="form-control" name="tipoFuente" id="bootpag_text_fuente_selected" required >
	                    <option value="">Seleccione un tipo de fuente</option>
	                    <option value="0">***Todas***</option>
	                  	<?php if( is_array( $tiposFuente ) ){
		                  		foreach ( $tiposFuente as $tf ) { ?>
										<option value="<?= $tf['id_tipo_fuente'] ?>"><?= $tf['descripcion'] ?></option>							
						<?php	} } ?>  
	                </select>
	            </div>
	        </fieldset>
	        <div class="form-inline">
				<div class="col-sm-12" id="bootpag_nummc">
					<label for="exampleInputName2">Mostrar &nbsp;</label>
					<input type="hidden" value="1" name="page" id="current_page">
					<select name="numpp" id="bootpag_text_count_select" class="form-control input-sm">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					<label for="exampleInputName2">&nbsp; Registros</label>
				</div>					
			</div>
        </form>
    </div>
   	<div class="col-lg-12 table-busqueda">
		<div class="table-responsive">
	        <table class="table table-bordered table-inverse nomargin">
		        <thead>
			    	<tr>
			        	<th class="text-center"></th>
			        	<th class="text-center">Noticia</th>
			            <th class="text-center">Fuente</th>
			            <th class="text-center">Tema</th>
			            <th class="text-center">Accion</th>
			        </tr>
		        </thead>
	          	<tbody>
					<?php if( is_array( $resultados ) ){
							foreach ($resultados as $res) { ?>
							<tr>
				            	<td class="text-center"></td>
				            	<td><?= $res['encabezado'] ?></td>
				              	<td><?= $res['fuente'] ?></td>
				              	<td>
				              		<select name="addThemeBlock" class="addThemeBlock form-control" >
										<option value="">Seleccione un tema</option>
										<?php foreach($thems as $them) { ?>
											<option value="<?= $them['id_tema'] ?>"><?= $them['nombre']?></option>
										<?php } ?>				              			
				              		</select>
				              	</td>
				            	<td>
				            		<a href="javascript:void(0);" data-bloque="<?= $id ?>" data-noticia="<?= $res['id']?>" class="btn btn-success block-save" >
				            			<i class="fa fa-check-circle"></i> Agregar
				            		</a>
				            	</td>
				             </tr>
					<?php	} } ?>
	          	</tbody>
	        </table>
	        <div class="col-md-6">
	        	<p id="bootpag_text">
	        		Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
	        	</p>
	        </div>
	        <div class="col-md-6"><p id="bootpag_pag" data-count="<?= $count ?>"></p></div>	
      	</div>
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