<?php
class Category {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $name;

	public function getId() {
		return $this -> id;
	}

	public function setId($id) {
		$this -> id = $id;
	}

	public function getName() {
		return $this -> name;
	}

	public function setName($name) {
		$this -> name = $name;
	}

}
?>