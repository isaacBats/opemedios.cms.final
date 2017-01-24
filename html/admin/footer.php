<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary"></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>
            <!-- /.container-fluid -->
      </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/admin/js/jquery-ui.js" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/assets/js/sb-admin-2.js"></script>
    <!-- validate JavaScript -->
    <script src="/admin/js/jquery.validate.js"></script>

    <!-- Select2 JavaScript -->
    <script type="text/javascript" src="/assets/bower_components/moment/min/moment.min.js"></script>
    <script src="/admin/js/datetimepicker.js"></script>
    <script src="/assets/js/select2.min.js"></script>
                    

    <?= $javaScripts  ?>
    
    <!-- Custom JS Admin -->
    <script src="/admin/js/custom.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
          $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
          });

          $(document).ready( function() {
              $(':file').on('fileselect', function(event, numFiles, label) {

                  var input = $(this).parents('.input-group').find(':text'),
                      log = numFiles > 1 ? numFiles + ' files selected' : label;

                  if( input.length ) {
                      input.val(log);
                  }
              });
          });
          
        });
    </script>


</body>

</html>
