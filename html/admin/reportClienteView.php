<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Reporte de noticias por cliente</h1>
	</div>
</div>
<div class="row">
	<form method="post" action="" id="formBusquedaAvanzada">
		<div class="form-group col-sm-8 col-sm-offset-2">
			<label for="empresa">Selecciona un cliente <span class="badge badge-danger" style="background-color:red">* campo obligatorio</span></label>
			<select class="select2 form-control" name="empresa" id="empresa" required >
				<option value="">Clientes</option>
				<?php foreach ($empresas->rows as $cliente): ?>
				<option value="<?= $cliente['id_empresa'] ?>"><?= $cliente['nombre'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
			<label>Fecha inicio</label>
			<input name="fecha_inicio" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" readonly/>
		</div>
		<div class="form-group col-sm-4">
			<label>Fecha final</label>
			<input name="fecha_fin" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" readonly/>
		</div>
		<div class="form-group col-sm-8 col-sm-offset-2">
		    <label for="tema">Tema</label>
		     <select class="select2 form-control" name="tema[]" id="tema" disabled="disabled" required multiple >
		        <option value="0">Todos los temas</option>
		    </select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
		    <label for="genero">Genero</label>
		     <select class="form-control" name="genero" required >
           <option value="0" selected>Todos los Géneros</option>
           <?php foreach ($generos as $genero): ?>
					 <option value="<?= $genero['id_genero'] ?>"><?= $genero['descripcion'] ?></option>
					 <?php endforeach; ?>
        </select>
		</div>
		<div class="form-group col-sm-4">
		    <label for="tipo_autor">Tipo de autor</label>
		     <select class="form-control" name="tipo_autor" required >
                 <option value="0" selected>Todos los tipos de Autor</option>
                 <?php foreach ($tiposAutor as $autor): ?>
				<option value="<?= $autor['id_tipo_autor'] ?>"><?= $autor['descripcion'] ?></option>
				<?php endforeach; ?>
             </select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
		    <label for="tendencia">Tendencia</label>
		     <select class="form-control" name="tendencia" required >
                 <option value="0" selected>Todas las tendencias</option>
                 <option value="1" >Positiva</option>
                 <option value="2" >Neutral</option>
                 <option value="3" >Negativa</option>
             </select>
		</div>
		<div class="form-group col-sm-4">
		    <label for="tipo_fuente">Tipo de fuente</label>
		     <select class="form-control" name="tipo_fuente" id="tipo_fuente" required >
                 <option value="0" selected>Todos los tipos</option>
                 <?php foreach ($tiposFuente as $tf): ?>
                 <option value="<?= $tf['id_tipo_fuente'] ?>"><?= $tf['descripcion'] ?></option>
                 <?php endforeach; ?>
             </select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
		    <label for="fuente">Fuente</label>
		     <select class="select2 form-control" name="fuente" id="fuente" disabled="disabled" >
		        <option value="">Fuente</option>
		    </select>
		</div>
		<div class="form-group col-sm-4">
		    <label for="seccion">Sección</label>
		     <select class="select2 form-control" name="seccion" id="seccion" disabled="disabled" >
		        <option value="">Sección</option>
		    </select>
		</div>
		<div class="form-group smt-marg col-sm-8 col-sm-offset-2">
			<input type="button" value="Generar reporte EXCEL" id="btnCreateReportXLS" name="btn-admin-xls" class="btn btn-success">
			<input type="button" value="Generar reporte PDF" id="btnCreateReportPDF" name="btn-admin-pdf" class="btn btn-danger">
		</div>
	</form>
</div>
