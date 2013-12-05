<?php
/**
 * @author psi-pl001
 *
 */
class PayOption {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $name;
	/**
	 * @var string
	 */
	private $cardnr;
	/**
	 * @var string
	 */
	private $expirydate;
	/**
	 * @var string
	 */
	private $securitycode;
	
	/**
	 * 
	 * @var Customer
	 */
	private $customer;
	
	public function __construct($payOptionData = null) {
		if($payOptionData != null) {
			$this->setId($payOptionData['PAYOPTION_ID']);
			$this->setCardnr($payOptionData['CARDNR']);
			$this->setExpirydate($payOptionData['EXPIRYDATE']);
			$this->setSecuritycode($payOptionData['SECURITYCODE']);
		}
	}

	/**
	 *
	 * @return
	 */
	public function getId() {
		return $this -> id;
	}

	/**
	 *
	 * @param $id
	 */
	public function setId($id) {
		$this -> id = $id;
	}

	/**
	 *
	 * @return
	 */
	public function getName() {
		return $this -> name;
	}

	/**
	 *
	 * @param $name
	 */
	public function setName($name) {
		$this -> name = $name;
	}

	/**
	 *
	 * @return
	 */
	public function getCardnr() {
		return $this->cardnr;
	}
	
	public function getHiddenCardnr() {
		return 'xxxx xxxx xxxx x'.substr($this->cardnr, -3);
	}

	/**
	 *
	 * @param $cardnr
	 */
	public function setCardnr($cardnr) {
		$this -> cardnr = $cardnr;
	}

	/**
	 *
	 * @return
	 */
	public function getExpirydate() {
		return $this -> expirydate;
	}

	/**
	 *
	 * @param $expirydate
	 */
	public function setExpirydate($expirydate) {
		$this -> expirydate = $expirydate;
	}

	/**
	 *
	 * @return
	 */
	public function getSecuritycode() {
		return $this -> securitycode;
	}

	/**
	 *
	 * @param $securitycode
	 */
	public function setSecuritycode($securitycode) {
		$this -> securitycode = $securitycode;
	}

	public function getCustomer()
	{
	    return $this->customer;
	}

	public function setCustomer($customer)
	{
	    $this->customer = $customer;
	}
}
?>