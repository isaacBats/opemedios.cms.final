<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $new['encabezado'] ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="panel-body">
	    <p><?= $new['sintesis'] ?></p>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="form-group">
			<label>Buscar Cliente: </label>
			<input type="text" data-noticiaid="<?= $new['id'] ?>" class="form-control filtro-clientes" placeholder="Ingresa nombre de cliente">
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