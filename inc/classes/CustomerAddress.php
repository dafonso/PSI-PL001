<?php 
class CustomerAddress {
	/**
	 * @var Customer
	 */
	private $customer;
	/**
	 * @var Address
	 */
	private $address;
	
	public function __construct(Customer $customer, Address $address) {
		$this->customer = $customer;
		$this->address = $address;
	}

	/**
	 * 
	 * @return Customer
	 */
	public function getCustomer()
	{
	    return $this->customer;
	}

	/**
	 * 
	 * @param $customer
	 */
	public function setCustomer(Customer $customer)
	{
	    $this->customer = $customer;
	}

	/**
	 * 
	 * @return Address
	 */
	public function getAddress()
	{
	    return $this->address;
	}

	/**
	 * 
	 * @param $address
	 */
	public function setAddress(Address $address)
	{
	    $this->address = $address;
	}
}
?>