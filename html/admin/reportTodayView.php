<div class="row">
    <div class="col-sm-12">
        <h1 class="page-header">Reporte de noticias por día</h1>
    </div>
</div>
<div class="row">
    <form method="get" action="">
        <div class="form-group col-sm-4">
            <label>Fecha inicio</label>
            <input name="finicio" class="fechaNota form-control" />
        </div>
        <div class="form-group col-sm-4">
            <label>Fecha final</label>
            <input name="ffin" class="fechaNota form-control" />
        </div>
        <div class="form-group smt-marg col-sm-4" style="margin-top: 25px;" >
            <input type="submit" value="Actualizar Datos" class="btn btn-primary">           
        </div>
    </form>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Reporte de número de notas por usuarios Periodo de Busqueda 
                <?php 
                    if ($data['finicio'] == $data['ffin']) {
                      echo " de {$data['finicio']}";  
                    } else {
                        echo " desde {$data['finicio']} hasta {$data['ffin']}";
                    } ?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Numero de notas</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($data['news'] as $d): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $d['Nombre'] ?></td>
                                    <td><?= $d['Notas'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>