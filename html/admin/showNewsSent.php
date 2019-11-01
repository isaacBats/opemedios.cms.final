<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Asignación - Noticias a clientes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<form method="post" action="" id="form-nbc">
		<div class="form-group col-sm-8 col-sm-offset-2">
			<label for="empresa">Buscar cliente</label>
			<select id="cliente_empresa" class="select2 form-control" name="empresa" required >
				<option value="">Clientes</option>
				<?php foreach ($empresas->rows as $cliente): ?>
				<option value="<?= $cliente['id_empresa'] ?>"><?= $cliente['nombre'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group col-sm-4 col-sm-offset-2">
			<label>De:</label>
			<input name="fecha_inicio" id="startDate" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" />
		</div>
		<div class="form-group col-sm-4">
			<label>A:</label>
			<input name="fecha_fin" id="endDate" class="fechaNota form-control" value="<?= date('Y-m-d') ?>" />
		</div>
		<div class="form-group smt-marg col-sm-8 col-sm-offset-8">
			<input id="searchNewsToClient" type="button" value="Buscar" class="btn btn-primary">
		</div>
	</form>
</div>
<!-- My handlebars template -->
<script id="row-template" type="text/x-handlebars-template">
	{{#each noticias}}
		<div class="panel panel-default">
			<div class="panel-heading">{{@key}}</div>
			<div class="panel-body">
				<table class="table table-striped table-bordered" id="tbl-{{@index}}">
				<thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Noticia</th>
                        <th>Fuente</th>
                        <th>Tema</th>
                        <th>Tendencia</th>
                    <th class="tabledit-toolbar-column"></th></tr>
                </thead>
                <tbody>
				{{#each this.news}}
						<tr>
		                    <td>
		                    	<span>{{this.id_noticia}}</span>
		                	</td>
		                    <td>
		                    	<span>{{this.fecha}}</span>
		                    </td>
		                    <td>
		                    	<span>{{this.encabezado}}</span>
		                    </td>
		                    <td>
		                    	<span>{{this.id_fuente}}</span>
		                    </td>
		                    <td>
		                    	<span>{{this.tema}}</span>
		                    </td>
		                    <td>
		                    	<span>{{this.id_tendencia_monitorista}}</span>
		                    </td>
		                </tr>
				{{else}}
						<span>No hay noticias de este tema</span>
				{{/each}}
				</tbody>
				</table>
			</div>
		</div>
	{{/each}}
</script>
<div class="row">
	<div class="col-lg-12">
		<!--<h4>Se muestran a continuación las noticias asignadas al portal de: 
			<span id="customer_qry"></span>
		</h4>-->
	</div>
	<div class="col-lg-12">
		<div class="table-responsive" id="response-area"></div>
	</div>
</div>