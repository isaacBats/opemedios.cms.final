<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">

					<div class="col-md-6 widget">
						<h3 class="widget-title">Contactanos</h3>
						<div class="widget-body">
							<p>+52 1 55 55846410<br>
							<a href="mailto:atencion@opemedios.mx">atencion@opemedios.mx</a><br>
							Ures 69, Col. Roma Sur CP. 06760, México, DF, Del. Cuauhtémoc
							</p>
						</div>
					</div>
					
					<!-- 2018 -->
					<div class="col-md-6 widget">
						<div class="widget-body">
							<div class="social">
			                	<div class="social-tw">
			                    	<a href="https://twitter.com/DeMonitoreo" target="_blank">
			                    		<i class="fab fa-twitter"></i>
			                    	</a>
			                    </div>
			                	<div class="social-fb">
			                    	<a href="https://www.facebook.com/OPEMEDIOS/" target="_blank">
			                    		<i class="fab fa-facebook-f"></i>
			                    	</a>
			                    </div>
			                </div>
						</div>
					</div>
					<!-- /2018 -->

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="/">Inicio</a> |
								<a href="/quienes-somos">Quiénes somos</a> |
								<a href="/clientes">Clientes</a> |
								<a href="/contacto">Contacto</a> |
								<b><a href="signup.html">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="text-right">
                                Copyright &copy; <?=date('Y')?>, Opemedios.</a> 
                            </p>
                        </div>
                    </div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</footer>





	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<?php $dev_path = ""; ?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src='<?=$dev_path?>/assets/assets_client/js/headroom.min.js'></script>
	<script src='<?=$dev_path?>/assets/assets_client/js/jQuery.headroom.min.js'></script>

	<!-- GMAP3 -->
	<script type="text/javascript" src="https://opemedios.mx/assets/assets_home/jquery/gmap3/gmap3.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=es&amp;key=AIzaSyDNWJrJgodmdVVk0lGK7YXQTAmsAgCnKgc"></script>
	<script src='<?=$dev_path?>/assets/assets_client/js/scripts.js'></script>

	<script src='<?=$dev_path?>/assets/assets_client/js/template.js'></script>
	<?= $js ?>
</body>
</html>
