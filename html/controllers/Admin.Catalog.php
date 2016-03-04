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

    public function addAction($lang = "es") {

        $this->header_admin($lang);
        require $this->adminviews . "add-product.php";
        $this->footer_admin($lang);
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
