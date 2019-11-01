<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Newsletters Historico</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                .
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre newsletter</th>
                                <th>Fecha enviado</th>
                                <th>Empresa enviado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historic as $key => $bloque) : ?>
                                <tr>
                                    <td><?=$key+1?></td>
                                    <td><?=$bloque['name']?></td>
                                    <td><?=$bloque['fecha_envio']?></td>
                                    <td><?=$bloque['nombre_empresa']?></td>
                                    <td>
                                        <button data-idbloque="<?=$bloque['bloque_id']?>" 
                                                data-eid="<?=$bloque['empresa_id']?>"
                                                data-idb="<?=$bloque['id_bitacora']?>" 
                                                class="btn btn-success btn-resend" 
                                                data-toggle="modal" 
                                                data-target="#modalContacts">
                                            Reenviar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody> 
                    </table>
                    <div class="col-md-6">
                        <p id="bootpag_pag"></p>
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

<div class="modal fade" id="modalContacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Selecciona contactos</h4>
      </div>
      <form id="formContactsResend" action="/panel/newsletter/resend" method="POST">
      <div class="modal-body">
          <div class="panel-body">
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="checkbox-todos">Seleccionar todos
                </label>
            </div>
                <fieldset id="">
                    <input type="hidden" name="block" value="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover checkbox-active">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Enviar</th>
                                </tr>
                            </thead>
                            <tbody id="stack-contacts"></tbody>
                        </table>
                    </div><!-- /.table-responsive -->
                </fieldset>
        </div><!-- /.panel-body -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="cancel-replacer" data-dismiss="modal">
            Cancelar
        </button>
        <input type="submit" class="btn btn-primary" id="btnReenviar" value="Continuar" />
      </div>
      </form>
    </div>
  </div>
</div>