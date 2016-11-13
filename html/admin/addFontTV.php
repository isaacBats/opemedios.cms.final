<div class="form-group col-sm-4">
    <label>Conductor</label>
    <input class="form-control" placeholder="Conductor" name="conductor" required >
</div>
<div class="form-group col-sm-1">
    <label>Canal</label>
    <input class="form-control" placeholder="Canal" name="canal" required >
</div>
<div class="form-group col-sm-3">
    <label>Horario: Desde</label>
    <div class='input-group date relojd' >
        <input class="form-control" placeholder="Desde:" name="desde" required >
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span>
    </div>
</div>
<div class="form-group col-sm-3">
    <label>Hasta</label>
    <div class='input-group date relojd' >
        <input class="form-control" placeholder="Hasta:" name="hasta" required >
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-time"></span>
        </span>
    </div>
</div>
<div class="form-group col-sm-3">
    <label>Señal</label>
     <select class="form-control" name="senal" required >
        <option value="">Señal</option>
        <option value="Televisión Abierta">Televisión Abierta</option>
        <option value="Cablevisión">Cablevisión</option>
        <option value="Sky">Sky</option>
    </select>
</div>