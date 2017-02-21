<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Editar <?= $titulo ?></h1>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			Editar <?= $column['titulo'] ?>
		</div>
		<div class="panel-body">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<form method="post" action="/panel/prensa/editar/<?= $typeColumn . '/' . $column['id'] ?>" enctype="multipart/form-data" >
					<div class="form-group">
						<label>Titulo</label>
						<input class="form-control" name="title" value="<?= $column['titulo'] ?>" />
					</div>
					<div class="form-group">
						<label>Autor</label>
						<input class="form-control" name="author" value="<?= $column['autor'] ?>" />
					</div>
					<div class="form-group">
						<label>Contenido</label>
						<textarea id="summernote" name="contenido">
							<?= $column['contenido'] ?>
						</textarea>
					</div>
					<div class="form-group fuente">
						<select name="fuente_id" class="form-control select2" required="true">
							<option value="">Selecciona la Fuente</option>
							<?php if ( is_array( $this->fuentes ) ): 
									foreach ($this->fuentes as $fuente) { 
										if ($fuente['id_fuente'] == $column['fuente_id']) { ?>
										<option selected value="<?= $fuente['id_fuente']?>"><?= $fuente['nombre'] ?></option>
										<?php } else { ?>									
										<option value="<?= $fuente['id_fuente']?>"><?= $fuente['nombre'] ?></option>									
							<?php }	} endif; ?>
						</select>					
					</div>
					<div class="form-group col-sm-4">
			        	<img src="/<?= $column['thumb']?>" >			            
			          	<input type="file" name="imagen" id="input-imagen" class="inp-thum" style="display: none;">
			          	<a href="javascript:void(0);" id="btn-changeImage" class="btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
			          	<span class="help-block">Imagen de la columna</span>
			        </div>
			        <div class="col-sm-12 form-group">
						<input type="submit" class="btn btn-success pull-right" value="Guardar"> 			        	
			        </div>
				</form>			
			</div>
		</div>
	</div>
</div>