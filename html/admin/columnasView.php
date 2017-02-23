<?= $this->flashAlerts('columnas'); ?>
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
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<?php 
					$form = explode(' ', $titulo); 
					$ext = strtolower ( end( $form ) );
				?>
				<form method="post" action="<?= $action ?>" id="form-col_<?= $ext ?>" enctype="multipart/form-data">
					<input type="hidden" name="tipo_columna" value="<?= $tipo_columna ?>">
					<div class="form-group">
						<label>Titulo</label>
						<input class="form-control" name="title" placeholder="Titulo de la columna" />
					</div>
					<div class="form-group">
						<label>Autor</label>
						<input class="form-control" name="author" />
					</div>
					<div class="form-group">
						<label>Contenido</label>
						<textarea id="summernote" name="contenido">
							Redacta tu columna
						</textarea>
					</div>
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
						<input type="file" name="file" required="true">
					</div>
					<input type="submit" class="btn btn-success pull-right" id="btn-submit" value="Cargar"> 
				</form>			
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-12">
				<?php if( sizeof( $covers ) > 0 ): ?> 
					<article class="items-covers col-sm-12">
					<?php foreach ($covers as $thumbCover): ?>
							<figure class="items-img col-xs-6 col-sm-6 col-md-4 col-lg-3">
								<div class="btn-group pull-right">
	                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                                    <i class="fa fa-chevron-down"></i>
	                                </button>
	                                <ul class="dropdown-menu slidedown">
	                                    <li>
	                                        <a href="/panel/prensa/show/<?= str_replace(' ','-', strtolower($titulo)) . '/' . $thumbCover['id'] ?>">
	                                            <i class="fa fa-edit fa-fw"></i> Ver
	                                        </a>
	                                    </li>
	                                    <!-- <li>
	                                        <a href="#">
	                                            <i class="fa fa-times fa-fw"></i> Eliminar
	                                        </a>
	                                    </li> -->
	                                </ul>
	                            </div>
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