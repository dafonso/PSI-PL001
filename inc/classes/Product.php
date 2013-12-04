<?php
class Product {
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
	private $description;
	/**
	 * @var string
	 */
	private $code;
	/**
	 * @var float
	 */
	private $buyprice;
	/**
	 * @var float
	 */
	private $sellprice;
	/**
	 * @var date
	 */
	private $showdate;
	/**
	 * @var string
	 */
	private $starttime;
	/**
	 * @var string
	 */
	private $endtime;
	/**
	 * @var Category
	 */
	private $category;

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
	public function getDescription() {
		return $this -> description;
	}

	/**
	 *
	 * @param $description
	 */
	public function setDescription($description) {
		$this -> description = $description;
	}

	/**
	 *
	 * @return
	 */
	public function getCode() {
		return $this -> code;
	}

	/**
	 *
	 * @param $code
	 */
	public function setCode($code) {
		$this -> code = $code;
	}

	/**
	 *
	 * @return
	 */
	public function getBuyprice() {
		return $this -> buyprice;
	}

	/**
	 *
	 * @param $buyprice
	 */
	public function setBuyprice($buyprice) {
		$this -> buyprice = $buyprice;
	}

	/**
	 *
	 * @return
	 */
	public function getSellprice() {
		return $this -> sellprice;
	}

	/**
	 *
	 * @param $sellprice
	 */
	public function setSellprice($sellprice) {
		$this -> sellprice = $sellprice;
	}

	/**
	 *
	 * @return
	 */
	public function getShowdate() {
		return $this -> showdate;
	}

	/**
	 *
	 * @param $showdate
	 */
	public function setShowdate($showdate) {
		$this -> showdate = $showdate;
	}

	/**
	 *
	 * @return
	 */
	public function getStarttime() {
		return $this -> starttime;
	}

	/**
	 *
	 * @param $starttime
	 */
	public function setStarttime($starttime) {
		$this -> starttime = $starttime;
	}

	/**
	 *
	 * @return
	 */
	public function getEndtime() {
		return $this -> endtime;
	}

	/**
	 *
	 * @param $endtime
	 */
	public function setEndtime($endtime) {
		$this -> endtime = $endtime;
	}

	/**
	 *
	 * @return
	 */
	public function getCategory() {
		return $this -> category;
	}

	/**
	 *
	 * @param $category
	 */
	public function setCategory($category) {
		$this -> category = $category;
	}

}
?>