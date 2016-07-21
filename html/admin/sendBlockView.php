<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Enviar bloque de noticias</h1>
    </div><!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="panel panel-default">
		<form class="" id="bootpag_text_count">
			<div class="panel-body">
				<div class="form-group col-lg-3">
					<label>Por Titulo</label>
					<input id="bootpag_text_titulo" type="text" name="titulo" class="form-control">
				</div>
				<div class="form-group col-lg-3">
	                <label>Entre</label>
	                <div class="input-group">
	                    <input id="bootpag_text_finicio" type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="finicio" >
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                </div>
	            </div>
	            <div class="form-group col-lg-3">
	                <label>Y</label>
	                <div class="input-group">
	                    <input id="bootpag_text_ffin" type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="ffin" >
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                </div>
	            </div>
	            <div class="form-group col-lg-3">
	                <label>Tipo de Fuente</label>
	                <select class="form-control" name="tipoFuente" id="bootpag_text_fuente_selected" required >
	                    <option value="">Seleccione un tipo de fuente</option>
	                    <option value="0">***Todas***</option>
	                    <?= $typeFont ?>
	                </select>
	            </div>
			</div>
			<div class="form-inline">
				<div class="col-sm-12" id="bootpag_nummc">
					<label for="exampleInputName2">Mostrar &nbsp;</label>
					<input type="hidden" value="1" name="page" id="current_page">
					<select name="numpp" id="bootpag_text_count_select" class="form-control input-sm">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select>
					<label for="exampleInputName2">&nbsp; Registros</label>
				</div>					
			</div>	
	    </form>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 table-busqueda">
		<form method="post" action="/panel/news/send-block" id="form-send-block-action" >
			<div class="table-responsive">
		        <table class="table table-bordered table-inverse nomargin">
			        <thead>
				    	<tr>
				        	<th class="text-center"></th>
				        	<th class="text-center">TipoFuente</th>
				        	<th class="text-center">Noticia</th>
				            <th class="text-center">Fuente</th>
				            <th class="text-center">Enviado a</th>
				        </tr>
			        </thead>
		          	<tbody>
						<?= $html ?>
		          	</tbody>
		        </table>
		        <div class="col-md-6">
		        	<p id="bootpag_text">
		        		Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
		        	</p>
		        </div>
		        <div class="col-md-6"><p id="bootpag_pag" data-count="<?= $count ?>"></p></div>	
	      	</div>
	    	<input type="submit" value="Enviar noticias" class="btn btn-primary btn-lg col-lg-3 col-md-offset-8">
		</form>
	</div>
</div>