<?php 
class ShopCUL {
	/**
	 * @return ArrayObject<Category>
	 */
	public function getCategories() {
		global $db;
		$categories = array();
		
		$categoriesData = $db->getCategories();
		foreach ($categoriesData as $categoryData) {
			$category = new Category();
			
			$category->setId($categoryData['CATEGORY_ID']);
			$category->setName($categoryData['NAME']);
			
			array_push($categories, $category);
			
			unset($category);
		}
		
		return $categories; 
	}
	
	/**
	 * @return ArrayObject<Category>
	 */
	public function getProductsByCategory(Category $category) {
		global $db;
		$products = array();
	
		$productsData = $db->getProductsByCategory($category);
		
		foreach ($productsData as $productData) {
			$product = new Product();
				
			$product->setId($productData['PRODUCT_ID']);
			$product->setBuyprice($productData['BUYPRICE']);
			$product->setSellprice($productData['SELLPRICE']);
			$product->setCode($productData['CODE']);
			$product->setDescription($productData['DESCRIPTION']);
			$product->setShowdate($productData['SHOWDATE']);
			$product->setStarttime($productData['STARTTIME']);
			$product->setEndtime($productData['ENDTIME']);
			$product->setName($productData['NAME']);
			
			array_push($products, $product);
				
			unset($product);
		}
	
		return $products;
	}
}
?>