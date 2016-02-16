<div class="profile">
	<div class="profile_menu">
		
		<h2><?php echo $_SESSION["user"]['nombre'].' '.$_SESSION["user"]['apellidos'] ?></h2>
		<?php require "profile.menu.php"; ?>
	</div>		
	<div class=" profile_form ">
		<!-- <p>
			<?php echo $this->trans($lang , "*Mis contizaciones" , "*My Quotes"); ?>
		</p> -->
		<h1>Mis cotizaciones</h1>
		<?php
			if ($cotizaciones != null) {
				$html = "
					<table>
				        <thead>
				            <tr>
				                <th>
				                    Fecha
				                </th>
				                <th>
				                    Detalle
				                </th>
				            </tr>
				        </thead>
				        <tbody>
				";
				foreach ($cotizaciones as $cotizacion) {
					$html .= "
								<tr>
				                    <td>
				                        ".$cotizacion['created']."
				                    </td>
				                    <td ><a href=\"#\">Ver Detalles</a></td>
				                </tr>
					";



					 // "Fecha: ". $cotizacion['created']."<br>";
				}
				echo $html;
			}
		?>
		
	</div>
	<br class="clear">
</div>