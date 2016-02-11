<?php 

class AdminCatalog extends Controller
{	
	/**
	 * Show all categories of products 
	 * @param  string $lang language
	 */
	public function listCategoriesAction( $lang="es" ){
		
		$this->header_admin($lang);

		$queryCategory = $this->pdo->prepare("SELECT DISTINCT(categoria) FROM product WHERE categoria NOT LIKE '%\,%';");
		$queryType = $this->pdo->prepare("SELECT DISTINCT(tipo) FROM product;");
		$queryUse = $this->pdo->prepare("SELECT DISTINCT(uso) FROM product WHERE uso NOT LIKE '%\,%';");
		
		$rsCategory = $queryCategory->execute();
		$rsType 	= $queryType->execute();
		$rsUse 		= $queryUse->execute();
		
		$categories = $queryCategory->fetchAll(\PDO::FETCH_ASSOC);
		$types		= $queryType->fetchAll(\PDO::FETCH_ASSOC);
		$uses		= $queryUse->fetchAll(\PDO::FETCH_ASSOC);
		
		require $this->adminviews."list-categories.php";
		$this->footer_admin($lang);
	}

	public function listRelatedProductAction( $lang="es", $category, $name ){

		$name = str_replace("-" , " " , $name );

		$this->header_admin($lang);
		$sql = "";
		if( $category == "category"){
			
			$sql = "SELECT * FROM product WHERE categoria LIKE '$name';";
		}elseif( $category == "type"){
			
			$sql = "SELECT * FROM product WHERE tipo LIKE '$name';";
		}elseif( $category == "use"){
			
			$sql = "SELECT * FROM product WHERE uso LIKE '$name';";
		}

		$query = $this->pdo->prepare($sql);
		$rs = $query->execute();
		$products = $query->fetchAll(\PDO::FETCH_ASSOC);


		require $this->adminviews."category-product.php";
		$this->footer_admin($lang);
	}
}