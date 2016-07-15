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
<div class="panel panel-default">
	<div class="panel-body">
		<p>La noticia aparecerá en el portal del siguiente cliente: <strong><?= $company['nombre'] ?></strong></p>
		<p>Contacto: <strong><?= $company['contacto'] ?></strong> (<?= $company['email'] ?>)</p>
		<p>Giro: <?= $company['giro'] ?></p>
		
	</div>	
</div>
<div class="row">
	<div class="col-lg-8 table-contactos">
		<form method="post" action="/panel/new/send" id="form-send-action" >
			<input type="hidden" name="noticiaid" value="<?= $new['id'] ?>">
			<input type="hidden" name="empresaid" value="<?= $empresaid ?>">			
			<div class="table-responsive">
		        <table class="table table-bordered table-inverse nomargin">
			        <thead>
				    	<tr>
				        	<th class="text-center">Enviar</th>
				            <th class="text-center">Cuenta</th>
				            <th class="text-center">Email</th>
				        </tr>
			        </thead>
		          	<tbody>
						<?= $html ?>
		          	</tbody>
		        </table>
	      	</div>
	    	<input type="submit" value="Enviar noticia" class="btn btn-primary btn-lg col-lg-3 col-md-offset-8">
		</form>
	</div>
</div>