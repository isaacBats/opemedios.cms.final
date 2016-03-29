	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Agregar <?= $this->fuente ?></h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Agregar Sector
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="/panel/sector/add" method="post" name="add<?= $this->fuente ?>">
                            <div class="form-group">
                                <input class="form-control" placeholder="Nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea class="form-control" name="descripcion"></textarea>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="activo" value="1">Activo
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>