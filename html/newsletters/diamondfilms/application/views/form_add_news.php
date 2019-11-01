    
<div class="modal fade" id="new_news" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Agregar Noticia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body bg-yellow">
				<form id="get_news">
					<div class="input-group">
					  <div class="custom-file">
					    <input type="text" class="form-control" id="linkNews"  name="link" placeholder="Link Noticia">
					  </div>
					  <div class="input-group-append">
					    <button class="btn btn-primary" id="getNews" type="button" data-url="<?=base_url()?>"><i class="fas fa-search"></i></button>
					  </div>
					</div>
				</form>
			</div>
			<div class="modal-body">
				<form id="form_add_news">
					<input type="text" class="form-control hidden" name="data0" value="<?=$newsletter['id'];?>">
					<div class="form-group">
						<label for="categoria">TÍTULO</label>
						<select class="form-control" id="categoria" name="data1">
							<?php foreach ($category as $cat) { echo ' <option value="'.$cat['idCategory'].'">'.$cat['nameCategory'].'</option>'; } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="type">CATEGORÍA</label>
						<select class="form-control" id="type" name="data6">
							<option value="1">Prensa</option>
							<option value="2">Sitios Web</option>
							<option value="3">Redes Sociales</option>
							<option value="4">Radio</option>
							<option value="5">Televisión</option>
						</select>
					</div>
					<div class="form-group">
						<label for="link">LINK</label>
						<input type="text" class="form-control" id="link"  name="data2">
						</div>
					<div class="form-group">
						<label for="encabezado">ENCABEZADO</label>
						<input type="text" class="form-control" id="encabezado"  name="data3">
					</div>
					<div class="form-group">
						<label for="texto">TEXTO</label>
						<textarea class="form-control" id="texto" rows="4" name="data4"></textarea>
					</div>
					<div class="form-group">
						<label for="fuente">FUENTE</label>
						<input type="text" class="form-control" id="fuente"  name="data5">
					</div>
				</form>
				<div class="alert alert-success hidden" role="alert" id="alert1">Noticia Agrega Correctamente</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="add_news">Agregar</button>
			</div>
		</div>
	</div>
</div>