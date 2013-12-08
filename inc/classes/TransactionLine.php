<?php
/**
 * @author psi-pl001
 *
 */
class TransactionLine {
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
	 * @var Product
	 */
	private $product;
	
	public function __construct($transactionLineData = null) {
		if($transactionLineData != null) {
			$this->setId($transactionLineData['TRANSACTIONLINE_ID']);
			$this->setQuantity($transactionLineData['QUANTITY']);
			$this->setPriceperunit($transactionLineData['PRICEPERUNIT']);
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
	public function getProduct() {
		global $db;
		
		if(!($this->product instanceof Product)) {
			$this->setProduct(new Product($db->getProductByTransactionLine($this)));
		}
		
		return $this->product;
	}

	/**
	 *
	 * @param $product
	 */
	public function setProduct(Product $product) {
		$this -> product = $product;
	}

}
?>