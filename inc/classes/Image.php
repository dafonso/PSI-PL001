<?php
class Image {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $source;
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
	public function getSource() {
		return $this -> source;
	}

	/**
	 *
	 * @param $source
	 */
	public function setSource($source) {
		$this -> source = $source;
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