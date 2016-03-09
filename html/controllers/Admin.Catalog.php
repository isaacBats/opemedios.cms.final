<?php

class AdminCatalog extends Controller {

    /**
     * Show all categories of products 
     * @param  string $lang language
     */
    public function listCategoriesAction($lang = "es") {

        $this->header_admin($lang);

        $queryCategory = $this->pdo->prepare("SELECT * FROM categories_products;");
        $queryType = $this->pdo->prepare("SELECT DISTINCT(tipo) FROM product;");
        $queryUse = $this->pdo->prepare("SELECT DISTINCT(uso) FROM product WHERE uso NOT LIKE '%\,%';");

        $rsCategory = $queryCategory->execute();
        $rsType = $queryType->execute();
        $rsUse = $queryUse->execute();

        $categories = $queryCategory->fetchAll(\PDO::FETCH_ASSOC);
        $types = $queryType->fetchAll(\PDO::FETCH_ASSOC);
        $uses = $queryUse->fetchAll(\PDO::FETCH_ASSOC);

        require $this->adminviews . "list-categories.php";
        $this->footer_admin($lang);
    }

    /**
     * Show all products in the Panel
     * @return A view
     */
    public function showAction(){
        
        $this->header_admin();

        $query = $this->pdo->prepare("SELECT id, ur, nombre, _name, imagen FROM product;");
        $rs = $query->execute();
        $numProducts = $query->rowCount();
        if($rs != false){
            $products = $query->fetchAll(\PDO::FETCH_ASSOC);
            require $this->adminviews . "list-products.php";            
        }
        $this->footer_admin();        
    }

    /**
     * Show a form add new product
     * return a view fo form 
     */
    public function addAction() {

        $this->header_admin();
        require $this->adminviews . "add-product.php";
        $this->footer_admin();
    }

    /**
     * Create a new directory in asset/images/products 
     * @param  String $name Name of directory
     * @return boolean       Return TRUE if a directory exist or this created
     */
    private function newDirectory($name){
        if(!empty($name)){
            if(file_exists(__DIR__."/../assets/images/products/".$name)){
                return true;
            }else{
                $pathname = __DIR__."/../assets/images/products/".$name;
                if(!mkdir($pathname, 0777)){
                    die('Fallo al crear las carpetas...');
                    return false;
                }else{
                    return true;
                }
            }
        }
    }

    /**
     * Insert a new product in the Data Base
     */
    public function save(){

        if(isset($_POST) && !empty($_POST)){
            if( $this->newDirectory($_POST['ur']) ){
                $extensiones_permitidas = array("jpg", "jpeg", "gif", "png","JPG","JPEG","PNG");
                $explode = explode(".", $_FILES['imagen']["name"]);
                $extension = end($explode);
                if ((($_FILES['imagen']["type"] == "image/png")
                    || ($_FILES['imagen']["type"] == "image/jpeg")
                    || ($_FILES['imagen']["type"] == "image/jpg")
                    || ($_FILES['imagen']["type"] == "image/PNG"))
                    && in_array($extension, $extensiones_permitidas))
                {
                    if ($_FILES['imagen']["error"] > 0)
                    {
                        echo "ERROR: " . $_FILES['imagen']["error"] . "<br>";
                    }
                    else
                    {
                        $path=__DIR__."/../assets/images/products/".$_POST['ur']."/". $_FILES['imagen']["name"];
                        $move = move_uploaded_file($_FILES['imagen']["tmp_name"],$path);

                        if(!$move){
                            throw new Exception("Error al mover el archivo", 1);
                        }
                    }
                }

                $sql = "INSERT INTO product (ur, nombre, _name, caracter, _character, acabado, tipo_acabado, como_se_muestra, current_finish, precio, familia, original, created, _match, _price, precio_pintado, price_painted, tipo, _type, categoria, _category, uso, _use, frente, fondo, altura, diametro, frentre_plg, fondo_plg, altura_plg, diametro_plg, imagen)
                                    VALUES (:ur, :nombre, :name, :caracter, :character, :acabado, :tipoAcabado, :comoSeMuestra, :currentFinish, :precio, :familia, :original, :created, :match, :price, :precioPintado, :pricePainted, :tipo, :type, :categoria, :category, :uso, :use, :frente, :fondo, :altura, :diametro, :frentePlg, :fondoPlg, :alturaPlg, :diametroPlg, :imagen);";
                
                $query = $this->pdo->prepare($sql);
                
                $query->bindParam(':ur', $_POST['ur'], \PDO::PARAM_STR);
                $query->bindParam(':nombre', $_POST['nombre'], \PDO::PARAM_STR);
                $query->bindParam(':name', $_POST['name'], \PDO::PARAM_STR);
                $query->bindParam(':caracter', $_POST['caracter'], \PDO::PARAM_STR);
                $query->bindParam(':character', $_POST['character'], \PDO::PARAM_STR);
                $query->bindParam(':acabado', $_POST['acabado'], \PDO::PARAM_STR);
                $query->bindParam(':tipoAcabado', $_POST['tipoAcabado'], \PDO::PARAM_STR);
                $query->bindParam(':comoSeMuestra', $_POST['comoSeMuestra'], \PDO::PARAM_STR);
                $query->bindParam(':currentFinish', $_POST['currentFinish'], \PDO::PARAM_STR);
                $query->bindParam(':precio', $_POST['precio'], \PDO::PARAM_STR);
                $query->bindParam(':familia', $_POST['familia'], \PDO::PARAM_STR);
                $query->bindParam(':original', $_POST['original'], \PDO::PARAM_STR);
                $query->bindParam(':created', $_POST['created'], \PDO::PARAM_STR);
                $query->bindParam(':match', $_POST['match'], \PDO::PARAM_STR);
                $query->bindParam(':price', $_POST['price'], \PDO::PARAM_STR);
                $query->bindParam(':precioPintado', $_POST['precioPintado'], \PDO::PARAM_STR);
                $query->bindParam(':pricePainted', $_POST['pricePainted'], \PDO::PARAM_STR);
                $query->bindParam(':tipo', $_POST['tipo'], \PDO::PARAM_STR);
                $query->bindParam(':type', $_POST['type'], \PDO::PARAM_STR);
                $query->bindParam(':categoria', $_POST['categoria'], \PDO::PARAM_STR);
                $query->bindParam(':category', $_POST['category'], \PDO::PARAM_STR);
                $query->bindParam(':uso', $_POST['uso'], \PDO::PARAM_STR);
                $query->bindParam(':use', $_POST['use'], \PDO::PARAM_STR);
                $query->bindParam(':frente', $_POST['frente'], \PDO::PARAM_STR);
                $query->bindParam(':fondo', $_POST['fondo'], \PDO::PARAM_STR);
                $query->bindParam(':altura', $_POST['altura'], \PDO::PARAM_STR);
                $query->bindParam(':diametro', $_POST['diametro'], \PDO::PARAM_STR);
                $query->bindParam(':frentePlg', $_POST['frentePLG'], \PDO::PARAM_STR);
                $query->bindParam(':fondoPlg', $_POST['fondoPLG'], \PDO::PARAM_STR);
                $query->bindParam(':alturaPlg', $_POST['alturaPLG'], \PDO::PARAM_STR);
                $query->bindParam(':diametroPlg', $_POST['diametroPLG'], \PDO::PARAM_STR);
                if(isset($_FILES) && $_FILES['imagen']['name'] != ""){
                    $query->bindParam(':imagen', $_FILES['imagen']['name'], \PDO::PARAM_STR);                
                }else{
                    $image = 'default2.jpg';
                    $query->bindParam(':imagen', $image, \PDO::PARAM_STR);
                }

                $newProduct = $query->execute();
                if($newProduct != false){
                    header("Location: /panel/catalog/list");
                }
            }
        }
    }

    /**
     * Show the form for editing a product
     * @param  string $lang The language
     * @param  int $id   Identifier the product
     * @return A View
     */
    public function editProductAction($lang = "es", $id){
        $this->header_admin( $lang );

        $query = $this->pdo->prepare("SELECT * FROM product WHERE id = :id");
        $query->bindParam(":id", $id, \PDO::PARAM_INT);
        

        if( $query->execute() ){
            $row = $query->fetch(\PDO::FETCH_ASSOC);
            require $this->adminviews . "edit-product.php";
        }

        $this->footer_admin( $lang );
    }

    /**
     * Update a product of Catalog
     * @return true an return a View list if product is updated
     */
    public function update(){

        if( !empty($_POST) ){
            if( $this->newDirectory($_POST['ur']) ){
                if( $_FILES['imagen']['name'] != "" ){
                    $extensiones_permitidas = array("jpg", "jpeg", "gif", "png","JPG","JPEG","PNG");
                    $explode = explode(".", $_FILES['imagen']["name"]);
                    $extension = end($explode);
                    if ((($_FILES['imagen']["type"] == "image/png")
                        || ($_FILES['imagen']["type"] == "image/jpeg")
                        || ($_FILES['imagen']["type"] == "image/jpg")
                        || ($_FILES['imagen']["type"] == "image/PNG"))
                        && in_array($extension, $extensiones_permitidas))
                    {
                        if ($_FILES['imagen']["error"] > 0)
                        {
                            echo "ERROR: " . $_FILES['imagen']["error"] . "<br>";
                        }
                        else
                        {
                            $path=__DIR__."/../assets/images/products/".$_POST['ur']."/". $_FILES['imagen']["name"];
                            $move = move_uploaded_file($_FILES['imagen']["tmp_name"],$path);

                            if(!$move){
                                throw new Exception("Error al mover el archivo", 1);
                            }
                        }
                    }

                    $_POST['imagen'] = $_FILES['imagen']['name'];
                    if( !$this->put($_POST) ){
                        echo "Error al actualizar el producto";
                    }else{
                        header("Location: /panel/catalog/list");
                    }        

                }else{
                    if( !$this->put($_POST) ){
                        echo "Error al actualizar el producto";
                    }else{
                        header("Location: /panel/catalog/list");
                    }
                }
            }
        }
    }

    /**
     * Update in data base a product
     * @param  array  $product Data of product
     * @return Boolean          If product is updated
     */
    private function put($product = []){

        $sql = "UPDATE product SET  ur                  = :ur,
                                    nombre              = :nombre,
                                    _name               = :_name,
                                    caracter            = :caracter,
                                    _character          = :_character,
                                    acabado             = :acabado,
                                    tipo_acabado        = :tipo_acabado,
                                    como_se_muestra     = :como_se_muestra,
                                    current_finish      = :current_finish,
                                    precio              = :precio,
                                    familia             = :familia,
                                    original            = :original,
                                    created             = :created,
                                    _match              = :_match,
                                    _price              = :_price,
                                    precio_pintado      = :precio_pintado,
                                    price_painted       = :price_painted,
                                    tipo                = :tipo,
                                    _type               = :_type,
                                    categoria           = :categoria,
                                    _category           = :_category,
                                    uso                 = :uso,
                                    _use                = :_use,
                                    frente              = :frente,
                                    fondo               = :fondo,
                                    altura              = :altura,
                                    diametro            = :diametro,
                                    frentre_plg         = :frente_plg,
                                    fondo_plg           = :fondo_plg,
                                    altura_plg          = :altura_plg,
                                    diametro_plg        = :diametro_plg,
                                    imagen              = :imagen
                            WHERE   id                  = :id
                            LIMIT 1;
        ";

        $query = $this->pdo->prepare($sql);

        $query->bindParam(':ur', $product['ur'], \PDO::PARAM_STR);
        $query->bindParam(':nombre', $product['nombre'], \PDO::PARAM_STR);
        $query->bindParam(':_name', $product['name'], \PDO::PARAM_STR);
        $query->bindParam(':caracter', $product['caracter'], \PDO::PARAM_STR);
        $query->bindParam(':_character', $product['character'], \PDO::PARAM_STR);
        $query->bindParam(':acabado', $product['acabado'], \PDO::PARAM_STR);
        $query->bindParam(':tipo_acabado', $product['tipoAcabado'], \PDO::PARAM_STR);
        $query->bindParam(':como_se_muestra', $product['comoSeMuestra'], \PDO::PARAM_STR);
        $query->bindParam(':current_finish', $product['currentFinish'], \PDO::PARAM_STR);
        $query->bindParam(':precio', $product['precio'], \PDO::PARAM_STR);
        $query->bindParam(':familia', $product['familia'], \PDO::PARAM_STR);
        $query->bindParam(':original', $product['original'], \PDO::PARAM_STR);
        $query->bindParam(':created', $product['created'], \PDO::PARAM_STR);
        $query->bindParam(':_match', $product['match'], \PDO::PARAM_STR);
        $query->bindParam(':_price', $product['price'], \PDO::PARAM_STR);
        $query->bindParam(':precio_pintado', $product['precioPintado'], \PDO::PARAM_STR);
        $query->bindParam(':price_painted', $product['pricePainted'], \PDO::PARAM_STR);
        $query->bindParam(':tipo', $product['tipo'], \PDO::PARAM_STR);
        $query->bindParam(':_type', $product['type'], \PDO::PARAM_STR);
        $query->bindParam(':categoria', $product['categoria'], \PDO::PARAM_STR);
        $query->bindParam(':_category', $product['category'], \PDO::PARAM_STR);
        $query->bindParam(':uso', $product['uso'], \PDO::PARAM_STR);
        $query->bindParam(':_use', $product['use'], \PDO::PARAM_STR);
        $query->bindParam(':frente', $product['frente'], \PDO::PARAM_STR);
        $query->bindParam(':fondo', $product['fondo'], \PDO::PARAM_STR);
        $query->bindParam(':altura', $product['altura'], \PDO::PARAM_STR);
        $query->bindParam(':diametro', $product['diametro'], \PDO::PARAM_STR);
        $query->bindParam(':frente_plg', $product['frentePLG'], \PDO::PARAM_STR);
        $query->bindParam(':fondo_plg', $product['fondoPLG'], \PDO::PARAM_STR);
        $query->bindParam(':altura_plg', $product['alturaPLG'], \PDO::PARAM_STR);
        $query->bindParam(':diametro_plg', $product['diametroPLG'], \PDO::PARAM_STR);
        $query->bindParam(':imagen', $product['imagen'], \PDO::PARAM_STR); 
        $query->bindParam(':id', $product['id'], \PDO::PARAM_INT); 

        return $query->execute();

    }

    public function detailProductAction( $lang = "es", $id){

        $this->header_admin();

        $query = $this->pdo->prepare( "SELECT * FROM product WHERE id = $id;" );

        if($query->execute()){
            $product = $query->fetch(\PDO::FETCH_ASSOC);
            require $this->adminviews . "view-product.php";
        }

        $this->footer_admin();
    }

    public function remove($lang="es"){

        if( !empty($_POST) ){
            $resultado = new stdClass();
            $sql = "DELETE FROM product WHERE id = :id";
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id', $_POST['id_borrar'], \PDO::PARAM_INT);
            $rs = $query->execute();
            $resultado->mensaje = $rs;
            if($rs!=false){
                $resultado->exito = true;
            }
            else{
                $resultado->exito = false;
            }
            header('Content-type: text/json');
            echo json_encode($resultado); 
        }
    }



    public function listRelatedProductAction($lang = "es", $category, $name) {

        $name = str_replace("-", " ", $name);

        $this->header_admin($lang);
        $sql = "";
        if ($category == "category") {

            $sql = "SELECT * FROM product WHERE categoria LIKE '$name';";
        } elseif ($category == "type") {

            $sql = "SELECT * FROM product WHERE tipo LIKE '$name';";
        } elseif ($category == "use") {

            $sql = "SELECT * FROM product WHERE uso LIKE '$name';";
        }


        $query = $this->pdo->prepare($sql);
        $rs = $query->execute();
        $products = $query->fetchAll(\PDO::FETCH_ASSOC);

        $sql = 'select * from categories_products WHERE category=:category';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':category', $name);
        $rs = $query->execute();
        $mainproductcat = $query->fetch(\PDO::FETCH_ASSOC);

        $main_product_id = ($mainproductcat['product_id'] != null) ? $mainproductcat['product_id'] : 0;


        require $this->adminviews . "category-product.php";
        $this->footer_admin($lang);
    }

    public function mainProductByCat($lang = "es") {
        if (!empty($_POST)) {

            $datos = explode("_", $_POST["id"]);
            $sql = 'select * from categories_products WHERE category=:category';
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':category', $datos[0]);
            $rs = $query->execute();
            if ($query->rowCount() == 1) {
                $sql = 'update   categories_products set product_id =:product_id  WHERE category=:category';
                $query = $this->pdo->prepare($sql);
                $query->bindParam(':product_id', $datos[1]);
                $query->bindParam(':category', $datos[0]);
                $rs = $query->execute();
            } else {
                $sql = 'INSERT  into categories_products (product_id,category) VALUES (:product_id,:category)';
                $query = $this->pdo->prepare($sql);
                $query->bindParam(':product_id', $datos[1]);
                $query->bindParam(':category', $datos[0]);
                $rs = $query->execute();
            }
        }
    }

}
