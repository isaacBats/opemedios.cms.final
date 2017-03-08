<?php use utilities\FontType; ?>

<div class="panel panel-default">
	<div class="panel-heading">
		Fuente
		<div class="pull-right">
		    <div class="btn-group">
		        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
		            Acciones
		            <span class="caret"></span>
		        </button>
		        <ul class="dropdown-menu pull-right" role="menu">
		            <li>
		            	<a href="javascript:void(0);" id="btn-font-edit">
		            		Editar Fuente
		            	</a>
		            </li>
		        </ul>
		    </div>
		</div>		
	</div>
	<div class="panel-body">
		<div id="view-font">
			<div class="col-sm-12">
				<h1 class="page-header"><?= $font['nombre'] ?></h1>
			</div>
			<div class="col-md-6">
				<img src="/<?= $font['logo']  ?>" alt="<?= $font['nombre'] ?>" width="320">
			</div>
			<div class="col-md-6">
				<?php foreach ($font as $key => $value): 
						if( $key != 'id_fuente' && $key != 'id_cobertura' && $key != 'logo' && $key != 'id_tipo_fuente' && $key != 'id_senal' && $key != 'is_active' ): ?>
							<p><strong><?= ucwords( $key ) ?>: </strong><?= $value ?></p>
				<?php endif; endforeach; ?>
			</div>
		</div>
		<div id="edit-font" class="col-sm-12">
			<form action="/panel/font/edit/<?= $id ?>" method="post" enctype="multipart/form-data">
				<div class="form-group col-sm-4">
					<label>Nombre:</label>
					<input type="text" name="nombre" class="form-control" value="<?= $font['nombre'] ?>">
				</div>
				<div class="form-group col-sm-4">
					<label>Empresa:</label>
					<input type="text" name="empresa" class="form-control" value="<?= $font['empresa'] ?>">
				</div>
				<!-- Para la fuente de televisión -->
				<?php if ($fontType == FontType::FONT_TELEVISION['key']): ?>
					<div class="form-group col-sm-4">
						<label>Conductor:</label>
						<input type="text" name="conductor" class="form-control" value="<?= $font['conductor'] ?>">
					</div>
					<div class="form-group col-sm-4">
						<label>Canal:</label>
						<input type="text" name="canal" class="form-control" value="<?= $font['canal'] ?>">
					</div>
					<div class="form-group col-sm-4">
					    <label>Horario: Desde</label>
					    <div class='input-group date relojd' >
					        <input class="form-control" placeholder="Desde:" name="desde" value="<?= $font['desde'] ?>" >
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-time"></span>
					        </span>
					    </div>
					</div>
					<div class="form-group col-sm-4">
					    <label>Hasta</label>
					    <div class='input-group date relojd' >
					        <input class="form-control" placeholder="Hasta:" name="hasta" value="<?= $font['hasta'] ?>" >
					        <span class="input-group-addon">
					            <span class="glyphicon glyphicon-time"></span>
					        </span>
					    </div>
					</div>
					<div class="form-group col-sm-4">
					    <label>Señal</label>
					     <select class="form-control" name="senal">
					        <option value="">Señal</option>
					        <?php foreach ($signs as $signal): ?>
					        	<option value="<?= $signal['id_senal'] ?>" <?= ($signal['id_senal'] == $font['id_senal']) ? 'selected' : '' ?> ><?= $signal['descripcion'] ?></option>
					        <?php endforeach ?>
					    </select>
					</div>
				<?php endif ?>
				<?php if ($fontType == FontType::FONT_RADIO['key']): ?>
					<div class="form-group col-sm-4">
						<label>Conductor:</label>
						<input type="text" name="conductor" class="form-control" value="<?= $font['conductor'] ?>">
					</div>
					<div class="form-group col-sm-4">
						<label>Estacion:</label>
						<input type="text" name="estacion" class="form-control" value="<?= $font['estacion'] ?>">
					</div>
					<div class="form-group col-sm-4">
						<label>Horario:</label>
						<input type="text" name="horario" class="form-control" value="<?= $font['horario'] ?>">
					</div>
				<?php endif ?>
				<?php if ($fontType == FontType::FONT_REVISTA['key'] || $fontType == FontType::FONT_PERIODICO['key']): ?>
					<div class="form-group col-sm-4">
						<label>Tiraje:</label>
						<input type="text" name="tiraje" class="form-control" value="<?= $font['tiraje'] ?>">
					</div>					
				<?php endif ?>
				<?php if ($fontType == FontType::FONT_INTERNET['key']): ?>
					<div class="form-group col-sm-4">
						<label>Url:</label>
						<input type="url" name="url" class="form-control" value="<?= $font['url'] ?>">
					</div>					
				<?php endif ?>
				<div class="form-group col-sm-4">
				    <label>Cobertura</label>
				     <select class="form-control" name="cobertura">
				        <option value="">Cobertura</option>
				        <?php foreach ($coverage as $co): ?>
				        	<option value="<?= $co['id_cobertura'] ?>" <?= ($co['id_cobertura'] == $font['id_cobertura']) ? 'selected' : '' ?> ><?= $co['descripcion'] ?></option>
				        <?php endforeach ?>
				    </select>
				</div>
				<div class="form-group col-sm-12">
		        	<img src="/<?= $font['logo']?>" width="220" />			            
		          	<input type="file" name="logo" id="input-imagen" class="inp-thum" style="display: none;">
		          	<a href="javascript:void(0);" id="btn-changeImage" class="btn btn-default" ><i class="fa fa-pencil-square-o"> Cambiar</i></a>
		          	<span class="help-block">Logo de la fuente</span>
		        </div>
				<div class="checkbox col-sm-12">
                    <label>
                        <input type="checkbox" name="activo" <?= ($font['is_active'] != 0) ? 'checked' : '' ?> />Activo
                    </label>                                    
                </div>
				<div class="form-group col-sm-12">
                    <label>Comentarios:</label>
                    <textarea class="form-control" name="comentario" rows="3"><?= $font['comentario'] ?></textarea>
                </div>
				<div class="col-sm-12">
                	<input type="submit" value="Actualizar" class="btn btn-primary pull-right" />
				</div>	
			</form>
		</div>		
	</div>
</div>
<!-- Formulario para agregar una seccion -->
<div class="row">
	<div class="col-sm-12 form-agregar-seccion" style="display: none">
		<div class="col-sm-3 plus-secction"></div>
		<form action="/panel/font/section/add" method="post" class="form-horizontal col-sm-6" id="form-agrega-seccion">
			<input type="hidden" value="<?= $fontId ?>" name="fuenteId">
			<div class="form-group">
				<label class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
					<input 
						class="form-control" 
						name="nombre"  
						autocomplete="off" 
						placeholder="Ejem.: Entretenimiento" 
						required="required" 
						data-rule-required="true" 
						data-msg="Introduce el nombre de la sección" />	
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Autor</label>
				<div class="col-sm-8">
					<input 
						class="form-control" 
						name="autor"  
						autocomplete="off" 
						placeholder="Ejem.: Eduardo Vega" 
						required="required" 
						data-rule-required="true" 
						data-msg="Introduce el nombre del autor de la sección" />	
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-8">
					<textarea class="form-control" name="decripcion" rows="6" required></textarea>					
				</div>
			</div>
			<button class="btn btn-primary pull-right">Crear</button>
			<button class="btn btn-warning pull-right cancelar" type="button" style="margin: 0 10px 0 0;">Cancelar</button>
		</form>
		<div class="col-sm-3 plus-secction"></div>
	</div>
</div>
<!-- /Formulario para agregar una seccion -->
<!-- Secciones -->
<div class="row">
	<div class="col-sm-12">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            Secciones
	            <div class="pull-right">
	                <div class="btn-group">
	                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	                        Acciones
	                        <span class="caret"></span>
	                    </button>
	                    <ul class="dropdown-menu pull-right" role="menu">
	                        <li>
	                        	<a href="javascript:void(0);" id="agregarSeccionAction">
	                        		Agregar Seccion
	                        	</a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	        <div class="panel-body">
	            <?php if( is_array( $sections ) ): ?>
	            <div class="table-responsive">
	                <table class="table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Nombre</th>
	                            <th>Autor</th>
	                            <th>Descripción</th>
	                            <th>Activa</th>
	                            <th>Acción</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php foreach( $sections as $key => $section ): ?>
	                        <tr>
	                            <td><?= $key + 1 ?></td>
	                            <td><?= $section['nombre'] ?></td>
	                            <td><?= $section['autor'] ?></td>
	                            <td><?= $section['descripcion'] ?></td>
	                            <td class="fa <?= $section['activo']['class'] ?>">
	                            </td>
	                            <td>
	                            	<?php if ( $section['activo']['activo'] ): ?>
	                            		<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-href="/panel/font/section/change-state?section=<?= $section['id_seccion'] ?>&action=desactivado" class="change-state">Desactivar</a>
	                            	<?php else: ?>
										<a href="javascript:void(0);" data-toggle="modal" data-target="#myModal" data-href="/panel/font/section/change-state?section=<?= $section['id_seccion'] ?>&action=activado" class="change-state">Activar</a>
									<?php endif; ?>	                            	
	                            </td>
	                        </tr>
	                    <?php endforeach; ?>
	                    </tbody>
	                </table>
	            </div>
	        	<?php else: ?>
	        	<p class="lead"><?= $sections ?></p>
	        	<?php endif; ?>
	            <!-- /.table-responsive -->
	        </div>
	        <!-- /.panel-body -->
	    </div>
	</div>
</div>
<!-- /Secciones -->
