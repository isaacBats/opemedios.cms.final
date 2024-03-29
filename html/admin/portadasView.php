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
					$ext = strtolower (end($form));
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
			<?php if ($pdf): ?>
			<div class="col-sm-12">
				<a class="file-generate btn btn-primary" href="/archivos/generados/pdf/<?= $this->encodeB64($pdf['id'],$pdf['name']) ?>" target="_blank" >Ver pdf generado</a>
			</div>
			<?php endif; ?>
			<div class="col-sm-12">
				<?php if( sizeof( $covers ) > 0 ): ?> 
					<form method="post" action="/panel/prensa/generar-pdf" id="form-create-pdf" >
						<input type="hidden" name="tipo_portada" value="<?= $tipo_portada ?>">
						<article class="items-covers col-sm-12">
						<?php foreach ($covers as $thumbCover): ?>
								<figure class="items-img col-sm-3">
									<label class="ckbox">
										<input type="checkbox" name="cover_<?= $thumbCover['id'] ?>">
										<span></span>
									</label>
									<div class="btn-group pull-right">
		                  <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		                      <i class="fa fa-chevron-down"></i>
		                  </button>
		                  <ul class="dropdown-menu slidedown">
		                      <li>
		                          <a href="javascript:void(0);" class="delete-portada" data-id="<?= $thumbCover['id'] ?>" data-toggle="modal" data-target="#myModal" ><i class="fa fa-times fa-fw"></i> Eliminar</a>
		                      </li>
		                  </ul>
		              </div>
									<img src="/<?= $thumbCover['thumb'] ?>" alt="<?= $titulo . ' - ' . $thumbCover['nombre_fuente'] ?>" width="180" heigth="240">
									<figcaption class="items-descripcion">
										<strong><?= $thumbCover['nombre_fuente'] ?></strong>
										<p><?= $thumbCover['created_at'] ?></p>
									</figcaption>
								</figure>
						<?php endforeach; ?>
							<button class="btn btn-info" id="savepdf">Generar PDF con portadas</button>
						</article>
					</form>
				<?php else: 
						echo '<strong>No cuentas con '.$titulo.' para este día</strong>'; 
					  endif; 
				?>
			</div>
		</div>
	</div>
</div>