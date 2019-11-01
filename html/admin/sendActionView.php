<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $title ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="panel-body">
	    <?= $sintesis ?>
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
			<?php if( $noticiaid != 'block' ){ ?>
		<form method="post" action="/panel/new/send" id="form-send-action" >
				<input type="hidden" name="noticiaid" value="<?= $new['id'] ?>">
			<?php }else{ ?>
		<form method="post" action="/panel/news/send-news-block" id="form-send-action" >
			<?php }?>

			<input type="hidden" name="empresaid" value="<?= $empresaid ?>">			
			<div class="table-responsive">
				<div class="checkbox">
		            <label>
		                <input type="checkbox" class="checkbox-todos">Seleccionar todos
		            </label>
		        </div>
		        <table class="table table-bordered table-inverse nomargin checkbox-active">
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
	      	<div class="form-inline">
	      		<div class="form-group">
	      			<a href="/panel/new/preview/<?=$noticiaid?>/<?=$company['id_empresa']?>" target="_blank" class="btn btn-info btn-lg">Vista previa</a>
				  </div>
				  <div class="form-group">
				    <input type="submit" value="Enviar noticia" class="btn btn-primary btn-lg">
				  </div>
	      	</div>
	      	<br><br>
		</form>
	</div>
	<br>
</div>