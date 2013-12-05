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
	
	public function __construct($id = null) {
		global $db;
		
		if($id != null && is_numeric($id)) {
			if(!($db instanceof OCI_DB)) {
				$db = new OCI_DB();
			}
			
			$categoryData = $db->getCategory($id);
			
			if(!$categoryData)
				return false;
			
			error_log(print_r($categoryData, true));
			
			$this->setId($categoryData['CATEGORY_ID']);
			$this->setName($categoryData['NAME']);
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

}
?>