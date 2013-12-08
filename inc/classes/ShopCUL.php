<?php 
/**
 * @author psi-pl001
 *
 */
class ShopCUL {
	/**
	 * @return array Category
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

		return new Category($db->getCategory($id));
	}
	
	/**
	 * @return array Product
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
	
	public static function getAddressByCustomer(Customer $customer) {
		global $db;
		
		$customerAddress = new CustomerAddress($db->getCustomerAddress($customer));
		
		return new Address($db->getAddress($customerAddress->getAddress()));
	}
	
	public static function getPayOptionByCustomer(Customer $customer) {
		global $db;
		
		return new PayOption($db->getPayOption($customer));
	}
	
	/**
	 * 
	 * @param string $username
	 * @return Customer
	 */
	public static function getCustomerByUsername($username) {
		global $db;
		
		$customer = new Customer($db->getCustomerByUsername($username));
		
		return $customer;
	}
	
	/**
	 *
	 * @param string $id
	 * @return Customer
	 */
	public static function getCustomerByID($id) {
		global $db;
		
		$customer = new Customer($db->getCustomer($id));
	
		return $customer;
	}
	
	
	public static function getProductByID($id) {
		global $db;
		
		$product = new Product($db->getProduct($id));

		return $product;
	}
	
	public static function getTransactionsByCustomer(Customer $customer) {
		global $db;
		
		$transactions = array();
		
		$transactionsData = $db->getTransactionsByCustomer($customer);
		
		foreach($transactionsData as $transactionData) {
			array_push($transactions, new Transaction($transactionData));
		}
		
		return $transactions;
	}
	
	public static function retrieveCostumerDataFromRequest() {
		$customerData = array();
		
		$customerData['CUSTOMER_ID'] = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);
		$customerData['EMAIL'] = (isset($_POST['inputEmail']) ? $_POST['inputEmail'] : null);
		$customerData['NIF'] = (isset($_POST['inputNIF']) ? $_POST['inputNIF'] : null);
		$customerData['PHONENR'] = (isset($_POST['inputMovel']) ? $_POST['inputMovel'] : null);
		$customerData['NAME'] = (isset($_POST['inputName']) ? $_POST['inputName'] : null);
		$customerData['USERNAME'] = (isset($_POST['inputUsername']) ? $_POST['inputUsername'] : null);
		$customerData['PASSWORD'] = (isset($_POST['inputPaypalEmail']) ? $_POST['inputPaypalEmail'] : null);
		$customerData['PAYPAL'] = (isset($_POST['inputNewPassword']) ? $_POST['inputNewPassword'] : null);
		
		return $customerData;
	}
	
	public static function createTransaction(Customer $customer, Product $product) {
		global $db;
		
		$transaction = new Transaction();
		$transactionLine = new TransactionLine();
		
		$transactionLine->setProduct($product);
		$transactionLine->setQuantity($_POST['inputQuantity']);
		$transactionLine->setPriceperunit($product->getSellprice());
		
		$transaction->setTransactionLines(array($transactionLine));
		
		$transaction_id = $db->insertTransaction($transaction, $customer);
		
		$transaction->setId($transaction_id);
		
		foreach($transaction->getTransactionLines() as $transactionLine) {
			$db->insertTransactionLine($transactionLine, $transaction);
		}
		
		return is_numeric($transaction_id); 
	}
}
?>