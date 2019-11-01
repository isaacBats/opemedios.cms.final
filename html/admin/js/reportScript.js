(function(){
    window.addEventListener('load', onLoadHandle);
    console.log("starting script reports js");
    
    function onLoadHandle(){
        var $btnDoc = document.getElementById('btnCreateReportDOC'),
			$btnXls = document.getElementById('btnCreateReportXLS'),
            $btnPDf = document.getElementById('btnCreateReportPDF'),
            $form   = $('#formBusquedaAvanzada');
        
		$btnDoc.addEventListener('click', handleReportClickEvent);
        $btnXls.addEventListener('click', handleReportClickEvent);
        $btnPDf.addEventListener('click', handleReportClickEvent);
    
        function handleReportClickEvent(ev){
           if(!datosValidos()){
            swal("Opemedios", "Tienes campos obligatorios incompletos", "error").then(function(){
                $('#empresa').focus();
            })
            return
           }
            var actions = ["/admin/includes/crear_reporte_doc.php",
							"/admin/includes/crear_reporte_xls.php",
                            "/admin/includes/crear_reporte.php"];
            var actionsClient = ["/controllers/client-reports/reporte_doc_client.php",
								"/controllers/client-reports/reporte_xls_client.php",
                                "/controllers/client-reports/reporte_pdf_client.php"];
            switch(ev.target.id){
				case "btnCreateReportDOC":
                    var url = ev.target.name.indexOf('client') != -1 ? actionsClient[0]: actions[0];
                    $form.attr('action', url);
                    break;
                case "btnCreateReportXLS":
                    var url = ev.target.name.indexOf('client') != -1 ? actionsClient[0]: actions[0];
                    $form.attr('action', url);
                    break;
                case "btnCreateReportPDF":
                    var url = ev.target.name.indexOf('client') != -1 ? actionsClient[1]: actions[1];
                    $form.attr('action', url);
                    break;
            }
            $form.submit();
        }

        function datosValidos(){
            var formData = new FormData(document.getElementById('formBusquedaAvanzada'));
            var valido = function(campo){
                campo = campo+"";
                return (campo && campo.length>0);
            }
            var empresa = valido(formData.get("empresa"));
            var tema = $("#tema").val();
            return (empresa && tema);
        }
        
    }

})();