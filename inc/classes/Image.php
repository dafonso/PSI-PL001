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
	
	public function __construct($imageData = null) {
		if($imageData != null) {
			$this->setId($imageData['IMAGE_ID']);
			$this->setSource($imageData['SOURCE']);
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

}
?>