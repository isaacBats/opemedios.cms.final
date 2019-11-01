<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                 <li class="breadcrumb-item active" aria-current="page"><?=$customer['nameCustomer'];?></li>
              </ol>
            </nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" id="edit_company"><i class="far fa-save"></i> Guardar Cambios</button>
				</div>
				<div class="card-body">
					<div class="alert alert-success hidden" role="alert" id="alert">Compañía Actualizada</div>
					<form id="form_edit_company">
						<input type="text" class="hidden" name="id" value="<?=$customer['idCustomer']?>">
						<div class="form-group">
							<label for="nameCustomer">Nombre</label>
							<input type="text" class="form-control" id="nameCustomer"  name="data1" value="<?=$customer['nameCustomer']?>">
						</div>
						<div class="form-group">
							<label for="emailFrom">FROM</label>
							<input type="text" class="form-control" id="emailFrom"  name="data2" value="<?=$customer['emailFrom']?>">
							<small id="emailHelp" class="form-text text-muted">Una sola cuenta de correo.</small>
						</div>
						<div class="form-group">
							<label for="emailTo">TO</label>
							<input type="text" class="form-control" id="emailTo"  name="data3" value="<?=$customer['emailTo']?>">
							<small id="emailHelp" class="form-text text-muted">Una sola cuenta de correo.</small>
						</div>
						<div class="form-group">
							<label for="emailBcc">BCC</label>
							<div class="alert alert-warning" role="alert">
							 <small>Multiples correos separados por coma y sin espacios <strong>ejemplo@mail.com,ejemplo@mail.com</strong></small>
							</div>
							<div class="alert alert-danger hidden" role="alert" id="error_mails">Error de Sintaxis</div>
							<textarea class="form-control" id="emailBcc" rows="20" name="dataMails"><?=$customer['emailBcc']?></textarea>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>