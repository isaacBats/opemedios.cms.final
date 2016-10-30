<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header"><?= $titulo ?></h1>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			Agregar <?= $titulo ?>
		</div>
		<div class="panel-body">
			<div class="col-sm-9 inline">
				<?php 
					$form = explode(' ', $titulo); 
					$ext = strtolower ( end( $form ) );
				?>
				<form method="post" action="<?= $action ?>" class="form-inline" id="form-<?= $ext ?>" enctype="multipart/form-data">
					<div class="form-group fuente">
						<select name="fuente" class="form-control select2" required="true">
							<option value="">Selecciona la Fuente</option>
							<?php if ( is_array( $this->fuentes ) ): 
									foreach ($this->fuentes as $fuente) { ?>
										<option value="<?= $fuente['id_fuente']?>"><?= $fuente['nombre'] ?></option>
										
							<?php	} endif ?>
						</select>					
					</div>
					<div class="form-group file">
						<input type="file" name="<?= $ext ?>" required="true">
					</div>
					<input type="submit" class="btn btn-success" id="btn-submit" value="Cargar"> 
				</form>			
			</div>
		</div>
	</div>
</div>