<?php 
/**
 * @author http://www.urbandictionary.com/define.php?term=kk
 *
 */
class OCI_DB {
	private $db;
	private $username = 'psi001pl';
	private $password = 'Ps1PL001';
	private $connString = ORACLE_CONN_STRING;
	
	public function __construct() {
		$this->db = oci_connect($this->username, $this->password, $this->connString, "utf8") or die("Erro na ligação à BD!");
	}
	
	public function close() {
		oci_close($this->db);
	}
	
	public function rollback() {
		oci_rollback($this->db);
	}
	
	public function commit() {
		oci_commit($this->db);
	}
	
	public function error() {
		return oci_error();
	}
	
	public function insertCustomer(Customer $customer) {
		$id = null;
		
		$insertCustomerSQL = "INSERT INTO CUSTOMER 
				(
				  CUSTOMER_ID ,
			      NAME ,
			      PHONENR ,
			      EMAIL ,
			      PAYPAL ,
			      USERNAME ,
			      PASSWORD ,
			      NIF
    			)
    			VALUES 
    			(
    			  CUSTOMER_CUSTOMER_ID_SEQ.NEXTVAL ,
			      :p_NAME ,
			      :p_PHONENR ,
			      :p_EMAIL ,
			      :p_PAYPAL ,
			      :p_USERNAME ,
			      :p_PASSWORD ,
			      :p_NIF
    			)
				RETURNING CUSTOMER_ID INTO :p_CUSTOMER_ID";
		$customerStmt = oci_parse($this->db, $insertCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_NAME" , $customer->getName());
		oci_bind_by_name($customerStmt, ":p_PHONENR" , $customer->getPhonenr());
		oci_bind_by_name($customerStmt, ":p_EMAIL" , $customer->getEmail());
		oci_bind_by_name($customerStmt, ":p_PAYPAL" , $customer->getPaypal());
		oci_bind_by_name($customerStmt, ":p_USERNAME" , $customer->getUsername());
		oci_bind_by_name($customerStmt, ":p_PASSWORD" , $customer->getPassword());
		oci_bind_by_name($customerStmt, ":p_NIF", $customer->getNif());
		oci_bind_by_name($customerStmt, ":p_CUSTOMER_ID", $id);
		
		$res = oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
			
		return $id;
	}
	
	public function updateCustomer(Customer $customer) {
		$updateCustomerSQL = "UPDATE CUSTOMER SET 
						NAME = VALUES(:p_NAME),
						PHONNR = VALUES(:p_PHONNR),
						EMAIL = VALUES(:p_EMAIL),
						PAYPAL = VALUES(:p_PAYPAL),
						USERNAME = VALUES(:p_USERNAME),
						PASSWORD = VALUES(:p_PASSWORD),
						NIF = VALUES(:p_NIF) 
						WHERE CUSTOMER_ID = :p_CUSTOMER_ID";
		$customerStmt = oci_parse($this->db, $updateCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_NAME", $customer->getName());
		oci_bind_by_name($customerStmt, ":p_PHONNR", $customer->getPhonenr());
		oci_bind_by_name($customerStmt, ":p_EMAIL", $customer->getEmail());
		oci_bind_by_name($customerStmt, ":p_PAYPAL", $customer->getPaypal());
		oci_bind_by_name($customerStmt, ":p_USERNAME", $customer->getUsername());
		oci_bind_by_name($customerStmt, ":p_PASSWORD", $customer->getPassword());
		oci_bind_by_name($customerStmt, ":p_NIF", $customer->getNif());
		oci_bind_by_name($customerStmt, ":p_CUSTOMER_ID", $customer->getId());
		
		return oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
	}
	
	public function deleteCustomer(Customer $customer) {
		$deleteCustomerSQL = "DELETE FROM CUSTOMER WHERE CUSTOMER_ID = :p_CUSTOMER_ID";
		
		$customerStmt = oci_parse($this->db, $deleteCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_CUSTOMER_ID", $customer->getCustomer()->getId());
		
		return oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
	}
	
	public function getCustomer($id) {
		$result = null;
		
		$selectCustomerSQL = "SELECT * FROM CUSTOMER WHERE CUSTOMER_ID = :p_CUSTOMER_ID";
		$customerStmt = oci_parse($this->db, $selectCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_CUSTOMER_ID" , $id);
		
		oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
		
		$result = oci_fetch_assoc($customerStmt);
		
		return $result;
	}
	
	
	public function getCustomerByUsername($username) {
		$result = null;
		
		$selectCustomerSQL = "SELECT * FROM CUSTOMER WHERE USERNAME = :p_USERNAME";
		$customerStmt = oci_parse($this->db, $selectCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_USERNAME" , $username);
		
		oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
		
		$result = oci_fetch_assoc($customerStmt);
		
		return $result == false ? null : $result ;	
	}
	
	/**
	 * 
	 * @param Address $address
	 */
	public function insertAddress(Address $address) {
		$id = null;
		
		$insertAddressSQL = "INSERT INTO ADDRESS
					    (
					      ADDRESSTYPE_ADDRESSTYPE_ID ,
					      ADDRESS_ID ,
					      POSTALCODE ,
					      COUNTRY_COUNTRY_ID ,
					      CITY ,
					      STREET
					    )
					    VALUES
					    (
					      :p_ADDRESSTYPE_ADDRESSTYPE_ID ,
					      ADDRESS_ADDRESS_ID_SEQ.NEXTVAL ,
					      :p_POSTALCODE ,
					      :p_COUNTRY_COUNTRY_ID ,
					      :p_CITY ,
					      :p_STREET
					    )
						RETURNING ADDRESS_ID INTO :p_ADDRESS_ID";
		$addressStmt = oci_parse($this->db, $insertAddressSQL);
		
		oci_bind_by_name($addressStmt, ":p_ADDRESSTYPE_ADDRESSTYPE_ID" , $address->getType()->getId());
		oci_bind_by_name($addressStmt, ":p_POSTALCODE" , $address->getPostalcode());
		oci_bind_by_name($addressStmt, ":p_COUNTRY_COUNTRY_ID" , $address->getCountry()->getId());
		oci_bind_by_name($addressStmt, ":p_CITY" , $address->getCity());
		oci_bind_by_name($addressStmt, ":p_STREET", $address->getStreet());
		oci_bind_by_name($addressStmt, ":p_ADDRESS_ID", $id);
		
		$res = oci_execute($addressStmt, OCI_COMMIT_ON_SUCCESS);
		
		return $id;
		
	}
	
	public function updateAddress(Address $address) {
		
	}
	
	public function deleteAddress(Address $address) {
		
	}
	
	public function getAddress($id) {
		$selectAddressSQL = "SELECT * FROM ADDRESS WHERE ADDRESS_ID = :p_ADDRESS_ID";
		
		$addressStmt = oci_parse($this->db, $selectAddressSQL);
		
		oci_bind_by_name($addressStmt, ":p_ADDRESS_ID", $id);
		
		if(!oci_execute($addressStmt))
			return false;
		
		return oci_fetch_assoc($addressStmt);
	}
	
	/**
	 * 
	 * @param CustomerAddress $customer_address
	 */
	public function insertCustomerAddress(CustomerAddress $customer_address) {
		$insertCustomerAddressSQL = "INSERT INTO CUSTOMER_ADDRESS
							    (
							      CUSTOMER_CUSTOMER_ID ,
							      ADDRESS_ADDRESS_ID
							    )
							    VALUES
							    (
							      :p_CUSTOMER_CUSTOMER_ID ,
							      :p_ADDRESS_ADDRESS_ID
							    )";
		$customerAddressStmt = oci_parse($this->db, $insertCustomerAddressSQL);
		
		oci_bind_by_name($customerAddressStmt, ":p_CUSTOMER_CUSTOMER_ID" , $customer_address->getCustomer()->getId());
		oci_bind_by_name($customerAddressStmt, ":p_ADDRESS_ADDRESS_ID" , $customer_address->getAddress()->getId());
		
		$res = oci_execute($customerAddressStmt, OCI_COMMIT_ON_SUCCESS);
		
		return true;
	}
	
	public function updateCustomerAddress(CustomerAddress $customer_address) {
	
	}
	
	public function deleteCustomerAddress(CustomerAddress $customer_address) {
	
	}
	
	public function getCustomerAddress(Customer $customer) {
		$selectCustomerAddressSQL = "SELECT * FROM CUSTOMER_ADDRESS WHERE CUSTOMER_CUSTOMER_ID = :p_CUSTOMER_ID";
		
		$customerAddressStmt = oci_parse($this->db, $selectCustomerAddressSQL);
		
		oci_bind_by_name($customerAddressStmt, ":p_CUSTOMER_ID", $customer->getId());
		
		if(!oci_execute($customerAddressStmt))
			return false;
		
		return oci_fetch_assoc($customerAddressStmt);
	}
	
	/**
	 * 
	 * @param PayOption $address
	 */
	public function insertPayOption(PayOption $payoption) {
		$id = null;
		
		$insertPayOptionSQL = "INSERT INTO PAYOPTION
							    (
							      CARDNR ,
							      SECURITYCODE ,
							      NAME ,
							      EXPIRYDATE ,
							      PAYOPTION_ID ,
							      CUSTOMER_CUSTOMER_ID
							    )
							    VALUES
							    (
							      :p_CARDNR ,
							      :p_SECURITYCODE ,
							      :p_NAME ,
							      :p_EXPIRYDATE , 
							      PAYOPTION_PAYOPTION_ID_SEQ.NEXTVAL ,
							      :p_CUSTOMER_CUSTOMER_ID
							    )
								RETURNING PAYOPTION_ID INTO :p_PAYOPTION_ID";
		$payOptionStmt = oci_parse($this->db, $insertPayOptionSQL);
		
		oci_bind_by_name($payOptionStmt, ":p_CARDNR" , $payoption->getCardnr());
		oci_bind_by_name($payOptionStmt, ":p_SECURITYCODE" , $payoption->getSecuritycode());
		oci_bind_by_name($payOptionStmt, ":p_NAME",	$payoption->getName());
		oci_bind_by_name($payOptionStmt, ":p_EXPIRYDATE", $payoption->getExpirydate());
		oci_bind_by_name($payOptionStmt, ":p_PAYOPTION_ID",	$id);
		oci_bind_by_name($payOptionStmt, ":p_CUSTOMER_CUSTOMER_ID", $payoption->getCustomer()->getId());
		
		if(!$res = oci_execute($payOptionStmt, OCI_COMMIT_ON_SUCCESS))
			return false;
		
		return $id;
	}
	
	public function updatePayOption(PayOption $payoption) {
	
	}
	
	public function deletePayOption(PayOption $payoption) {
	
	}
	
	public function getPayOption(Customer $customer) {
		$selectPayOptionSQL = "SELECT * FROM PAYOPTION WHERE CUSTOMER_CUSTOMER_ID = :p_CUSTOMER_ID";
		
		$payOptionStmt = oci_parse($this->db, $selectPayOptionSQL);
		
		oci_bind_by_name($payOptionStmt, ":p_CUSTOMER_ID" , $customer->getId());
		
		oci_execute($payOptionStmt);
					
		return oci_fetch_assoc($payOptionStmt);
	}
	
	/**
	 * 
	 * @param Product $address
	 */
	public function insertProduct(Product $product) {
		$insertProductSQL = " INSERT INTO PRODUCT
					    (
							SELLPRICE ,
							NAME ,
							PRODUCT_ID ,
							SHOWDATE ,
							DESCRIPTION ,
							CATEGORY_CATEGORY_ID ,
							BUYPRICE ,
							ENDTIME ,
							STARTTIME ,
							CODE
					    )
					    VALUES
					    (
							:p_SELLPRICE ,
							:p_NAME ,
							:p_PRODUCT_ID ,
							:p_SHOWDATE ,
							:p_DESCRIPTION ,
							:p_CATEGORY_CATEGORY_ID ,
							:p_BUYPRICE ,
							:p_ENDTIME ,
							:p_STARTTIME ,
							:p_CODE
					    )";
		
		$productStmt = oci_parse($this->db, $insertProductSQL);
	}
	
	public function updateProduct(Product $product) {
	
	}
	
	public function deleteProduct(Product $product) {
	
	}
	
	public function getProduct($id) {
		$selectProductSQL = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :p_PRODUCT_ID";
		
		$productStmt = oci_parse($this->db, $selectProductSQL);
		
		oci_bind_by_name($productStmt, ":p_PRODUCT_ID", $id);
		
		if(!oci_execute($productStmt))
			return false;
		
		return oci_fetch_assoc($productStmt);
	}
	
	public function getProductByTransactionLine(TransactionLine $transactionLine) {
		$selectProductSQL = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = (SELECT PRODUCT_PRODUCT_ID FROM TRANSACTIONLINE WHERE TRANSACTIONLINE_ID = :p_TRANSACTIONLINE_ID)";
	
		$productStmt = oci_parse($this->db, $selectProductSQL);
	
		oci_bind_by_name($productStmt, ":p_TRANSACTIONLINE_ID", $transactionLine->getId());
	
		if(!oci_execute($productStmt))
			return false;
	
		return oci_fetch_assoc($productStmt);
	}
	
	public function getProductsByCategory(Category $category) {
		$products = array();
		
		$selectProductsSQL = "SELECT * FROM PRODUCT WHERE CATEGORY_CATEGORY_ID = :p_CATEGORY_CATEGORY_ID";
	
		$productsStmt = oci_parse($this->db, $selectProductsSQL);
	
		oci_bind_by_name($productsStmt, ":p_CATEGORY_CATEGORY_ID", $category->getId());
	
		if(!oci_execute($productsStmt))
			return false;
		
		oci_fetch_all($productsStmt, $products, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		return $products;
	}
	
	/**
	 * 
	 * @param Image $address
	 */
	public function insertImage(Image $image) {
	
	}
	
	public function updateImage(Image $image) {
	
	}
	
	public function deleteImage(Image $image) {
	
	}
	
	public function getImage($id) {
		$selectImageSQL = "SELECT * FROM IMAGE WHERE IMAGE_ID = :p_IMAGE_ID";
		
		$imageStmt = oci_parse($this->db, $selectImageSQL);
		
		oci_bind_by_name($imageStmt, ":p_PRODUCT_ID", $id);
		
		if(!oci_execute($imageStmt))
			return false;
		
		return oci_fetch_assoc($imageStmt);
	}
	
	public function getImages(Product $product) {
		$images = array();
		
		$selectImagesSQL = "SELECT * FROM IMAGE WHERE PRODUCT_PRODUCT_ID = :p_PRODUCT_PRODUCT_ID";
		
		$imagesStmt = oci_parse($this->db, $selectImagesSQL);
		
		oci_bind_by_name($imagesStmt, ":p_PRODUCT_PRODUCT_ID" , $product->getId());
		
		oci_execute($imagesStmt);
			
		oci_fetch_all($imagesStmt, $images, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		return $images;
	}
	
	/**
	 * 
	 * @param SystemUser $address
	 */
	public function insertSystemUser(SystemUser $systemUser) {
	
	}
	
	public function updateSystemUser(SystemUser $systemUser) {
	
	}
	
	public function deleteSystemUser(SystemUser $systemUser) {
	
	}
	
	public function getSystemUser() {
	
	}
	
	/**
	 * 
	 * @param Category $address
	 */
	public function insertCategory(Category $category) {
	
	}
	
	public function updateCategory(Category $category) {
	
	}
	
	public function deleteCategory(Category $category) {
	
	}
	
	public function getCategory($id) {
		$selectCategorySQL = "SELECT * FROM CATEGORY WHERE CATEGORY_ID = :p_CATEGORY_ID";
		
		$categoryStmt = oci_parse($this->db, $selectCategorySQL);
		
		oci_bind_by_name($categoryStmt, ":p_CATEGORY_ID", $id);
		
		if(!oci_execute($categoryStmt))
			return false;
		
		return oci_fetch_assoc($categoryStmt);
	}
	
	public function getCategories() {
		$categories = array();
		
		$selectCategoriesSQL = "SELECT * FROM CATEGORY";
		
		$categoriesStmt = oci_parse($this->db, $selectCategoriesSQL);
		
		oci_execute($categoriesStmt);
			
		oci_fetch_all($categoriesStmt, $categories, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		return $categories;
	}
	
	/**
	 * 
	 * @param Transaction $address
	 */
	public function insertTransaction(Transaction $transaction, Customer $customer) {
		$id = null;
		
		$insertTransactionSQL = "INSERT INTO TRANSACTION
							    (
							      PURCHASEDATE ,
							      CUSTOMER_CUSTOMER_ID ,
							      TRANSACTION_ID
							    )
							    VALUES
							    (
							      SYSDATE ,
							      :p_CUSTOMER_CUSTOMER_ID ,
							      TRANSACTION_TRANSACTION_ID_SEQ.NEXTVAL
							    )
								RETURNING TRANSACTION_ID INTO :p_TRANSACTION_ID";
		
		$transactionStmt = oci_parse($this->db, $insertTransactionSQL);
		
		oci_bind_by_name($transactionStmt, 'p_CUSTOMER_CUSTOMER_ID', $customer->getId());
		oci_bind_by_name($transactionStmt, 'p_TRANSACTION_ID', $id);
		
		if(!oci_execute($transactionStmt, OCI_COMMIT_ON_SUCCESS))
			return false;

		return $id;
	}
	
	public function updateTransaction(Transaction $transaction) {
	
	}
	
	public function deleteTransaction(Transaction $transaction) {
	
	}
	
	public function getTransaction($id) {
		$selectTransactionSQL = "SELECT * FROM TRANSACTION WHERE  = :p_TRANSACTION_ID";
		
		$transactionStmt = oci_parse($this->db, $selectTransactionSQL);
		
		oci_bind_by_name($transactionStmt, ":p_TRANSACTION_ID", $id);
		
		if(!oci_execute($transactionStmt))
			return false;
		
		return oci_fetch_assoc($transactionStmt);
	
	}
	
	public function getTransactionsByCustomer(Customer $customer) {
		$transactions = array();
		
		$selectTransactionsSQL = "SELECT * FROM TRANSACTION WHERE CUSTOMER_CUSTOMER_ID = :p_CUSTOMER_ID ORDER BY PURCHASEDATE DESC";
		
		$transactionsStmt = oci_parse($this->db, $selectTransactionsSQL);
		
		oci_bind_by_name($transactionsStmt,  ":p_CUSTOMER_ID" , $customer->getId());
		
		oci_execute($transactionsStmt);
			
		oci_fetch_all($transactionsStmt, $transactions, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		return $transactions;
	
	}
	
	/**
	 * 
	 * @param TransactionLine $transactionLine
	 */
	public function insertTransactionLine(TransactionLine $transactionLine, Transaction $transaction) {
		$id = null;

		$insertTransactionLineSQL = "INSERT INTO TRANSACTIONLINE
								    (
								      TRANSACTIONLINE_ID ,
								      PRICEPERUNIT ,
								      TRANSACTION_TRANSACTION_ID ,
								      PRODUCT_PRODUCT_ID ,
								      QUANTITY
								    )
								    VALUES
								    (
								      TRANSACTIONLINE_TRANSACTIONLIN.NEXTVAL ,
								      :p_PRICEPERUNIT ,
								      :p_TRANSACTION_TRANSACTION_ID ,
								      :p_PRODUCT_PRODUCT_ID ,
								      :p_QUANTITY
								    )
									RETURNING TRANSACTIONLINE_ID INTO :p_TRANSACTIONLINE_ID";
		
		$insertTransactionLineStmt = oci_parse($this->db, $insertTransactionLineSQL);
		
		oci_bind_by_name($insertTransactionLineStmt, ':p_PRICEPERUNIT', $transactionLine->getPriceperunit());
		oci_bind_by_name($insertTransactionLineStmt, ':p_TRANSACTION_TRANSACTION_ID', $transaction->getId());
		oci_bind_by_name($insertTransactionLineStmt, ':p_PRODUCT_PRODUCT_ID', $transactionLine->getProduct()->getId());
		oci_bind_by_name($insertTransactionLineStmt, ':p_QUANTITY', $transactionLine->getQuantity());
		oci_bind_by_name($insertTransactionLineStmt, ':p_TRANSACTIONLINE_ID', $id);
		
		if(!oci_execute($insertTransactionLineStmt, OCI_COMMIT_ON_SUCCESS))
			return false;
		
		return $id;
	}
	
	public function updateTransactionLine(TransactionLine $transactionLine) {
	
	}
	
	public function deleteTransactionLine(TransactionLine $transactionLine) {
	
	}
	
	public function getTransactionLine($id) {
		$selectTransactionLineSQL = "SELECT * FROM CATEGORY WHERE CATEGORY_ID = :p_CATEGORY_ID";
		
		$categoryStmt = oci_parse($this->db, $selectTransactionLineSQL);
		
		oci_bind_by_name($categoryStmt, ":p_CATEGORY_ID", $id);
		
		if(!oci_execute($categoryStmt))
			return false;
		
		return oci_fetch_assoc($categoryStmt);
	}
	
	public function getTransactionLines($id) {
		$transactionLines = array();
		
		$transactionLinesSQL = "SELECT * FROM TRANSACTIONLINE WHERE TRANSACTION_TRANSACTION_ID = :p_TRANSACTION_ID";
		
		$transactionLinesStmt = oci_parse($this->db, $transactionLinesSQL);
		
		oci_bind_by_name($transactionLinesStmt, ":p_TRANSACTION_ID", $id);
		
		if(!oci_execute($transactionLinesStmt))
			return null;
		
		 oci_fetch_all($transactionLinesStmt, $transactionLines, 0, -1, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		return $transactionLines;
	}
}

?>