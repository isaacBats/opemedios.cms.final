<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Primeras Planas</h1>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			Agregar Primeras Planas
		</div>
		<div class="panel-body">
			<div class="col-sm-9 inline">
				<form method="post" class="form-inline" id="form-planas" enctype="multipart/form-data">
					<div class="form-group fuente">
						<select name="fuente" class="form-control select2" id="select_fuente" required="true">
							<option value="">Selecciona la Fuente</option>
							<?php if ( is_array( $fuentes ) ): 
									foreach ($fuentes as $fuente) { ?>
										<option value="<?= $fuente['id_fuente']?>"><?= $fuente['nombre'] ?></option>
										
							<?php	} endif ?>
						</select>					
					</div>
					<div class="form-group file">
						<input type="file" name="plana" id="plana" required="true">
					</div>
					<input type="submit" class="btn btn-success" value="Cargar"> 
				</form>			
			</div>
		</div>
	</div>
</div>