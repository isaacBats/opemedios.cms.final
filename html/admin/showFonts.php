	<?= $this->flashAlerts('fuentes'); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Administrar Fuentes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <form class="" id="bootpag_text_count">
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
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Fuentes
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Logo</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $html  ?>
                        </tbody>
                    </table>
                    <div class="col-md-6">
                        <p id="bootpag_text">
                            Mostrando registros del <b><?= $ini ?></b> al <b><?= $end ?></b> de un total de <b><?= $count ?></b> registros.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p id="bootpag_pag" data-count="<?= $count ?>"></p>
                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>