<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Selecciona cliente para envio de bloque de noticias</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="panel-body">
	    <h3>Se enviaran las siguientes noticias</h3>
	    <div class="table-responsive">
	        <table class="table table-bordered table-inverse nomargin">
		        <thead>
		            <tr>
		              	<th class="text-center">Noticia</th>
		              	<th class="text-center">Tipo de Fuente</th>
		            </tr>
		        </thead>
	          	<tbody>
					<?php foreach ($noticias as $key => $noticia) { ?>
						<tr>
			            	<td><?= $noticia['encabezado'] ?></td>
			              	<td><?= $noticia['tipofuente'] ?></td>
			           	</tr>
					<?php } ?>
	          	</tbody>
	        </table>
      </div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>Buscar Cliente: </label>
			<input type="text" class="form-control filtro-clientes" placeholder="Ingresa nombre de cliente">
		</div>
	</div>
	<div class="col-lg-8 table-clientes">
		<div class="table-responsive">
	        <table class="table table-bordered table-inverse nomargin resultados clientes">
		          <thead>
			            <tr>
			              <th class="text-center">Cliente</th>
			              <th class="text-center">Acciones</th>
			            </tr>
		          </thead>
	          <tbody>

	          </tbody>
	        </table>
      </div>
	</div>
</div>