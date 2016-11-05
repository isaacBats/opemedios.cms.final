<?= $this->flashAlerts('portada'); ?>
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
			<div class="col-sm-9 inline line-bottom">
				<?php 
					$form = explode(' ', $titulo); 
					$ext = strtolower ( end( $form ) );
				?>
				<form method="post" action="<?= $action ?>" class="form-inline" enctype="multipart/form-data">
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
					<input type="submit" class="btn btn-success" value="Cargar"> 
				</form>
			</div>
			<div class="col-sm-12">
				<?php if( sizeof( $covers ) > 0 ): ?> 
					<article class="items-covers col-sm-12">
					<?php foreach ($covers as $thumbCover): ?>
							<figure class="items-img col-xs-6 col-sm-6 col-md-4 col-lg-3">
								<img src="/<?= $thumbCover['thumb'] ?>" alt="<?= $titulo . ' - ' . $thumbCover['nombre_fuente'] ?>" width="180" heigth="240">
								<figcaption class="items-descripcion">
									<strong><?= $thumbCover['nombre_fuente'] ?></strong>
									<p><?= $thumbCover['created_at'] ?></p>
								</figcaption>
							</figure>
					<?php endforeach; ?>
					</article>
				<?php else: 
						echo '<strong>No cuentas con '.$titulo.' para este día</strong>'; 
					  endif; 
				?>
			</div>
		</div>
	</div>
</div>