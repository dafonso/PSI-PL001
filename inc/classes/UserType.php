<?php
class UserType {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $name;

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

}
?>