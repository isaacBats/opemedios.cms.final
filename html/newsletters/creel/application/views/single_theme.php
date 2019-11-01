<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/titles');?>">Títulos</a></li>
                 <li class="breadcrumb-item active" aria-current="page"><?=$theme['nameCategory'];?></li>
              </ol>
            </nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" id="edit_theme"><i class="far fa-save"></i> Guardar Cambios</button>
				</div>
				<div class="card-body">
					<div class="alert alert-success hidden" role="alert" id="alert">Compañía Actualizada</div>
					<form id="form_edit_theme">
						<input type="text" class="hidden" name="id" value="<?=$theme['idCategory']?>">
						<div class="form-group">
							<label for="nameCustomer">Título</label>
							<input type="text" class="form-control" id="nameCustomer"  name="theme" value="<?=$theme['nameCategory'];?>">
						</div>
					<div class="alert alert-success hidden" role="alert" id="alert1">Título Editado Correctamente</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>