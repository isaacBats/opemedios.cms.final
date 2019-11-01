<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Newsletter <?=$newsletter['id'];?></li>
              </ol>
            </nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" id="edit_newsletter" data-id="<?=$newsletter['id'];?>"><i class="far fa-save"></i> Guardar Cambios</button>
				</div>
				<div class="card-body">
					<div class="alert alert-success hidden" role="alert" id="alert">Newsletter Actualizado</div>
					<form id="form_edit_newsletter">
						<input type="text" class="hidden" name="id" value="<?=$newsletter['id']?>">
						<div class="form-group">
							<label for="primeras_planas">LINK PRIMERAS PLANAS</label>
							<input type="text" class="form-control" id="primeras_planas"  name="link1" value="<?=$newsletter['link1']?>">
						</div>
						<div class="form-group">
							<label for="portadas_negocios">PORTADAS NEGOCIOS</label>
							<input type="text" class="form-control" id="portadas_negocios"  name="link2" value="<?=$newsletter['link2']?>">
						</div>
						<div class="form-group">
							<label for="cartones">CARTONES</label>
							<input type="text" class="form-control" id="cartones"  name="link3" value="<?=$newsletter['link3']?>">
						</div>
						<div class="form-group">
							<label for="columnas_negocios"> COLUMNAS NEGOCIOS</label>
							<input type="text" class="form-control" id="columnas_negocios"  name="link4" value="<?=$newsletter['link4']?>">
						</div>
						<div class="form-group">
							<label for="columnas_politicas">COLUMNAS POLÍTICAS</label>
							<input type="text" class="form-control" id="columnas_politicas"  name="link5" value="<?=$newsletter['link5']?>">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>