<div class="form-group col-lg-3">
    <label>Pagina</label> 
    <input class="form-control" placeholder="Pagina" name="pagina" required>
</div>
<div class="form-group col-lg-3"> 
    <label>Tamaño</label>
    <input class="form-control" placeholder="Tamaño (%)" name="tamano" value="1" required>
    <p class="help-block">Valor de 1 a 600.</p>
</div>
<div class="form-group col-lg-3">
    <label>Paginación</label>
     <select class="form-control" name="tipoPagina">
        <option value="">Tipo de Paginación</option>
        <?= $tipoPaginacion ?>
    </select>
</div>
<div class="well well-sm col-lg-6">
<label>Ubicación</label>
    <div class="form-group">
        <label class="checkbox-inline">
            <input name="ubicacion1" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion2" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion3" type="checkbox">
        </label>
    </div>
    <div class="form-group">
        <label class="checkbox-inline">
            <input name="ubicacion4" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion5" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion6" type="checkbox">
        </label>
    </div>
    <div class="form-group">
        <label class="checkbox-inline">
            <input name="ubicacion7" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion8" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion9" type="checkbox">
        </label>
    </div>
    <div class="form-group">
        <label class="checkbox-inline">
            <input name="ubicacion10" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion11" type="checkbox">
        </label>
        <label class="checkbox-inline">
            <input name="ubicacion12" type="checkbox">
        </label>
    </div>
</div>