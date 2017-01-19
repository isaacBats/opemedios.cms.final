<div class="row">
	<div class="col-sm-10">
		<h1 class="page-header">Agregar archivos</h1>
	</div>	
</div>
<div class="row">
	<form method="post" class="form-horizontal col-sm-12" id="form-agrega-adjunto" enctype="multipart/form-data" >
		<input type="hidden" value="<?= $id ?>" name="noticiaId">
		<div class="form-group">
			<label class="col-sm-2 control-label">Archivos</label>
			<div class="col-sm-8">
	            <div class="input-group">
	                <label class="input-group-btn">
	                    <span class="btn btn-primary">
	                        Buscar <input name="primario[]" type="file" multiple style="display: none;" required="required"/>
	                    </span>
	                </label>
	                <input type="text" class="form-control" readonly>
	            </div>
	            <span class="help-block">
	                Arrastra el / los archivo(s) que desees agregar
	            </span>
	        </div>				
		</div>
		<input type="submit" value="Guardar" class="btn btn-success btn-lg pull-right" />
	</form>
</div>