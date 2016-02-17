
<div class="registro">
    <div class="acerca-principal-quienes" class="inicio-sesion">
        <p class="login"><img src="/assets/images/imgInicioSesion.jpg"/></p>
    </div>

    <form action="<?php echo $this->url($lang, "/login"); ?>" method="POST">    
        <div class="acerca-secundario-quienes">
            <div class="inicio-sesion">
                <h2><?php echo $this->trans($lang, "DISE&#209;ADORES Y ARQUITECTOS", "DESIGNERS & ARCHITECTS") ?></h2>
                <p><?php echo $this->trans($lang, "Bienvenidos a Alfonso Marina para profesionistas.", "Welcome to Alfonso Marina for professionals.") ?></p>
                <div class="registrarse">

                    <p><?php echo $this->trans($lang, "&#191;Todav&#237;a no te has registrado?", "¿Not registered yet?") ?></p>
                    <a href="<?php echo $this->url($lang, "/register"); ?>">
                        <?php echo $this->trans($lang, "Reg&#237;strate ahora", "Register Now"); ?>
                    </a>
                </div>
                <div class="iniciar-sesion">
                    <hgroup>
                        <h2>
                            <?php echo $this->trans($lang, "Iniciar Sesi&#243;n", "LOGIN") ?>
                        </h2>
                        <h3>
                            <?php echo $this->trans($lang, "Acceso a Miembros", "MEMBER ACCESS") ?>
                        </h3>
                    </hgroup>
                    <input data-val="true" data-val-required="The Username field is required." id="Username" name="username" placeholder="<?php echo $this->trans($lang, "Usuario", "Username") ?>" type="text" value=""/>
                    <br>
                    <input data-val="true" data-val-required="The Password field is required." id="Password" name="password" placeholder="<?php echo $this->trans($lang, "Contraseña", "Password") ?>" type="password" />
                    <br>
                    <label><input data-val="true"  id="RememberMe" name="RememberMe" type="checkbox" value="true" />
                        <input name="RememberMe" type="hidden" value="false" />
                        <?php echo $this->trans($lang, "Recordar mi contrase&#241;a", "Remember my password ") ?>

                    </label>
                    <br>
                    <input type="submit" value="Iniciar Sesi&#243;n">
                    <a class="trigger-popup-login olvidoContrasenia"  id="resetPass" href="#">


                        <strong  >
                            <?php echo $this->trans($lang, "Olvid&#233; mi contrase&#241;a", "I forgot my password") ?>

                        </strong></a>
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


<div class="alert" id="alertHolder">
    <div class="bg"></div>
    <div class="message" style="height: auto;left: calc( 50% - 300px );width: 450px">
        <h2>Olvid&#233; mi contrase&#241;a</h2>
        <p id="alertMessage">Si olvidaste tu contrase&#241;a, por favor llena el campo con tu nombre de usuario y
            te enviaremos tu nueva contrase&#241;a al correo electr&#243;nico que registraste.
        </p>
        <div>
            <input data-val="true" id="resetUsername" name="resetUsername" placeholder="Usuario" style="margin-left: 110px" type="text" value="Isaac4"/>
            <input type="submit" onclick="resetPass()" value="Enviar" style="height: 23px; width: 70px" id="resetPassBtn">
            <p id="alertMessageS"></p>
        </div>
    </div>
</div>


