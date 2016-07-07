<div class="form-group col-lg-3">
    <label>Pagina</label> 
    <input class="form-control" value="<?= $relatedNew['pagina'] ?>" name="pagina" required>
</div>
<div class="form-group col-lg-3"> 
    <label>Tamaño (%)</label>
    <input class="form-control" value="<?= $relatedNew['porcentaje_pagina'] ?>" name="tamano" value="1" required>
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
        <?= $ub1 ?>
    </div>
    <div class="form-group">
        <?= $ub2 ?>
    </div>
    <div class="form-group">
        <?= $ub3 ?>
    </div>
    <div class="form-group">
        <?= $ub4 ?>
    </div>
</div>