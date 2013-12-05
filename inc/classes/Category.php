<?php
/**
 * 
 * @author psi-pl001
 *
 */
class Category {
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
	private $imagesource;
	
	public function __construct($categoryData = null) {
		if($categoryData != null) {
			$this->setId($categoryData['CATEGORY_ID']);
			$this->setName($categoryData['NAME']);
			$this->setImagesource($categoryData['IMAGESOURCE']);
		}
	}

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


	/**
	 * 
	 * @return 
	 */
	public function getImagesource()
	{
	    return $this->imagesource;
	}

	/**
	 * 
	 * @param $imagesource
	 */
	public function setImagesource($imagesource)
	{
	    $this->imagesource = $imagesource;
	}
}
?>