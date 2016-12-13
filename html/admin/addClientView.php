<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Nuevo Cliente</h1>
	</div>
	<form action="/panel/company/add" method="post" class="form-horizontal col-sm-12" id="form-agrega-cliente" enctype="multipart/form-data" >
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="form-group">
				<label class="col-sm-2 control-label">Nombre de la empresa*</label>
				<div class="col-sm-8">
					<input placeholder="Opemedios" class="form-control" name=":nombre" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Teléfono*</label>
				<div class="col-sm-8">
					<input type="tel" placeholder="5545768789" maxlength="12" minlength="8" class="form-control col-sm-8" name=":telefono" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Contacto*</label>
				<div class="col-sm-8">
					<input placeholder="Nombre del contacto" class="form-control col-sm-8" name=":contacto" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Correo*</label>
				<div class="col-sm-8">
					<input type="email" placeholder="juan@opemedios.com.mx" class="form-control col-sm-8" name=":email" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Giro</label>
				<div class="col-sm-8">
					<input placeholder="Monitoreo de medios" class="form-control col-sm-8" name=":giro" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" name=":direccion" rows="6" ></textarea>					
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Logo*</label>
				<div class="col-sm-8">
		            <div class="input-group">
		                <label class="input-group-btn">
		                    <span class="btn btn-primary">
		                        Buscar <input name=":logo" type="file" style="display: none;" required="required"/>
		                    </span>
		                </label>
		                <input type="text" class="form-control" readonly>
		            </div>
		            <span class="help-block">
		                Selecciona la imagen que desees que quede en representación del cliente
		            </span>
		        </div>				
			</div>
			<input type="submit" value="Guardar" class="btn btn-success btn-lg pull-right" />
		</div>
		<div class="col-sm-2"></div>
	</form>			
</div>