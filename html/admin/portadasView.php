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
				<form method="post" action="<?= $action ?>" class="form-inline" id="form-portada" enctype="multipart/form-data">
					<input type="hidden" name="tipo_portada" value="<?= $tipo_portada ?>">
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
						<input type="file" name="file" required="true" id="file">
					</div>
					<input type="submit" class="btn btn-success" id="btn-submit" value="Cargar"> 
				</form>
				<div class="progress">
        			<div class="bar"></div >
        			<div class="percent">0%</div >
    			</div>    
    			<div id="status"></div>
			</div>
		</div>
	</div>
</div>