<div class="container top50">
	<div class="row justify-content-center">
		<div class="col-sm-10">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=base_url('index.php/newsletters');?>">Newsletters</a></li>
                 <li class="breadcrumb-item active" aria-current="page">Títulos</li>
              </ol>
			</nav>
			<div class="card bg-white top50">
				<div class="card-header text-right">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new_newsletter"><i class="fas fa-plus"></i> Nuevo</button>
				</div>
				<div class="card-body">
					<div class="alert alert-danger hidden" role="alert" id="alert4">Newsletter Eliminado</div>
					<div class="alert alert-success hidden" role="alert" id="alert2">Newsletter Enviado</div>
					<table class="table text-center">
						<thead>
							<tr>
								<th>id</th>
								<th>Título</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($themes as $ns) {
							$news = base_url('index.php/category/').$ns["idCategory"];
							$preview = base_url('index.php/preview/').$ns["idCategory"];
							$edit = base_url('index.php/edit/').$ns["idCategory"];
							echo
								'<tr>
									<td class="align-middle">'.$ns['idCategory'].'</td>
									<td class="align-middle">'.$ns['nameCategory'].'</td>
									<td>
										<a href="single_title/'.$ns['idCategory'].'"><button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

										<a href="delete_theme/'.$ns['idCategory'].'"><button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a>

									</td>
								</tr>'; } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>