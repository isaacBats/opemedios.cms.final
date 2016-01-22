
			<div class="registro">
				<div class="acerca-principal-quienes" class="inicio-sesion">
					<p class="login"><img src="/images/imgInicioSesion.jpg"/></p>
				</div>

				<form>    
					<div class="acerca-secundario-quienes">
	        			<div class="inicio-sesion">
		            		<h2>DISE&#209;ADORES Y ARQUITECTOS</h2>
		            		<p>Bienvenidos a Alfonso Marina para profesionistas.</p>
		            		<div class="registrarse">
		                		<p>&#191;Todav&#237;a no te has registrado?</p>
		                		<a href="<?php echo $this->url($lang , "/register"); ?>">Reg&#237;strate ahora</a>
		            		</div>
		            		<div class="iniciar-sesion">
		                		<hgroup>
		                    		<h2>Iniciar Sesi&#243;n</h2>
		                    		<h3>Acceso a Miembros</h3>
		                		</hgroup>
		                		<input data-val="true" data-val-required="The Username field is required." id="Username" name="Username" placeholder="Usuario" type="text" value=""/>
		                		<br>
		                		<input data-val="true" data-val-required="The Password field is required." id="Password" name="Password" placeholder="Contraseña" type="password" />
		                		<br>
		                		<label><input data-val="true" data-val-required="The RememberMe field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" /><input name="RememberMe" type="hidden" value="false" />Recordar mi contrase&#241;a</label>
		                		<br>
		                		<input type="submit" value="Iniciar Sesi&#243;n">
		                		<a class="trigger-popup-login olvidoContrasenia" href="#"><strong>Olvid&#233; mi contrase&#241;a</strong></a>
		               			<input data-val="true" data-val-number="The field PaginaRegistroId must be a number." data-val-required="The PaginaRegistroId field is required." id="PaginaRegistroId" name="PaginaRegistroId" type="hidden" value="8158"/>
		            		</div>
	        			</div>
	    			</div>
				</form>
				<div class="iniciar-sesion popup-am hide" id="login-popup" style="height:230px">
					<form action="/umbraco/Surface/Account/Recovery" data-ajax="true" data-ajax-failure="PLError()" data-ajax-method="POST" data-ajax-mode="replace" data-ajax-success="PLSuccess()" data-ajax-update="#login-popup-target" id="frmRecoveryPopup" method="post"><hgroup>    
		            	<h2>Olvid&#233; mi contrase&#241;a</h2>
		        		</hgroup>
		        			<div style="width:250px">
		            			<p>Si olvidaste tu contrase&#241;a, por favor llena el campo con tu nombre de usuario y te enviaremos tu nueva contrase&#241;a al correo electr&#243;nico que registraste.</p>
		        			</div>
			        		<div>
			        			<input data-val="true" data-val-required="The Username field is required." id="Username" name="Username" placeholder="Usuario" style="float:left;" type="text" value=""/>
			        			<input type="submit" value="Enviar">
			        		</div>
			        		<div id="login-popup-target" style="width:250px;clear:both;"></div>
			        		<script type="text/javascript">
				            	function PLError() {
				                $('#login-popup-target').text('No fue posible recuperar tu password');
				            	}
				            	function PLSuccess() {
				                $('#login-popup-target').text('Tu nuevo password ha sido enviado al correo registrado');
				            	}
		        		</script>
		        	</form>
				</div>

			</div><!-- .registro -->
            <br class="clear"/>
        
            <div id="fb-root"></div>
            <!--FB (Default HTML5)-->
            
    </div><!-- #wrapper -->
            

           

	<footer id="main-footer">
			<footer id="inner-footer">
				<form >    
					<div id="newsletter">
		        		<input type="email" value="" placeholder="Email" name="Email" id="Email" data-val-required="The Email field is required." data-val-regex-pattern="^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$" data-val-regex="*" data-val="true" class="text-label">
		        		<input type="submit" id="news-submit" value="Suscribir" name="Submit">
		    		</div><!-- #newsletter --> 
				</form>
		        <p>&copy;Alfonso Marina Ebanista. Derechos Reservados 2015.</p>
		        <div id="social-media">
		        	<span class="tagline">Síguenos:</span>
                    <a class="btn-social facebook" href="https://www.facebook.com/pages/Alfonso-Marina-Ebanista/216426771801026?ref=aymt_homepage_panel" target="_blank">Facebook</a>
                    <a class="btn-social twitter" href="https://twitter.com/alfonsomarinamx" target="_blank">Twitter</a>
                    <a class="btn-social pinterest" href="http://pinterest.com/alfonsomarina/boards/" target="_blank">Pinterest</a>
                    <a class="btn-social instagram" href="http://instagram.com/alfonsomarinamx" target="_blank">Instagram</a>
                    <a class="btn-social dh" href="http://www.deringhall.com/designers/Alfonso-marina-ebanista" target="_blank">Dering Hall</a>
                </div><!-- #social-media -->
            </footer><!-- #main-footer -->
        </footer><!-- #inner-footer -->
</div><!-- #body -->
</body>
</html>