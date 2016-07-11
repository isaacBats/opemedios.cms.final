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
		<form role="form">
			<div class="form-group">
				<label>Buscar Cliente: </label>
				<input type="text" class="form-control" name="buscar" placeholder="Ingresa nombre de cliente">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" name="buscar" placeholder="Ingresa nombre de cliente">
			</div>

		</form>
	</div>
</div>