<div class="row">
    <div class="col-lg-12 page-header">
        <h1 class="col-sm-6 col-md-8 col-lg-8"><?= $block->rows['name'] ?></h1>
    </div>    <!-- /.col-lg-12 -->
</div>

<div class="row <?php if(!isset($_GET['titulo'])) echo 'invisible'; ?>" id="block-form-add-new">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-20">
        <form method="get" id="bootpag_text_count">
        	<fieldset <?php if(!isset($_GET['titulo'])) echo 'disabled="disabled"'; ?>>
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
				<div class="col-sm-4 col-md-4" id="bootpag_nummc">
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
					<?php if( is_array( $resultados->rows ) ){
							foreach ($resultados->rows as $res) { ?>
							<tr>
				            	<td class="text-center"></td>
				            	<td><?= $res['encabezado'] ?></td>
				              	<td><?= $res['fuente'] ?></td>
				              	<td>
				              		<select name="addThemeBlock" class="addThemeBlock form-control" data-rule-required="true" data-msg-required="Seleccione un tema" >
										<option value="">Seleccione un tema</option>
										<?php foreach($thems as $them) { ?>
											<option value="<?= $them['id_tema'] ?>"><?= $them['nombre']?></option>
										<?php } ?>				              			
				              		</select>
				              	</td>
				            	<td>
				            		<button data-bloque="<?= $id ?>" data-noticia="<?= $res['id']?>" class="btn btn-success block-save" >
				            			<i class="fa fa-check-circle"></i> Agregar
				            		</button>
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
<div class="row panel panel-green invisible">
	<div class="panel-heading">
		<span>Contactos relacionados</span>
		<a href="javascript:void(0);" class="btn btn-default" id="block-contactos-cancela" style="margin: -7px; float: right;">Cancelar</a>
	</div>
	<div class="panel-body">
		<div class="checkbox">
            <label>
                <input type="checkbox" class="checkbox-todos">Seleccionar todos
            </label>
        </div>
		<form method="post" action="/panel/news/block/records/send" id="form-send-block">
			<fieldset id="active-form-contacs" disabled>
				<input type="hidden" name="block" value="<?= base64_encode($id); ?>">
		        <div class="table-responsive">
		            <table class="table table-striped table-bordered table-hover checkbox-active">
		                <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>Nombre</th>
		                        <th>Correo</th>
		                        <th>Enviar</th>
		                    </tr>
		                </thead>
		                <tbody>
		                	<?php if( is_array($emails) ){
		                			foreach($emails as $key => $mail){ ?>
			                    <tr>
			                        <td><?= $key + 1 ?></td>
			                        <td><?= $mail['nombre']?></td>
			                        <td><?= $mail['email'] ?></td>
			                        <td><input type="checkbox" name="<?= $mail['nombre'] ?>" value="<?= $mail['email'] ?>" ></td>
			                    </tr>
		                    <?php 	} }else{ ?>
		                    	<tr>
			                    	<?= $emails ?>
			                    </tr>
		                    <?php } ?>
		                </tbody>
		            </table>
		        </div><!-- /.table-responsive -->
		        <div class="panel-footer">
					<div class="col-sm-offset-5 col-md-offset-10 col-lg-offset-11">
						<input type="submit" class="btn btn-outline btn-primary btn-lg" value="Enviar">
					</div>
		        </div>
		    </fieldset>
	    </form>
    </div><!-- /.panel-body -->
</div>
<div class="row">
	<div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading block-send">
                <h3><?= $block->rows['empresa'] ?></h3>
                <a href="/panel/news/blocks/preview/<?=$id?>" target="_blank" class="btn btn-info mt-10 pull-right" style="margin: 10px;">Vista previa</a> 
                <a href="javascript:void(0);" class="btn btn-success mt-10 pull-right" id="block-contactos-btn">Selecciona contactos para enviar Newsletter</a>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
            <?php if( is_array( $noticiasBloque ) ) {
            		foreach ($noticiasBloque as $tema => $noticias){ ?>
            			<h4 class="page-header"><?= $tema ?></h4>
            			<?php foreach ($noticias as $noticia) { ?>
            				<article class="panel-body muestra">
            					<!-- <button type="button" class="close" >&times;</button> -->
            					<dl>
                                	<dt>Encabezado</dt>
                                	<dd><?= $noticia['encabezado'] ?></dd>
                                	<dt>Sintesis</dt>
                                	<dd><?= $noticia['sintesis'] ?></dd>
                                	<dt>Fuente</dt>
                                	<dd><?= $noticia['fuente'] ?></dd>
                            	</dl>
                            	<a href="javascript:void(0);" data-bn="<?= base64_encode( $noticia['bnid'] ) ?>" data-toggle="modal" data-target="#myModal" class="block-remove-new">X</a>
                            	<a href="/panel/new/view/<?=$noticia['noticiaId']?>" class="block-detail-new btn btn-info" target="_blank">Ver</a>
            				</article>
            <?php } } }else{ ?>
            	<div class="alert alert-success"><?= $noticiasBloque ?></div>
            <?php }?>

            </div><!-- /.panel-body -->
        </div> <!-- /.panel-default -->
    </div> <!-- /.col-lg-12 -->
</div>