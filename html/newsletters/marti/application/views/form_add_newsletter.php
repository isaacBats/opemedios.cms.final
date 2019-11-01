<div class="modal fade" id="new_newsletter" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Agregar Newsletter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_add_newsletter">
					<div class="form-group">
						<label for="empresa" name="company">Seleccionar Empresa</label>
						<select class="form-control" id="empresa" name="company">
							<?php foreach ($customer as $cu) {
								echo '<option value="'.$cu['idCustomer'].'">'.$cu['nameCustomer'].'</option>'; }
							?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col">
								<label for="day">Día</label>
								<select id="day" class="form-control" name="day">
									<?php for( $i = 1 ; $i <= 31 ; $i++ ) {
										echo '<option value="' . $i . '" >' . $i . '</option>';
									} ?>
								</select>
							</div>
							<div class="col">
								<label for="month">Mes</label>
								<select id="month" class="form-control" name="month">
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="4">Abril</option>
									<option value="5">Mayo</option>
									<option value="6">Junio</option>
									<option value="7">Julio</option>
									<option value="8">Agosto</option>
									<option value="9">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Nomviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
							<div class="col">
								<label for="year">Año</label>
								<select id="year" class="form-control" name="year">
									<option selected><?=date('Y');?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="horary">Horario</label>
						<select id="horary" class="form-control" name="horary">
							<option value="Matutino">Matutino</option>
							<option value="Vespertino">Vespertino</option>
						</select>
					</div>
					<div class="form-group">
						<label for="primeras_planas">LINK PRIMERAS PLANAS</label>
						<input type="text" class="form-control" id="primeras_planas"  name="link1" placeholder="Link">
					</div>
					<div class="form-group">
						<label for="portadas_negocios">PORTADAS NEGOCIOS</label>
						<input type="text" class="form-control" id="portadas_negocios"  name="link2" placeholder="Link">
					</div>
					<div class="form-group">
						<label for="cartones">CARTONES</label>
						<input type="text" class="form-control" id="cartones"  name="link3" placeholder="Link">
					</div>
					<div class="form-group">
						<label for="columnas_negocios"> COLUMNAS NEGOCIOS</label>
						<input type="text" class="form-control" id="columnas_negocios"  name="link4" placeholder="Link">
					</div>
					<div class="form-group">
						<label for="columnas_politicas">COLUMNAS POLÍTICAS</label>
						<input type="text" class="form-control" id="columnas_politicas"  name="link5" placeholder="Link">
					</div>
					<div class="form-group">
						<label for="candidatos_presidenciales">PORTADAS DEPORTIVAS</label>
						<input type="text" class="form-control" id="candidatos_presidenciales"  name="link6" placeholder="Link">
					</div>
				</form>
				<div class="alert alert-success hidden" role="alert" id="alert1">Newsletter Agregado Correctamente</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="add_newsletter">Agregar</button>
				</div>
			</div>
		</div>
	</div>