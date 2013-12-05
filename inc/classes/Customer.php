<?php 

/**
 *
 * @author psi-pl001
 *
 */
class Customer {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $email;
	/**
	 * @var string
	 */
	private $password;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var integer
	 */
	private $nif;
	/**
	 * @var string
	 */
	private $phonenr;
	/**
	 * @var string
	 */
	private $paypal;
	/**
	 * @var Address
	 */
	private $addresses;
	/**
	 * @var string
	 */
	private $username;
	/**
	 * 
	 * @var PayOption
	 */
	private $payoption;


	public function __construct($customerData = null) {
		global $db;
		
		if($customerData != null) {
			if(!$customerData)
				return false;
						
			$this->setId($customerData['CUSTOMER_ID']);
			$this->setEmail($customerData['EMAIL']);
			$this->setName($customerData['NAME']);
			$this->setNif($customerData['NIF']);
			$this->setPassword($customerData['PASSWORD']);
			$this->setPaypal($customerData['PAYPAL']);
			$this->setPhonenr($customerData['PHONENR']);
			$this->setUsername($customerData['USERNAME']);
			
// 			if($this->getId() != null) {
// 				$customerAddress = new CustomerAddress($db->getCustomerAddress($this));
				
// 				if($customerAddress->getAddress() != null)
// 					$this->setAddresses($customerAddress->getAddress());
					
// 				$this->setPayoption(new PayOption($db->getPayOption($this)));
// 			}
		} else {
			$this->setAddresses(new Address());
			$this->setPayoption(new PayOption());
		}
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getNif() {
		return $this->nif;
	}

	public function setNif($nif) {
		$this->nif = $nif;
	}

	public function getPhonenr() {
		return $this->phonenr;
	}

	public function setPhonenr($phonenr) {
		$this->phonenr = $phonenr;
	}

	public function getPaypal() {
		return $this->paypal;
	}

	public function setPaypal($paypal) {
		$this->paypal = $paypal;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getName() {
	    return $this->name;
	}

	public function setName($name) {
	    $this->name = $name;
	}

	public function getAddresses() {
	    return $this->addresses;
	}

	public function setAddresses(Address $addresses) {
	    $this->addresses = $addresses;
	}

	public function getPayoption()
	{
	    return $this->payoption;
	}

	public function setPayoption(PayOption $payoption)
	{
	    $this->payoption = $payoption;
	}
}
?>