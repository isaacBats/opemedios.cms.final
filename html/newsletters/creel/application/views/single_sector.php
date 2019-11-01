<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/sectores');?>">Sectores</a></li>
				<li class="breadcrumb-item"><a href="<?=base_url('index.php/sectores');?>"><?=$sector['name']?></a></li>
              </ol>
            </nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" id="edit_sector"><i class="far fa-save"></i> Guardar Cambios</button>
				</div>
				<div class="card-body">
					<div class="alert alert-success hidden" role="alert" id="alert">Sector Actualizado</div>
					<form id="form_edit_sector">
						<input type="text" class="hidden" name="id" value="<?=$sector['id']?>">
						<div class="form-group">
							<label for="nameCustomer">Sector</label>
							<input type="text" class="form-control" id="nameCustomer"  name="sector" value="<?=$sector['name'];?>">
						</div>
					<div class="alert alert-success hidden" role="alert" id="alert1">Sector Editado Correctamente</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>