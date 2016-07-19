<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Enviar bloque de noticias</h1>
    </div><!-- /.col-lg-12 -->
</div>

<div class="row">
	<div class="panel panel-default">
		<div class="panel-body">
			<form>
				<div class="form-group col-lg-3">
					<label>Por Titulo</label>
					<input type="text" name="titulo" class="form-control">
				</div>
				<div class="form-group col-lg-3">
	                <label>Entre</label>
	                <div class="input-group">
	                    <input type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="fechaInicio" >
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                </div>
	            </div>
	            <div class="form-group col-lg-3">
	                <label>Y</label>
	                <div class="input-group">
	                    <input type="text" class="form-control fechaNota" placeholder="yyyy-mm-dd" name="fechaFin" >
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                </div>
	            </div>
	            <div class="form-group col-lg-3">
	                <label>Tipo de Fuente</label>
	                <select class="form-control" name="tipoFuente" id="" required >
	                    <option value="">Seleccione un tipo de fuente</option>
	                    <?= $typeFont ?>
	                </select>
	            </div>
	        </form>
		</div>	
	</div>
</div>
<div class="row">
	<div class="col-lg-8 table-busqueda">
		<form method="post" action="/panel/new/send-block" id="form-send-block-action" >
			<div class="table-responsive">
		        <table class="table table-bordered table-inverse nomargin">
			        <thead>
				    	<tr>
				        	<th class="text-center"></th>
				        	<th class="text-center">Noticia</th>
				            <th class="text-center">Sintesis</th>
				            <th class="text-center">Fuente</th>
				            <th class="text-center">Enviado a</th>
				        </tr>
			        </thead>
		          	<tbody>
						<?php //$html ?>
		          	</tbody>
		        </table>
	      	</div>
	    	<input type="submit" value="Enviar noticias" class="btn btn-primary btn-lg col-lg-3 col-md-offset-8">
		</form>
	</div>
</div>