<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label>Pagina</label> 
    <input class="form-control" placeholder="Pagina" name="pagina" required>
</div>
<div class="form-group col-sm-12 col-md-6 col-lg-3"> 
    <label>Tamaño (%)</label>
    <input class="form-control" placeholder="Tamaño (%)" name="tamano" value="1" required>
    <p class="help-block">Valor de 1 a 600.</p>
</div>
<div class="form-group col-sm-12 col-md-6 col-lg-3">
    <label>Paginación</label>
     <select class="form-control" name="tipoPagina">
        <option value="">Tipo de Paginación</option>
        <?= $tipoPaginacion ?>
    </select>
</div>
<div class="form-group col-sm-3">
    <label>Ubicación:</label>
    <select class="form-control" name="ubicacion">
        <option value="">Ubicación de la nota</option>
        <option value="1">Superior Izquierda</option>
        <option value="2">Superior Derecha</option>
        <option value="3">Centro</option>
        <option value="4">Inferior Izquierda</option>
        <option value="5">Inferior Derecha</option>
    </select>
</div>