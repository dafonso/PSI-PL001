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
	
	/**
	 * @param unknown_type $id
	 * @return Category
	 */
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
	
	/**
	 * @param Customer $customer
	 * @return Address
	 */
	public static function getAddressByCustomer(Customer $customer) {
		global $db;
		
		$customerAddress = new CustomerAddress($db->getCustomerAddress($customer));
		
		return new Address($db->getAddress($customerAddress->getAddress()));
	}
	
	/**
	 * @param Customer $customer
	 * @return PayOption
	 */
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
	 * @param string $username
	 * @return SystemUser
	 */
	public static function getSystemUserByUsername($username) {
		global $db;
		
		$systemUser = new SystemUser($db->getSystemUserByUsername($username));
	
		return $systemUser;
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
	
	/**
	 *
	 * @param string $id
	 * @return Customer
	 */
	public static function getSystemUserByID($id) {
		global $db;
	
		$systemUser = new SystemUser($db->getSystemUser($id));
	
		return $systemUser;
	}
	
	/**
	 *
	 * @param string $id
	 * @return Customer
	 */
	public static function getCustomerByNIF($id) {
		global $db;
	
		$customer = new Customer($db->getCustomerByNIF($id));
	
		return $customer;
	}
	
	
	/**
	 * @param unknown_type $id
	 * @return Product
	 */
	public static function getProductByID($id) {
		global $db;
		
		$product = new Product($db->getProduct($id));

		return $product;
	}
	
	/**
	 * @param Customer $customer
	 * @return multitype:
	 */
	public static function getTransactionsByCustomer(Customer $customer) {
		global $db;
		
		$transactions = array();
		
		$transactionsData = $db->getTransactionsByCustomer($customer);
		
		foreach($transactionsData as $transactionData) {
			array_push($transactions, new Transaction($transactionData));
		}
		
		return $transactions;
	}
	
	/**
	 * @return multitype:Ambigous <NULL, unknown> 
	 */
	public static function retrieveCustomerDataFromRequest() {
		$customerData = array();
		
		$customerData['CUSTOMER_ID'] = (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);
		$customerData['EMAIL'] = (isset($_POST['inputEmail']) ? $_POST['inputEmail'] : null);
		$customerData['NIF'] = (isset($_POST['inputNIF']) ? $_POST['inputNIF'] : null);
		$customerData['PHONENR'] = (isset($_POST['inputMovel']) ? $_POST['inputMovel'] : null);
		$customerData['NAME'] = (isset($_POST['inputName']) ? $_POST['inputName'] : null);
		$customerData['USERNAME'] = (isset($_POST['inputUsername']) ? $_POST['inputUsername'] : null);
		$customerData['PASSWORD'] = (isset($_POST['inputNewPassword']) ? $_POST['inputNewPassword'] : null);
		$customerData['PAYPAL'] = (isset($_POST['inputPaypalEmail']) ? $_POST['inputPaypalEmail'] : null);
		
		return $customerData;
	}
	
	/**
	 * @return unknown
	 */
	public static function retrieveAddressDataFromRequest() {
		$addressData = array();
	    
		$addressData['ADDRESS_ID'] = (isset($_POST['inputAddressId']) ? $_POST['inputAddressId'] : null);
		$addressData['CITY'] = (isset($_POST['inputCity']) ? $_POST['inputCity'] : null);
		$addressData['POSTALCODE'] = (isset($_POST['inputZipcode1']) ? $_POST['inputZipcode1'] : null);
		$addressData['STREET'] = (isset($_POST['inputAddress']) ? $_POST['inputAddress'] : null);
	
		return $addressData;
	}
	
	/**
	 * 
	 */
	public static function retrievePayOptionDataFromRequest() {
		$payoptionData = array();
	    
		$payoptionData['PAYOPTION_ID'] = (isset($_POST['inputPayoptionId']) ? $_POST['inputPayoptionId'] : null);
		$payoptionData['CARDNR'] = (isset($_POST['inputCardNumber']) ? $_POST['inputCardNumber'] : null);
		$payoptionData['EXPIRYDATE'] = (isset($_POST['inputExpiryDate']) ? $_POST['inputExpiryDate'] : null);
		$payoptionData['SECURITYCODE'] = (isset($_POST['inputCS']) ? $_POST['inputCS'] : null);
		$payoptionData['NAME'] = 'Default';
	
		return $payoptionData;
	}
	
	/**
	 * 
	 * @param Customer $customer
	 * @param Product $product
	 */
	public static function createTransaction(Customer $customer, Product $product) {
		global $db;
		
		if(is_null($customer->getId())) {
			$casualCustomer = new Customer(self::retrieveCustomerDataFromRequest());
			
			$customerByNIF = ShopCUL::getCustomerByNIF($casualCustomer->getNif());
			
			if(is_null($customerByNIF->getId())) {
				$customer = ShopCUL::createCustomer(true);
			} else {
				$customer = $customerByNIF;
			}
		}
		
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
	
	/**
	 * 
	 * @param boolean $casualCustomer
	 */
	public static function createCustomer($casualCustomer = false) {
		global $db;
		
		$customer = new Customer(self::retrieveCustomerDataFromRequest());
		
		if(!$casualCustomer) {
			$customer_password = substr(sha1(time().'PSIPL001'.rand(0, 6)), 0, 8);
			$customer_password = 'psipl';
			
			$customer->setPassword(sha1($customer_password));
						
			$message = "A sua palavra-passe é: $customer_password\r\n\r\nShopCUL";
			
			@mail($_POST['inputEmail'], 'ShopCUL: A sua password', $message);
			
			if(is_numeric($customer->getPhonenr())) {
				sendSMS($customer->getPhonenr(), "A sua password: $customer_password");
			}
		}
		
		$customer_id = $db->insertCustomer($customer);
		$customer->setId($customer_id);
		
		if (isset($_POST['inputAddress']) && !empty($_POST['inputAddress'])) {
			$address = new Address(self::retrieveAddressDataFromRequest());
		
			$address->setCountry(new Country(1));
			$address->setType(new AddressType(1));
		
			$address_id = $db->insertAddress($address);
			$address->setId($address_id);
		
			$customer->setAddresses($address);

			$customerAddress = new CustomerAddress(array('CUSTOMER_CUSTOMER_ID' => $customer->getId(), 'ADDRESS_ADDRESS_ID' => $address->getId()));
			$db->insertCustomerAddress($customerAddress);
		
		}
		
		if (isset($_POST['inputCardNumber']) && is_numeric($_POST['inputCardNumber'])) {
			$payoption = new PayOption(self::retrievePayOptionDataFromRequest());
			
			$payoption->setCustomer($customer);
		
			$payoption_id = $db->insertPayOption($payoption);
			$payoption->setId($payoption_id);
			
			$customer->setPayoption($payoption);
		}
		
		return $customer;
	}
	
	public function updateCustomer() {
		global $db;
		
		$customer = self::getCustomerByID($_SESSION['user_id']);
		
		$updatedCustomer = new Customer(self::retrieveCustomerDataFromRequest());
		$updatedCustomer->setUsername($customer->getUsername());

		
		if(!empty($_POST['inputNewPassword']) && $_POST['inputNewPassword'] == $_POST['inputConfirmPassword']) {
			$updatedCustomer->setPassword(sha1($_POST['inputNewPassword']));			
		} else {
			$updatedCustomer->setPassword($customer->getPassword());
		}
		
		$db->updateCustomer($updatedCustomer);
		
		$updatedAddress = new Address(self::retrieveAddressDataFromRequest());
		$updatedAddress->setId($customer->getAddresses()->getId());
		$updatedAddress->setCountry(new Country(1));
		$updatedAddress->setType(new AddressType(1));
	
		if(is_null($updatedAddress->getId())) {
			$address_id = $db->insertAddress($updatedAddress);
			$updatedAddress->setId($address_id);
			
			$customer->setAddresses($updatedAddress);
			
			$customerAddress = new CustomerAddress(array('CUSTOMER_CUSTOMER_ID' => $customer->getId(), 'ADDRESS_ADDRESS_ID' => $updatedAddress->getId()));
			$db->insertCustomerAddress($customerAddress);
		} else {
			$db->updateAddress($updatedAddress);
		}
		
		$updatedPayOption = new PayOption(self::retrievePayOptionDataFromRequest());
		$updatedPayOption->setCustomer($customer);
		$updatedPayOption->setId($customer->getPayoption()->getId());
		
		if(is_null($updatedPayOption->getId())) {
			$db->insertPayOption($updatedPayOption);
		} else {
			$db->updatePayOption($updatedPayOption);
		}
	}
}
?>