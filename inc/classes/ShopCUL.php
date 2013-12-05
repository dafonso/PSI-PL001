<?php 
class ShopCUL {
	/**
	 * @return ArrayObject<Category>
	 */
	public static function getCategories() {
		global $db;
		$categories = array();
		
		$categoriesData = $db->getCategories();
		foreach ($categoriesData as $categoryData) {
			array_push($categories, new Category($categoryData));
		}
		
		return $categories; 
	}
	
	public static function getCategoryById($id) {
		global $db;
		
		$categoryData = $db->getCategoryData($id);
		
		return new Category($categoryData);
	}
	
	/**
	 * @return ArrayObject<Category>
	 */
	public static function getProductsByCategory(Category $category) {
		global $db;
		
		$products = array();
	
		$productsData = $db->getProductsByCategory($category);
		
		foreach ($productsData as $productData) {
			array_push($products, new Product($productData));
		}
	
		return $products;
	}
	
	public static function getCustomerDataByUsername($username) {
		global $db;
		
		return $db->getCustomerByUsername($username);
	}
	
	public static function getCustomerDataByID($id) {
		global $db;
	
		return $db->getCustomer($id);
	}
	
	
	public static function getProduct($id) {
		global $db;
		
		$productData = $db->getProduct($id);

		return self::retrieveProductObj($productData);
	}
	
	public static function retrieveCostumerDataFromRequest() {
		$customerData = array();
		
		$customerData['EMAIL'] = (isset($customerData['EMAIL']) ? $_POST['inputEmail'] : null);
		$customerData['NIF'] = (isset($customerData['NIF']) ? $_POST['inputNIF'] : null);
		$customerData['PHONENR'] = (isset($customerData['PHONENR']) ? $_POST['inputMovel'] : null);
		$customerData['NAME'] = (isset($customerData['NAME']) ? $_POST['inputName'] : null);
		$customerData['USERNAME'] = (isset($customerData['USERNAME']) ? $_POST['inputUsername'] : null);
		$customerData['PASSWORD'] = (isset($customerData['PASSWORD']) ? $_POST['inputPaypalEmail'] : null);
		
		return $customerData;
	}
}
?>