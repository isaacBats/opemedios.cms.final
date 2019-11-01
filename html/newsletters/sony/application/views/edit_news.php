<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/news/').$news["newsletter"];?>">Newsletter <?=$news["newsletter"];?></a></li>
                <li class="breadcrumb-item active" aria-current="page"> Editar Noticia</li>
              </ol>
            </nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" id="edit_news" data-id="<?=$news['id']?>"><i class="far fa-save"></i> Guardar Cambios</button>
				</div>
				<div class="card-body">
					<div class="alert alert-success hidden" role="alert" id="alert">Noticia Actualizada</div>
					<form id="form_edit_news">
						<div class="form-group">
							<label for="categoria">TÍTULO</label>
							<select class="form-control" id="categoria" name="data1">
								<?php
								foreach ($category as $cat) {
									if ($cat['idCategory'] == $news['idCategory']) {
										$select = 'selected';
									}
									else {
										$select = NULL;
									}
									echo ' <option value="'.$cat['idCategory'].'" '.$select.'>'.$cat['nameCategory'].'</option>'; 
								} ?>
							</select>
						</div>
						<div class="form-group">
							<label for="type">CATEGORÍA</label>
							<select class="form-control" id="type" name="data6">
								<?php
								$array = array(
								    "Prensa" => "1",
								    "Sitios Web" => "2",
								    "Redes Sociales" => "3",
								    "Radio" => "4",
								    "Televisión" => "5",
								);

								foreach ($array as $key => $aa) {
									if ($news['type'] == $aa) {
										$select = 'selected';
									}
									else {
										$select = NULL;
									}
									echo ' <option value="'.$aa.'" '.$select.'>'.$key.'</option>'; 
								} ?>
							</select>
						</div>
						<input type="text" class="hidden" name="id" value="<?=$news['id']?>">
							<div class="form-group">
								<label for="link">LINK</label>
								<input type="text" class="form-control" id="link"  name="data2" value="<?=$news['link']?>">
							</div>
							<div class="form-group">
								<label for="encabezado">ENCABEZADO</label>
								<input type="text" class="form-control" id="encabezado"  name="data3" value="<?=$news['title']?>">
							</div>
							<div class="form-group">
								<label for="texto">TEXTO</label>
								<textarea class="form-control" id="texto" rows="4" name="data4" ><?=$news['text']?></textarea>
							</div>
							<div class="form-group">
								<label for="fuente">FUENTE</label>
								<input type="text" class="form-control" id="fuente"  name="data5" value="<?=$news['source']?>">
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>