<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item active" aria-current="page">Newsletters</li>
				</ol>
			</nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_newsletter"><i class="fas fa-plus"></i> Nuevo</button>

					<a href="<?=base_url('index.php/titles');?>"><button type="button" class="btn btn-primary"><i class="fa fa-bullhorn"></i> Títulos</button></a>

					<a href="<?=base_url('index.php/opmedios/salir');?>"><button type="button" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> Salir</button></a>
				</div>
				<div class="card-body">
					<div class="alert alert-danger hidden" role="alert" id="alert4">Newsletter Eliminado</div>
					<div class="alert alert-success hidden" role="alert" id="alert2">Newsletter Enviado</div>
					<table class="table text-center">
						<thead>
							<tr>
								<th>id</th>
								<th>Fecha</th>
								<th>Estatus</th>
								<th>Empresa</th>
								<th>Acciones</th>
								<th>Enviar</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($newsletter as $ns) {
							$date = date_create($ns['date_send']);
							$news = base_url('index.php/news/').$ns["id"];
							$preview = base_url('index.php/preview/').$ns["id"];
							$edit = base_url('index.php/edit/').$ns["id"];
							$editCompany = base_url('index.php/edit_company/').$ns["idCustomer"];
							if($ns['status'] == "Retenido")
								{
									$selected = 'class="detained"';
									$icon = '<span class="text-warning"><i class="far fa-pause-circle"></i><span>';
								} 
							else 
								{
									$selected = NULL;
									$icon = '<span class="text-primary"><i class="far fa-check-circle"></i><span>';
								}


							if( $_SESSION['type'] == 1) {
								$ccy = '<td class="align-middle"><a href="'.$editCompany.'">'.$ns['nameCustomer'].'</a></td>';
							}

							else {
								$ccy = '<td class="align-middle">'.$ns['nameCustomer'].'</td>';
							}

							echo
								'
								
								<tr '.$selected.'>
									<td class="align-middle">'.$ns['id'].'</td>
									<td class="align-middle">'.date_format($date, 'd.m.Y').'</td>
									<td class="align-middle">'.$icon.'</td>
									'.$ccy.'
									<td>
										<a href="'.$news.'"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
										<a href="'.$edit.'"><button type="button" class="btn btn-primary"><i class="fas fa-cog"></i></button></a>
										<a href="'.$preview.'" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-eye"></i></button></a>
										<button type="button" class="btn btn-primary" data-id="'.$ns['id'].'"  data-toggle="modal" data-target="#custom_send" id="btn_custom_send"><i class="far fa-envelope-open"></i></button>
										<button type="button" class="btn btn-danger" data-id="'.$ns['id'].'" id="delete_newsletter"><i class="far fa-trash-alt"></i></button>
									</td>
									<td><button type="button" class="btn btn-primary" data-id="'.$ns['id'].'" id="send_mail"><i class="far fa-envelope"></i></button></td>
								</tr>'; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>