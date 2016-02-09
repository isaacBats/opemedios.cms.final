            <h2 class="product-title"><?php echo  $product['nombre'] ?></h2>
            <div class="features">
            <p>
                <strong><?php echo $product['ur'] ?></strong>
            </p>
            <p>
                <?php  echo $this->trans($lang , 'Medidas cm' , 'Dimensions cm').': <b>W</b> '.$this->nmb($product['frente']).' <b>D</b> '.$this->nmb($product['fondo']).' <b>H</b> '.$this->nmb($product['altura']).' <b>cm</b><br>';?>
                <?php echo  $this->trans($lang , 'Medidas in' , 'Dimensions in').': <b>W</b> '.$product['frentre_plg'].' <b>D</b> '.$product['fondo_plg'].' <b>H</b> '.$product['altura_plg'].' <b>in</b><br>';?>

                <?php if( $product["acabado"] != "-"){ echo $this->trans( $lang , "Acabado:" , "Finishes:"); ?><?php echo $product["acabado"]."<br>"; }?>
                <?php if( $product["caracter"] != "-"){ echo $this->trans( $lang , "Carácter:" , "Character:");?> <?php echo $product['caracter']."<br>";} ?>
                <?php if( $product["como_se_muestra"] != "-"){ echo $this->trans( $lang , "Como se muestra: " , "As shown: ") ?><?php echo $product['como_se_muestra']."<br>"; }?>

                <?php echo $this->trans( $lang , "Precio:" , "Price:"); ?>

                <?php if( isset( $_SESSION["user"] ) ){ 

                        echo $this->trans( $lang , " $ ".$product["precio"]." MX" , " $ ".$product["_price"]." DLS" );
                        echo "<br>";
                        if( $product["precio_pintado"] != "-"){
                            echo $this->trans( $lang , "Precio Pintado:" , "Painted price:");
                            echo $this->trans( $lang , " $ ".$product["precio_pintado"]." MX" , " $ ".$product["price_painted"]." DLS" );    
                        }

                    }else{ ?>
                        <a href="<?php echo $this->url( $lang , "/login") ?>" class="general-link">Iniciar sesión</a>
                <?php } ?>
            </p>
            </div><!-- .features -->