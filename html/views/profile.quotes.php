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
					$date = date_create($cotizacion['created']);
					$html .= "
								<tr>
				                    <td>
				                        ".date_format($date, 'd/m/y')."
				                    </td>
				                    <td ><a href=\"javascript:void(0);\">Ver Detalles</a></td>
				                </tr>
					";
				}
			echo $html;
			}elseif($products != null){
				foreach ($products as $product) {
					$html = '<div class="listado">
										<div class="list-item">
							                <div class="img-listado">
												<a href="'.$this->url($lang,'/product/'.$product['id']).'">
							                    	<img 
											            alt="'.$product["nombre"].'" 
											            src="http://www.alfonsomarinaebanista.com/images/'.$product["ur"].'/'.$product["ur"].'_alta2.jpg">
												</a>
							                </div>
							                <div class="texto-listado">
							                    <a href="'.$this->url($lang,'/product/'.$product['ur']).'"><h2>'.$product['nombre'].'</h2></a>
							                    '.$product['ur'].'
							                </div>
							                <br class="clear">
							            </div>
							         </div>';
					echo $html;
				}
			}else{
				echo $this->trans($lang , "No cuentas con cotizaciones" , "*Not have Quotes");
			}
		?>
		
	</div>
	<br class="clear">
</div>