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
			echo $quote; 

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
					$date = date_create($cotizacion['created']);
					$html .= '
								<tr>
				                    <td>
				                        '.date_format($date, 'd/m/Y').'
				                    </td>
				                    <td ><a href="/profile/my-quote/detail/'.$cotizacion['id'].'">Ver Detalles</a></td>
				                </tr>
					';
				}
				echo $html;
			}

			if(empty($quote) && empty($cotizaciones)){
				echo $this->trans($lang , "No cuentas con cotizaciones.<br> Los puedes seleccionar de favoritos!!!" , "*Not have Quotes. <br> Add of Favorites");
			}
		?>
		
	</div>
	<br class="clear">
</div>