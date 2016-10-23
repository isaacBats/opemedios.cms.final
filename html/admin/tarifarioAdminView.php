<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Administrador de tarifarios</h1>
	</div>
</div>
<div class="row"> <!-- Importar tarifario -->
	<div class="panel panel-default">
		<form>
			<fieldset>
				<div class="form-group col-md-4">
					<label for="nombre">Nombre: </label>
					<input  name="nombre" class="form-control" placeholder="Tarifario - El universal" />
					<span class="help-block">El nombre debe de tener relacion con la fuente ejemplo: Tarifario - El Universal.</span>
				</div>
				<div class="form-group col-md-4">
					<label for="columnas">Columnas: </label>
					<input  name="columnas" class="form-control" placeholder="seccion, par, impar, ..." />
					<span class="help-block">Las columnas deben ir en minusculas separadas por una ","</span>
				</div>
				<div class="form-group col-md-4">
					<label for="columnas">Archivo: </label>
					<input  type="file" name="file" />
					<span class="help-block">El archivo solo debe de contener las columnas que ingreso. El nombre del archivo debe de ser la fuente</span>
				</div>
				<div class="form-group col-md-2 pull-right">
					<input type="submit" value="Crear" class="btn btn-primary" />					
				</div>
			</fieldset>
		</form>
	</div>	
</div> <!-- /Importar tarifario -->
<div class="row"> <!-- Lista de tarifarios -->
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
                <i class="fa fa-files-o fa-fw"></i> Tarifarios
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Acciones
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                            	<a href="javascript:void(0);">
                            		Importar Tarifario
                            	</a>
                            </li>
                            <li>
                            	<a href="javascript:void(0);">
                            		Importar Tarifario
                            	</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0);">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                
            </div>
		</div>
	</div>
</div> <!-- /Lista de tarifarios -->