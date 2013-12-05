<?php
/**
 * @author psi-pl001
 *
 */
class SystemUser {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var unknown_type
	 */
	private $name;
	/**
	 * @var unknown_type
	 */
	private $username;
	/**
	 * @var unknown_type
	 */
	private $password;
	/**
	 * @var unknown_type
	 */
	private $email;
	/**
	 * @var unknown_type
	 */
	private $type;

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
	public function getUsername() {
		return $this -> username;
	}

	/**
	 *
	 * @param $username
	 */
	public function setUsername($username) {
		$this -> username = $username;
	}

	/**
	 *
	 * @return
	 */
	public function getPassword() {
		return $this -> password;
	}

	/**
	 *
	 * @param $password
	 */
	public function setPassword($password) {
		$this -> password = $password;
	}

	/**
	 *
	 * @return
	 */
	public function getEmail() {
		return $this -> email;
	}

	/**
	 *
	 * @param $email
	 */
	public function setEmail($email) {
		$this -> email = $email;
	}

	/**
	 *
	 * @return
	 */
	public function getType() {
		return $this -> type;
	}

	/**
	 *
	 * @param $type
	 */
	public function setType($type) {
		$this -> type = $type;
	}

}
?>