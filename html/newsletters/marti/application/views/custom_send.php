<div class="modal fade" id="custom_send" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Envío Personalizado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form_custom_send">
					<input type="text" class="hidden" name="id" id="idNewsletter" value="">
					<div class="form-group">
						<label for="emailTo">TO</label>
						<input type="text" class="form-control" id="emailTo"  name="data1">
						<small id="emailHelp" class="form-text text-muted">Una sola cuenta de correo.</small>
					</div>
					<div class="form-group">
						<label for="emailBcc">BCC</label>
						<div class="alert alert-warning" role="alert"><small>Multiples correos separados por coma y sin espacios <strong>ejemplo@mail.com,ejemplo@mail.com</strong></small></div>
						<div class="alert alert-danger hidden" role="alert" id="error_mails">Error de Sintaxis</div>
						<textarea class="form-control" id="emailBcc" rows="5" name="dataMails"></textarea>
					</div>
				</form>
				<div class="alert alert-success hidden" role="alert" id="confirm_send">Email Enviado</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="send_custom_mail">Enviar</button>
			</div>
		</div>
	</div>
</div>