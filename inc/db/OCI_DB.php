<?php 
class OCI_DB {
	private $db;
	private $username = 'psi001pl';
	private $password = 'Ps1PL001';
// 	private $connString = '//luna.di.fc.ul.pt/difcul.alunos.di.fc.ul.pt';
	private $connString = '//localhost';
	
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
		
		$result = oci_fetch_array($customerStmt, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		if(!$result)
			return false;
		
		return $result;
	}
	
	
	public function getCustomerIDByUsername($username) {
		$result = null;
		
		$selectCustomerSQL = "SELECT CUSTOMER_ID FROM CUSTOMER WHERE USERNAME = :p_USERNAME";
		$customerStmt = oci_parse($this->db, $selectCustomerSQL);
		
		oci_bind_by_name($customerStmt, ":p_USERNAME" , $username);
		
		oci_execute($customerStmt, OCI_COMMIT_ON_SUCCESS);
		
		$result = oci_fetch_array($customerStmt, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		
		if(!$result)
			return false;

		return $result['CUSTOMER_ID'];	
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
	
	public function getAddress() {
		
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
	
	public function getCustomerAddress() {
	
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
	
	public function getPayOption($id) {
	
	}
	
	/**
	 * 
	 * @param Product $address
	 */
	public function insertProduct(Product $product) {
	
	}
	
	public function updateProduct(Product $product) {
	
	}
	
	public function deleteProduct(Product $product) {
	
	}
	
	public function getProduct() {
	
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
	
	public function getImage() {
	
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
	
	public function getCategory() {
	
	}
	
	public function getCategories() {
		$categories = array();
		
		$selectCategoriesSQL = "SELECT ";
	}
	
	/**
	 * 
	 * @param Transaction $address
	 */
	public function insertTransaction(Transaction $transaction) {
	
	}
	
	public function updateTransaction(Transaction $transaction) {
	
	}
	
	public function deleteTransaction(Transaction $transaction) {
	
	}
	
	public function getTransaction() {
	
	}
	
	/**
	 * 
	 * @param TransactionLines $address
	 */
	public function insertTransactionLines(TransactionLines $transactionLines) {
	
	}
	
	public function updateTransactionLines(TransactionLines $transactionLines) {
	
	}
	
	public function deleteTransactionLines(TransactionLines $transactionLines) {
	
	}
	
	public function getTransactionLines() {
	
	}
}

?>