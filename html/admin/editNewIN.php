<div class="form-group col-lg-3">
    <label>Hora de captura</label>
    <div class="input-group date_time">
        <input data-format="hh:mm:ss" type="text" value="<?= $relatedNew['hora_publicacion'] ?>" class="form-control height30" name="hora" />
        <span class="input-group-addon add-on">
          <span class="glyphicon glyphicon-time" data-time-icon="icon-time" data-date-icon="icon-calendar"></span>
        </span>
    </div>
</div>
<div class="form-group col-lg-6">
	<label>URL:</label> 
    <input class="form-control" value="<?= $relatedNew['url'] ?>" name="url" required>
</div>