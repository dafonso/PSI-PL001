<?php
/**
 *
 * @author dafonso
 *
 */
class Address {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $street;
	/**
	 * @var string
	 */
	private $city;
	/**
	 * @var string
	 */
	private $postalcode;
	/**
	 * @var Country
	 */
	private $country;
	/**
	 * @var AddressType
	 */
	private $type;

	public function getId() {
		return $this -> id;
	}

	public function setId($id) {
		$this -> id = $id;
	}

	public function getStreet() {
		return $this -> street;
	}

	public function setStreet($street) {
		$this -> street = $street;
	}

	public function getCity() {
		return $this -> city;
	}

	public function setCity($city) {
		$this -> city = $city;
	}

	public function getPostalcode() {
		return $this -> postalcode;
	}

	public function setPostalcode($postalcode) {
		$this -> postalcode = $postalcode;
	}

	public function getCountry() {
		return $this -> country;
	}

	public function setCountry($country) {
		$this -> country = $country;
	}

	public function getType() {
		return $this -> type;
	}

	public function setType($type) {
		$this -> type = $type;
	}

}
?>