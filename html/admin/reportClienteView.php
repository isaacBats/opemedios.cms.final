<div class="row">
	<div class="col-sm-12">
		<h1 class="page-header">Reporte de noticias por cliente</h1>
	</div>
</div>
<div class="row">
	<form method="post" action="">
		<div class="form-group col-sm-8 col-sm-offset-2">
			<label for="empresa">Selecciona un cliente</label>
			<select class="select2 form-control" name="empresa" id="empresa" required >
				<option value="">Clientes</option>
				<?php foreach ($empresas->rows as $cliente): ?>
				<option value="<?= $cliente['id_empresa'] ?>"><?= $cliente['nombre'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
			<label>Fecha inicio</label>
			<input name="fecha_inicio" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" />			
		</div>
		<div class="form-group col-sm-4">
			<label>Fecha final</label>
			<input name="fecha_fin" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" />			
		</div>
		<div class="form-group col-sm-8 col-sm-offset-2">
		    <label for="tema">Tema</label>
		     <select class="select2 form-control" name="tema[]" id="tema" disabled="disabled" required multiple="multiple">
		        <option value="0">Todos los temas</option>
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
		<div class="form-group smt-marg col-sm-8 col-sm-offset-8">
			<input type="submit" value="Generar reporte" class="btn btn-primary">			
		</div>
	</form>
</div>