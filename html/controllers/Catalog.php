<?php


// TODO: Corregir error en las URL de que se rompen
class Catalog extends Controller {

    // Check numbers 
    private function nmb($number) {
        if ($number != "-") {
            return number_format(str_replace(",", ".", $number), 1);
        }
    }

    public function productCare($lang = "es") {
        $this->addBread(array("label" => $this->trans($lang, "Cuidado de productos", "Product Care")));
        $this->header($lang, $this->trans($lang, "Cuidado de productos - ", "Product Care - "));
        require $this->views . "product-care.php";
        $this->footer($lang);
    }

    // ESTO SIRVE PARA lEER LAS CARPETAS Y PONER LAS IMAGENES CORRECTAS
    // public function updateProducts(){
    // 		$images = scandir( "images/product" );
    // 		foreach ($images as $image) {
    // 			$ur = explode( "_", $image );
    // 			$sql = "UPDATE `amarinados`.`product` SET `imagen` = '{$image}' WHERE `product`.`ur` LIKE '{$ur[0]}';";
    // 			$query = $this->pdo->prepare($sql);
    // 			$rs = $query->execute();
    // 		}
    // 		exit;
    // }
    //  UPDATE gallery_image nombre de imagenes
    // public function updateProducts(){
    // 		$sql = "SELECT * FROM gallery_image";
    // 		$query = $this->pdo->prepare($sql);
    // 		$query->execute();
    // 		$imagenes = $query->fetchAll();
    // 		foreach ($imagenes as $image) {
    // 			$img = array_pop(explode( "/", $image["imagen"] ));
    // 			$sql = "UPDATE `gallery_image` SET `imagen` = '{$img}' WHERE `id` LIKE '{$image["id"]}';";
    // 			$query = $this->pdo->prepare($sql);
    // 			$rs = $query->execute();
    // 		}
    // 		exit;
    // }
    //  CATALOG

    public function removeProductFavorite($lang) {

        $resultado = new stdClass();

        if (!empty($_POST)) {
            if (!isset($_SESSION['favoritos'])) {
                $_SESSION['favoritos'] = array();
            }

            if (($key = array_search($_POST['id'], $_SESSION['favoritos'])) !== false) {
                unset($_SESSION['favoritos'][$key]);
            }

            $resultado->exito = true;
            $resultado->log = "Se removió el ID al contenedor de FAVORITOS";
            $resultado->mensaje = $this->trans($lang, 'Añadir a Favoritos', 'Add to Favorites');
        } else {
            $resultado->exito = false;
        }

        header('Content-type: text/json');
        echo json_encode($resultado);
    }

    public function addProductFavorite($lang) {

        $resultado = new stdClass();

        if (!empty($_POST)) {
            if (!isset($_SESSION['favoritos'])) {
                $_SESSION['favoritos'] = array();
            }
            array_push($_SESSION['favoritos'], $_POST['id']);
            if (isset($_SESSION['user'])) {
                $sql = "INSERT INTO usuarios_fav (producto_id, usuarios_id)
										VALUES  (:product_id, :user_id);
							
						";
                $query = $this->pdo->prepare($sql);
                $query->bindParam(':product_id', $_POST['id']);
                $query->bindParam(':user_id', $_SESSION["user"]['id_registro']);
                $rs = $query->execute();
                if (!$rs) {
                    echo "No se agrego a la base de datos";
                    $resultado->exito = false;
                    return false;
                }
            }
            $resultado->log = "Se agregó el ID al contenedor de FAVORITOS";
            $resultado->mensaje = $this->trans($lang, 'Eliminar de Favoritos', 'Remove from Favorites');
            return $resultado->exito = true;
        } else {
            $resultado->exito = false;
        }

        header('Content-type: text/json');
        echo json_encode($resultado);
    }

    public function showFavs($lang) {


        $this->addBread(array("label" => $this->trans($lang, "Mis Favoritos", "My Favorites")));
        $this->header($lang, $this->trans($lang, "Mis Favoritos - ", "My Favorites - "));
        $productList = "";

        if (isset($_SESSION['favoritos']) && sizeof($_SESSION['favoritos']) > 0) {

            $ids = implode(",", $_SESSION['favoritos']);

            $sql = "SELECT * FROM product WHERE id in (" . $ids . ")";
            $query = $this->pdo->prepare($sql);
            $rs = $query->execute();
            if ($rs !== false) {
                $nr = $query->rowCount();
                if ($nr > 0) {
                    $productList = $query->fetchAll();
                    $count = 0;
                }
            }
        } elseif (isset($_SESSION['user'])) {
            $queryFav = $this->pdo->prepare("SELECT * FROM usuarios_fav 
									WHERE usuarios_id = {$_SESSION['user']['id_registro']}
									GROUP BY producto_id;");
            $rsFav = $queryFav->execute();
            if ($rsFav) {
                $favDB = $queryFav->fetchAll(\PDO::FETCH_ASSOC);
                $idFavoritos = array_column($favDB, 'producto_id');
                $ids = implode(",", $idFavoritos);
                $queryUserFav = $this->pdo->prepare("SELECT * FROM product WHERE id IN (" . $ids . ")");
                $rs = $queryUserFav->execute();
                if ($rs !== false) {
                    $productList = $queryUserFav->fetchAll();
                }
            }
        } else {
            echo "<h3>No cuentas con favoritos</h3>";
        }
        require $this->views . "favs.php";
        $this->footer($lang);
    }

    public function showAll($lang) {
        header("Location: ./catalog/product");
    }

    public function categoriesByType($lang = "es", $type = null) {
        if ($type != null) {
            $this->printCategoriesByType($lang, array(0 => array($this->trans($lang, "tipo", "_type") => $type)));
        } else {
            $sqlCatalogo = "SELECT * FROM product GROUP BY " . $this->trans($lang, "categoria", "_category") . " ORDER BY " . $this->trans($lang, "tipo", "_type") . " DESC";
            $queryCatalogo = $this->pdo->prepare($sqlCatalogo);
            $queryCatalogo->execute();
            $catalogo = $queryCatalogo->fetchAll();
            $this->printCategoriesByType($lang, $catalogo);
        }
    }

    private function printCategoriesByType($lang = "es", $catalogo) {

        $html = "";
        if ($lang == "es") {
            $this->addBread(array("url" => "/catalog", "label" => "Catalogo"));
            $this->addBread(array("label" => "Productos"));
        } else if ($lang == "en") {
            $this->addBread(array("url" => "/catalog", "label" => "Catalog"));
            $this->addBread(array("label" => "Products"));
        } else {
            $html .= 'No existe lang';
        }
        $this->header($lang, $this->trans($lang, "Categoría - ", "Category - "));

        $html .= '<div id="content-press">';
        $tipo = "";
        $filtro = '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . $this->trans($lang, "Filtro de Productos", "Product Filter") . '</option>';

        foreach ($catalogo as $product) {
            if ($tipo != $product[$this->trans($lang, "tipo", "_type")]) {
                $tipo = $product[$this->trans($lang, "tipo", "_type")];
                $html .= '<div class="tituloSeccion clear">' . ucfirst(strtolower($tipo)) . '</div>';
                $filtro .='<optgroup label="' . $tipo . '">';

                // $sqlCategorias = "SELECT
                //                         product.ur, categories_products.category as mainCategory
                //                         FROM
                //                         categories_products
                //                         JOIN product
                //                         ON categories_products.product_id = product.id and categories_products.id in (SELECT DISTINCT
                //                         categories_products.id
                //                         FROM
                //                         product
                //                         INNER JOIN categories_products
                //                         ON product._category = categories_products.category
                //                         WHERE LOWER(" . $this->trans($lang, "tipo", "_type") . ")=LOWER('" . $tipo . "') and  " . $this->trans($lang, "categoria", "_category") . "  NOT like '%,%') order by mainCategory";

                $sqlCategorias = "SELECT DISTINCT ur, ".$this->trans($lang, 'categoria', '_category')." AS mainCategory FROM product WHERE ".$this->trans($lang, 'tipo', '_type')." = '".$tipo."' AND ".$this->trans($lang, 'categoria', '_category')." NOT LIKE '%,%' GROUP BY ".$this->trans($lang, 'categoria', '_category').";";

                $queryCategorias = $this->pdo->prepare($sqlCategorias);

                $queryCategorias->execute();

                $categorias = $queryCategorias->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($categorias as $categoria) {

                    $filtro.='<option value="' . ( $this->url($lang, "/catalog/" . str_ireplace(' ', '-', strtolower($tipo)) . "/" . str_ireplace(' ', '-', $categoria['mainCategory'])) ) . '">' . ucwords($categoria['mainCategory']) . '</option>';

                    $html .= '<article class="item4Col">
                                <a href="' . ( $this->url($lang, "/catalog/" . str_ireplace(' ', '-', strtolower($tipo)) . "/" . str_ireplace(' ', '-', strtolower($categoria['mainCategory']))) ) . '">
                                        <div class="imageHolder">
                                            <img
                                            alt="' . $categoria['mainCategory'] . '"
                                            src="http://www.alfonsomarinaebanista.com/images/' . $categoria["ur"] . '/' . $categoria["ur"] . '_alta1.jpg">
                                         </div>
                                    <br class="clear">
                                    <br class="clear">
                                    <p>
                                    ' . str_replace(" Y ", " y ", ucwords(strtolower($categoria['mainCategory']))) . '
                                    </p>
                                </a>
                        </article>';
                }
                $filtro.='</optgroup>';
            }
        }
        $filtro.='</select></div>';
        $html .= "</div><!-- .product-list -->";
        $html = str_ireplace('<div id="content-press">', '<div id="content-press">' . $filtro, $html);
        echo $html;
        $this->footer($lang);
    }

    public function showListProductsByDate($lang = "es", $date = "", $category = "", $use = "") {

        $html = "";
        $this->addBread(array("label" => $this->trans($lang, "Productos Nuevos", "New Products"), "url" => "/catalog/new-products"));       
        
        $html .= '<div id="content-press">';

        $sqltipos = "SELECT DISTINCT " . $this->trans($lang, "tipo", "_type") . " FROM product where created <>'-' and " . $this->trans($lang, "tipo", "_type") . " not like '%,%' ";

        if ($date == "") {
            $sqltipos.= " order by  " . $this->trans($lang, "tipo", "_type");

            $sqldates = "SELECT DISTINCT DATE_FORMAT( DATE(created),'%M %Y') as datec FROM product where created <>'-' order by DATE(created) desc;";
            $querydates = $this->pdo->prepare($sqldates);
            $querydates->execute();
            $dates = $querydates->fetchAll(\PDO::FETCH_ASSOC);

            $filtro = '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . $this->trans($lang, "Productos Nuevos", "New Products") . '</option>';
            foreach ($dates as $dates) {
                $filtro.='<option value="' . ( $this->url($lang, "/catalog/new-products/" . str_ireplace(' ', '-', strtolower($dates['datec'])))) . '">' . ucwords($dates['datec']) . '</option>';
            }
            $filtro.="</select></div>";
            $html .= $filtro;
        } else {
            $this->addBread(array("label" => $date, "url" => "#"));
            

            if ($category != "") {

                if ($use != "") {
                    $sqltipos.= "and lower(" . $this->trans($lang, "uso", "_use") . ")='" . str_ireplace('-', ' ', $use) . "' and lower(" . $this->trans($lang, "categoria", "_category") . ")='" . str_ireplace('-', ' ', $category) . "'  and lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' order by " . $this->trans($lang, "tipo", "_type");
                    $filtro = '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . ucwords($date) . '</option><option value="#">' . ucwords($use) . '</option></select></div>';
                } else {
                    $sqltipos.= "and lower(" . $this->trans($lang, "categoria", "_category") . ")='" . str_ireplace('-', ' ', $category) . "'  and lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' order by " . $this->trans($lang, "tipo", "_type");
                    $sqluso = "SELECT DISTINCT " . $this->trans($lang, "uso", "_use") . " as uso FROM product where " . $this->trans($lang, "uso", "_use") . " not like '%,%' and lower(" . $this->trans($lang, "categoria", "_category") . ")='" . str_ireplace('-', ' ', $category) . "' and lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' order by uso;";
                    $queryuso = $this->pdo->prepare($sqluso);
                    $queryuso->execute();
                    $usos = $queryuso->fetchAll(\PDO::FETCH_ASSOC);
                    $filtro = '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . ucwords($date) . '</option>';

                    foreach ($usos as $uso) {
                        $filtro.='<option value="' . ( $this->url($lang, "/catalog/new-products/" . $date . '/' . str_ireplace(' ', '-', strtolower($category)) . '/' . str_ireplace(' ', '-', strtolower($uso['uso'])))) . '">' . ucwords($uso['uso']) . '</option>';
                    }
                    $filtro.="</select></div>";
                }
                $html .= $filtro;
            } else {
                $sqltipos.= "and lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' order by " . $this->trans($lang, "tipo", "_type");

                $sqlcat = "SELECT DISTINCT " . $this->trans($lang, "categoria", "_category") . " as cat FROM product where " . $this->trans($lang, "categoria", "_category") . " not like '%,%' and lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' order by categoria;";
                $querycat = $this->pdo->prepare($sqlcat);
                $querycat->execute();
                $categorias = $querycat->fetchAll(\PDO::FETCH_ASSOC);
                $filtro = '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . ucwords($date) . '</option>';

                foreach ($categorias as $categoria) {
                    $filtro.='<option value="' . ( $this->url($lang, "/catalog/new-products/" . $date . '/' . str_ireplace(' ', '-', strtolower($categoria['cat'])))) . '">' . ucwords($categoria['cat']) . '</option>';
                }
                $filtro.="</select></div>";
                $html .= $filtro;
            }
        }
        $queryTipos = $this->pdo->prepare($sqltipos);
        $queryTipos->execute();
        $tipos = $queryTipos->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($tipos as $tipo) {
            if ($tipo != $tipo[$this->trans($lang, "tipo", "_type")]) {
                $tipo = $tipo[$this->trans($lang, "tipo", "_type")];
                $nombre = $this->trans($lang, "nombre", "_name");

                if ($date == "")
                    $sqlProductos = "SELECT * FROM product where created <>'-' and lower(" . $this->trans($lang, "tipo", "_type") . ") ='" . strtolower($tipo) . "' order by " . $nombre;
                else {
                    if ($category != "") {
                        if ($use != "")
                            $sqlProductos = "SELECT * FROM product where lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' and lower(" . $this->trans($lang, "categoria", "_category") . ") ='" . str_ireplace('-', ' ', $category) . "' and lower(" . $this->trans($lang, "uso", "_use") . ") ='" . str_ireplace('-', ' ', $use) . "' and lower(" . $this->trans($lang, "tipo", "_type") . ") ='" . strtolower($tipo) . "' order by " . $nombre;
                        else
                            $sqlProductos = "SELECT * FROM product where lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' and lower(" . $this->trans($lang, "categoria", "_category") . ") ='" . str_ireplace('-', ' ', $category) . "' and lower(" . $this->trans($lang, "tipo", "_type") . ") ='" . strtolower($tipo) . "' order by " . $nombre;
                    } else {
                        $sqlProductos = "SELECT * FROM product where lower(DATE_FORMAT( DATE(created),'%M-%Y')) ='" . $date . "' and lower(" . $this->trans($lang, "tipo", "_type") . ") ='" . strtolower($tipo) . "' order by " . $nombre;
                    }
                }
                $html .= '<div class="tituloSeccion clear">' . ucfirst(strtolower($tipo)) . '</div>';
                $queryProductos = $this->pdo->prepare($sqlProductos);
                $queryProductos->execute();
                $productos = $queryProductos->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($productos as $producto) {
                    $html .= '<article class="item4Col">
                               <a href="' . ( $this->url($lang, "/product/" . str_ireplace(' ', '-', $producto["ur"])) ) . '">
                                        <div class="imageHolder">
                                            <img
                                            alt="' . $producto['nombre'] . '"
                                            src="http://www.alfonsomarinaebanista.com/images/' . $producto["ur"] . '/' . $producto["ur"] . '_alta1.jpg">
                                         </div>
                                    <br class="clear">
                                    <br class="clear">
                                    <p>
                                    ' . ucwords($producto[$nombre]) . '
                                    </p>
                                </a>
                        </article>';
                }
            }
        }
        $this->header($lang, $this->trans($lang, "Productos Nuevos - ", "New Products - "));
        $html .= "</div><!-- .product-list -->";
        echo $html;
        $this->footer($lang);
    }

    public function showListProducts($lang = "es", $style = "", $type = "", $group = "") {

        $ostyle = $style;
        $otype = $type;
        $ogroup = $group;
        $use = $ouse = "";


        $this->addBread(array("label" => $this->trans($lang, "Catalogo", "Catalog"), "url" => "/catalog/products"));

        if ($style != "casual" && $style != "metro") {
            $use = $ouse = $group;
            $ogroup = $type;
            $otype = $style;
            $group = $type;
            $type = $style;

            if ($type != "")
                $this->addBread(array("label" => ucwords(strtolower($type)), "url" => "/catalog/" . $style));
            if ($group != "")
                $this->addBread(array("label" => ucwords(strtolower(str_replace("-", " ", urldecode($group)))), "url" => "/catalog/" . $style . "/" . $group));
            if ($use != "")
                $this->addBread(array("label" => ucwords(strtolower(str_replace("-", " ", urldecode($use))))));
        }else {

            $this->addBread(array("label" => ucwords(strtolower($style)), "url" => "/catalog/" . $style));
            if ($type != "")
                $this->addBread(array("label" => ucwords(strtolower($type)), "url" => "/catalog/" . implode("/", array($style, $type))));
            if ($group != ""){
                $this->addBread(array("label" => ucwords(strtolower(str_replace("-", " ", urldecode($group))))));
                print_r($use);}
        }

        $html = "";
        $style = $style == "casual" || $style == "metro" ? $this->trans($lang, "estilo", "style") . " LIKE '{$style}' " : " 1=1 ";
        $type = $type != "" ? $this->trans($lang, "tipo", "_type") . " LIKE '{$type}' " : " 1=1 ";
        $group = $group != "" ? "LOWER( " . $this->trans($lang, "categoria", "_category") . " ) LIKE '%" . str_replace("-", " ", urldecode($group)) . "%' " : " 1=1 ";
        $use = $use != "" ? "LOWER( " . $this->trans($lang, "uso", "_use") . " ) LIKE '%" . str_replace("-", " ", urldecode($use)) . "%' " : " 1=1 ";

        $where = implode(" AND ", array($style, $type, $group, $use));

        $groupBy = ( $group == " 1=1 " ) ? " GROUP BY " . $this->trans($lang, "categoria", "_category") . " " : "";
        $grouping = ($groupBy != "") ? $this->trans($lang, "categoria", "_category") : false;


        $sqlCatalogo = "SELECT * FROM product WHERE {$where} {$groupBy} ";


        $queryCatalogo = $this->pdo->prepare($sqlCatalogo);
        $rsCatalogo = $queryCatalogo->execute();


        // CHECK IN OTHER LANGUEJAS
        if ($queryCatalogo->rowCount() == "0") {

            $lang = $lang == "es" ? "en" : "es";
            $style = $ostyle == "casual" || $ostyle == "metro" ? $this->trans($lang, "estilo", "style") . " LIKE '{$ostyle}' " : " 1=1 ";
            $type = $otype != "" ? $this->trans($lang, "tipo", "_type") . " LIKE '{$otype}' " : " 1=1 ";
            $group = $ogroup != "" ? "LOWER( " . $this->trans($lang, "categoria", "_category") . " ) LIKE '%" . str_replace("-", " ", urldecode($ogroup)) . "%' " : " 1=1 ";
            $where = implode(" AND ", array($style, $type, $group));
            $lang = $lang == "en" ? "es" : "en";
            $sqlCatalogo = "SELECT * FROM product WHERE {$where} {$groupBy}";
            $queryCatalogo = $this->pdo->prepare($sqlCatalogo);
            $rsCatalogo = $queryCatalogo->execute();
        }




        if ($rsCatalogo !== false) {
            $pr = $queryCatalogo->rowCount();
            if ($pr > 0) {
                $filtro = "";
                if ($ouse == "") {
                    $sqlUsos = "SELECT DISTINCT lower(" . $this->trans($lang, "uso", "_use") . ") as uso                            
                            FROM product where " . $this->trans($lang, "uso", "_use") . "  not like '%,%'
                            and LOWER(" . $this->trans($lang, "categoria", "_category") . " )= LOWER('" . str_replace("-", " ", urldecode($ogroup)) . "')
                            and LOWER(" . $this->trans($lang, "tipo", "_type") . " )= LOWER('" . str_replace("-", " ", urldecode($otype)) . "')
                            order by " . $this->trans($lang, "uso", "_use") . " ";

                    $queryUsos = $this->pdo->prepare($sqlUsos);
                    $queryUsos->execute();
                    $usos = $queryUsos->fetchAll(\PDO::FETCH_ASSOC);

                    if ($queryUsos->rowCount() > 0) {

                        $filtro.= '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . $this->trans($lang, "Filtro de Productos", "Product Filter") . '</option>';

                        foreach ($usos as $uso) {
                            $filtro.= '<option value="' . ( $this->url($lang, "/catalog/" . str_ireplace(' ', '-', strtolower($otype)) . "/" . str_ireplace(' ', '-', $ogroup)) ) . "/" . str_ireplace(' ', '-', $uso['uso']) . '">' . strtoupper($uso['uso']) . '</option>';
                        }
                        $filtro.= '</select></div>';
                    }
                } else {
                    $filtro.= '<div class=" input-group-btn" id="productsFilter"><select><option value="#">' . $this->trans($lang, "Filtro de Productos", "Product Filter") . '</option>';
                    $filtro.= '<option value="#">' . strtoupper($ouse) . '</option></select></div>';
                }
                $catalogo = $queryCatalogo->fetchAll();
                $tituloSeccion = str_replace("-", " ", urldecode(ucfirst(end($this->bread)["label"])));
                $tituloSeccion = str_replace(" Y ", " y ", $tituloSeccion);
                $html .= '<div id="content-press">' . $filtro;
                $html .= '<p class="tituloSeccion">' . $tituloSeccion . '</p>';





                if ($grouping) {
                    foreach ($catalogo as $product) {
                        $stype = strtolower($this->trans($lang, $product["tipo"], $product["_type"]));
                        $product["imagen"] = $product["imagen"] != "-" ? "/assets/images/product/" . $product["imagen"] : "http://placehold.it/200x200/f4f4f4/ccc?text=product";
                        $html .= '
								<article class="item4Col">
							        <a href="' . $this->url($lang, "/catalog/" . $stype . "/" . strtolower(str_replace(" ", "-", $product[$grouping]))) . '">
							        	<div class="imageHolder">
								            <img 
								            alt="' . $product["nombre"] . '" 
								            src="http://www.alfonsomarinaebanista.com/images/' . $product["ur"] . '/' . $product["ur"] . '_alta1.jpg">
								         </div>
							            <br class="clear">
							            <br class="clear">
							            <p>
							            ' . str_replace(" Y ", " y ", ucwords(strtolower($product[$grouping]))) . '
							            </p>
							        </a>
							    </article>
								';
                    }
                } else {
                    foreach ($catalogo as $product) {
                        $product["imagen"] = $product["imagen"] != "-" ? "/assets/images/product/" . $product["imagen"] : "http://placehold.it/200x200/f4f4f4/ccc?text=product";
                        $html .= '
								<article class="item4Col">
							        <a href="' . $this->url($lang, "/product/" . $product['ur']) . '">
							        	<div class="imageHolder">
								            <img 
								            alt="' . $product["nombre"] . '" 
								            src="http://www.alfonsomarinaebanista.com/images/' . $product["ur"] . '/' . $product["ur"] . '_alta1.jpg">
								         </div>
							            <br class="clear">
							            <br class="clear">
							            <p>
							            ' . str_replace(" Y ", " y ", ucwords(strtolower($product["nombre"]))) . '
							            </p>
							        </a>
							    </article>
								';
                    }
                }

                $html .= "</div><!-- .product-list -->";
            }
        }

        $this->header($lang, $this->trans($lang, "Categoría - ", "Category - "));
        echo $html;
        $this->footer($lang);
    }

    // public function detailProduct( $lang = "es" , $slug){
    // 	$this->header( $lang );
    // 	if( $lang == "es"){
    // 		echo "producto español";
    // 	}else{
    // 		echo "producto ingles";
    // 	}

    /*
      | by adanzilla ...
     */
    private function productsByCategory($lang, $category) {
        $lang == "en" ? $sql = "SELECT ur FROM product WHERE _category LIKE '$category'" : $sql = "SELECT ur FROM product WHERE categoria LIKE '$category'";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs !== false) {
            $nr = $query->rowCount();
            if ($nr > 0) {
                $slugs = $query->fetchAll(PDO::FETCH_COLUMN);
                return $slugs;
            }
        }
    }

    /*
      | by adanzilla ...
     */

    function navProduct($lang = "es", $slug, $category) {

        $slugs = $this->productsByCategory($lang, $category);
        
        /*         * ********************************************************************************* */
        $key_actual = array_search($slug, $slugs);
        $key_final = key(array_slice($slugs, -1, 1, TRUE));
        /*         * ********************************************************************************* */

        $anterior = ( ($key_actual - 1) < 0 ) ? '<a href="' . $slugs[$key_final] . '">' . $this->trans($lang, 'Anterior', 'Previous') . '</a>' : '<a href="' . $slugs[$key_actual - 1] . '">' . $this->trans($lang, 'Anterior', 'Previous') . '</a>';
        $siguiente = ( ($key_actual + 1) > $key_final ) ? '<a href="' . $slugs[0] . '">' . $this->trans($lang, 'Siguiente', 'Next') . '</a>' : '<a href="' . $slugs[$key_actual + 1] . '">' . $this->trans($lang, 'Siguiente', 'Next') . '</a>';

        $html = $anterior . ' | ' . $siguiente;

        return $html;
    }

    function importRow($fields, $Row, $c) {

        $query = $this->pdo->prepare("SELECT * FROM product WHERE `ur` LIKE '{$Row[0]}' ");
        $rs = $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $this->importUpdate($fields, $Row);
            $c[0] ++;
        } else {
            $this->importCreate($fields, $Row);
            $c[1] ++;
        }
        return $c;
    }

    function importUpdate($fields, $Row) {
        $out = "UPDATE `product` SET ";
        foreach ($fields as $key => $value) {
            $d = str_replace("'", "\'", $Row[$key]);
            $out .= "`" . $value . "` = '" . $d . ($key == count($fields) - 1 ? "" : "',\n\t");
        }
        $out .= "' \r WHERE `ur` LIKE '{$Row[0]}';\n\n";
        if (!$this->pdo->prepare($out)->execute()) {
            echo "<pre>";
            echo "error\n";
            echo $out;
            exit;
        }
    }

    function importCreate($fields, $Row) {
        $out = "INSERT INTO `product` (";
        foreach ($fields as $key => $value)
            $out .= "`" . $value . ($key == count($fields) - 1 ? "" : "`,\n");
        $out .= "`) VALUES (";
        foreach ($Row as $key => $d) {
            $d = str_replace("'", "\'", $d);
            $out .= "'" . $d . ($key == count($fields) - 1 ? "" : "',\n");
        }
        // $out .= "`".$value."` = '".$Row[$key].($key == count($fields)-1?"":"',\n\t");
        $out .= "');\n\n";
        if (!$this->pdo->prepare($out)->execute()) {
            echo "<pre>";
            echo "error\n";
            echo $out;
            exit;
        }
    }

    function import() {
        if (isset($_FILES["excel"])) {

            $file = $_FILES["excel"]["tmp_name"];
            $f = utf8_encode(file_get_contents($file));
            $Data = str_getcsv($f, "\n");
            foreach ($Data as &$Row)
                $Row = str_getcsv($Row, ",");
            $c = 0;
            $flag = false;
            $counters = [0, 0];
            $fields = $Data[0];
            unset($Data[0]);
            foreach ($Data as $Row) {
                if (!$flag) {
                    $flag = true;
                } else {
                    if (count($Row) != count($fields)) {
                        echo "inconsistencia en la linea " . $c;
                        print_r($Row);
                    } else {
                        $counters = $this->importRow($fields, $Row, $counters);
                    }
                }
                $c++;
            }
            echo "Updated : " . $counters[0];
            echo "Created : " . $counters[1];
        } else {
            $this->header_admin();
            require $this->adminviews . "import.php";
            $this->footer_admin();
        }
    }

    function export() {

        // filename for download
        $filename = "website_data_" . date('Ymd-hs') . ".csv";

        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Content-Type: text/plain; charset=iso-8859-1');

        $sql = "SELECT `ur`,`nombre`,`_name`,`caracter`,`_character`,`acabado`,`tipo_acabado`,`como_se_muestra`,
		`current_finish`,`precio`,`familia`,`original`,`created`,`_match`,`_price`,`precio_pintado`,`price_painted`,
		`tipo`,`_type`,`categoria`,`_category`,`uso`,`_use`,`frente`,`fondo`,`altura`,`diametro`,`frentre_plg`,
		`fondo_plg`,`altura_plg`,`diametro_plg`
		FROM product ";


        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs) {
            $product = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $flag = false;
        foreach ($product as $row) {
            if (!$flag) {

                echo '"' . implode('","', array_keys($row)) . '"' . "\r\n";
                $flag = true;
            }
            array_walk($row, function(&$data) {
                $data = str_replace(['"', "null"], ["", "-"], $data);
                $data = ( $data == "") ? "-" : $data;
            });
            //echo utf8_decode(implode(",", array_values($row)) ). "\r\n";
            echo utf8_decode('"' . implode('","', array_values($row)) . '"') . "\r\n";
        }
    }

    function findMatch($slug) {

        $sql = "SELECT * FROM product WHERE ur LIKE '$slug'";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        if ($rs) {
            return $query->fetch();
        }

        return false;
    }

    function findRelated($pro) {

        $ur = $pro["original"] == "-" ? $pro["ur"] : $pro["original"];
        $fam = $pro["familia"] != "-" ? "OR `familia` LIKE '{$pro["familia"]}' " : "";
        $match = $pro["_match"] != "-" ? "OR `ur` LIKE '{$pro["_match"]}' " : "";

        // ORIGINAL 
        $sql = "SELECT * FROM product WHERE ur LIKE '%$ur%' OR `original` LIKE '%$ur%' {$fam} OR `_match` LIKE '%{$pro["ur"]}%' {$match}";
        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        $buffer = [];
        if ($rs) {
            $products = $query->fetchAll();
            foreach ($products as $product) {
                if (!array_search($product, $buffer) && $product["ur"] != $pro["ur"]) {
                    array_push($buffer, $product);
                }
            }
            return $buffer;
        }
        return [];
    }

    function detailProduct($lang = "es", $slug) {
        // TODO: @Catalogo Crear slugs optimizadas para seo(5)
        // TODO: @Catalogo Agregar la vista de dos productos en el mismo (1)
        // TODO: @Catalogo Agrega vista de variaciones del producto (3)

        if (!empty($slug)) {


            $this->addBread(array("label" => $this->trans($lang, "Catalogo", "Catalog"), "url" => "/catalog/products"));
            $this->addBread(array("label" => $this->trans($lang, "Productos", "Products"), "url" => "/catalog/products"));

            $sql = "SELECT * FROM product WHERE ur LIKE '$slug'";
            $query = $this->pdo->prepare($sql);
            $rs = $query->execute();
            if ($rs) {
                $product = $query->fetch();

                $t = $this->trans($lang, $product["tipo"], $product["_type"]);
                $g = $this->trans($lang, $product["categoria"], $product["_category"]);
                $u = $this->trans($lang, $product["nombre"], $product["_name"]);

                $this->addBread(array("label" => ucwords(strtolower($t)), "url" => "/catalog/" . strtolower($t)));
                $this->addBread(array("label" => ucwords(strtolower($g)), "url" => "/catalog/" . strtolower($t) . "/" . strtolower(str_replace(" ", "-", $g))));
                $this->addBread(array("label" => ucwords(strtolower($u))));

                $relacionados = $this->findRelated($product);

                if ($product["_match"] != "-") {
                    $match = $this->findMatch($product["_match"]);
                }



                $this->header($lang, $product[$this->trans($lang, "nombre", "_name")]." - ", false, $product);
                require $this->views . "detalle-producto.php";
            }
        }
        $this->footer($lang);
    }

    public function searchProductByName($lang = "es") {

        $this->addBread(array("label" => $this->trans($lang, "Buscador", "Search"), "url" => "/search"));

        $html = "";
        if (!empty($_POST)) {


            $sql = "SELECT * FROM product WHERE nombre LIKE :name OR _name LIKE :name";
            $query = $this->pdo->prepare($sql);
            $name = "%{$_POST["q"]}%";
            $query->bindParam(':name', $name, \PDO::PARAM_STR);
            $rs = $query->execute();
            $products = $query->fetchAll();
            $html .= '<div id="content-press">';
            foreach ($products as $product) {
                $product["imagen"] = $product["imagen"] != "-" ? "/images/product/" . $product["imagen"] : "http://placehold.it/200x200/f4f4f4/ccc?text=product";
                $html .= '
						<article class="item4Col">
					        <a href="' . $this->url($lang, "/product/" . $product['ur']) . '">
					        	<div class="imageHolder">
						            <img 
						            alt="' . $product["nombre"] . '" 
						            src="http://www.alfonsomarinaebanista.com/images/' . $product["ur"] . '/' . $product["ur"] . '_alta2.jpg">
						         </div>
					            <br class="clear">
					            <br class="clear">
					            <p>
					            ' . $product["nombre"] . '
					            </p>
					        </a>
					    </article>
						';
            }
            $html .= "</div>";
        } else {
            $html .= '
						<div id="content-press">
							<h3>Buscar Muebles</h3>
						</div>
					';
        }

        $this->header($lang);
        echo $html;
        $this->footer($lang);
    }

    public function searchProductByName_Json($lang = "es") {

        if (!empty($_POST)) {
            $table = "product";
            $database = "amarinados";

            $lastWhere = $this->describe($database, $table, $_POST["q"]);
            $where = substr($lastWhere, 0, -3);

            $sql = "SELECT nombre, ur FROM $table WHERE " . $where . " LIMIT 10";

            $query = $this->pdo->prepare($sql);

            $rs = $query->execute();
            $this->lang = $lang;
            $products = $query->fetchAll(\PDO::FETCH_ASSOC);
            $products = array_map(function($element) {
                $element["url"] = $this->url($this->lang, "/product/" . $element["ur"]);
                return $element;
            }, $products);
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($products);
        }
    }

}
