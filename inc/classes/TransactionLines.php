<?php
class TransactionLines {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var integer
	 */
	private $quantity;
	/**
	 * @var float
	 */
	private $priceperunit;
	/**
	 * @var Transaction
	 */
	private $transaction;
	/**
	 * @var Product
	 */
	private $product;

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
	public function getQuantity() {
		return $this -> quantity;
	}

	/**
	 *
	 * @param $quantity
	 */
	public function setQuantity($quantity) {
		$this -> quantity = $quantity;
	}

	/**
	 *
	 * @return
	 */
	public function getPriceperunit() {
		return $this -> priceperunit;
	}

	/**
	 *
	 * @param $priceperunit
	 */
	public function setPriceperunit($priceperunit) {
		$this -> priceperunit = $priceperunit;
	}

	/**
	 *
	 * @return
	 */
	public function getTransaction() {
		return $this -> transaction;
	}

	/**
	 *
	 * @param $transaction
	 */
	public function setTransaction($transaction) {
		$this -> transaction = $transaction;
	}

	/**
	 *
	 * @return
	 */
	public function getProduct() {
		return $this -> product;
	}

	/**
	 *
	 * @param $product
	 */
	public function setProduct($product) {
		$this -> product = $product;
	}

}
?>