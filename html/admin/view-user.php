<div class="panel">
    <div class="panel-heading">
        <h3 >
            Detalle de usuario
        </h3>
        <p></p>
    </div>


    <div class="panel-body">
        <div class="row">
            <div class="col-md-8"><?php
                foreach ($user as $key => $value) {
                    echo '<h4 class="panel-title">' . $key . '</h4>';
                    echo '<p>' . $value . '</p>';
                }
                ?> </div

            <div class="col-md-4">
                <h4 >Estatus</h4>
                <div class=" input-group-btn">
                    <select class="form-control" style="max-width: 200px" id="user_status">
                        <option value="0:<?php echo $user['id_registro']?>" <?php if ($user['status'] == 0) echo 'selected="selected"'; ?>>Pendiente</option>
                        <option value="1:<?php echo $user['id_registro']?>" <?php if ($user['status'] == 1) echo 'selected="selected"'; ?>>Aprobado</option>
                        <option value="2:<?php echo $user['id_registro']?>" <?php if ($user['status'] == 2) echo 'selected="selected"'; ?>>Denegado</option>
                    </select>
                </div>
            </div>
        </div> 



    </div>
</div>
