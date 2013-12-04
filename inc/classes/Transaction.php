<?php
class Transaction {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $date;
	/**
	 * @var Customer
	 */
	private $customer = null;

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
	public function getDate() {
		return $this -> date;
	}

	/**
	 *
	 * @param $date
	 */
	public function setDate($date) {
		$this -> date = $date;
	}

	/**
	 *
	 * @return
	 */
	public function getCustomer() {
		return $this -> customer;
	}

	/**
	 *
	 * @param $customer
	 */
	public function setCustomer($customer) {
		$this -> customer = $customer;
	}

}
?>