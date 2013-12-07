<?php
/**
 * @author psi-pl001
 *
 */
class Transaction {
	/**
	 * @var integer
	 */
	private $id;
	/**
	 * @var string
	 */
	private $purchaseDate;
	/**
	 * @var Customer
	 */
	private $customer = null;
	
	/**
	 * @var TransactionLine
	 */
	private $transactionLines = null;

	public function __construct($transactionData = null) {
		if ($transactionData != null) {
			if(isset($transactionData['TRANSACTION_ID'])) {
				$this->setId($transactionData['TRANSACTION_ID']);
			}
			
			$this->setPurchaseDate($transactionData['PURCHASEDATE']);				
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
	public function getCustomer() {
		return $this -> customer;
	}

	/**
	 *
	 * @param $customer
	 */
	public function setCustomer($customer) {
		$this -> customer = $customer;
	}


	public function getPurchaseDate()
	{
	    return $this->purchaseDate;
	}

	public function setPurchaseDate($purchaseDate)
	{
	    $this->purchaseDate = $purchaseDate;
	}

	public function getTransactionLines() {
		global $db;
		
		$transactionLines = array();
		
		if(count($this->transactionLines) == 0) {
			$transactionsLinesData = $db->getTransactionLines($this->id); 
		
			foreach($transactionsLinesData as $transactionLineData) {
				array_push($transactionLines, new TransactionLine($transactionLineData));
			}
			
			$this->transactionLines = $transactionLines;
		}
		
	    return $this->transactionLines;
	}

	public function setTransactionLines($transactionLines)
	{
	    $this->transactionLines = $transactionLines;
	}

	/**
	 * 
	 * @return 
	 */
	public function getTransactionTotal() {
		$transactionLines = $this->getTransactionLines();
		
		$total = 0;
		
		foreach($transactionLines as $transactionLine) {
			$total += $transactionLine->getPriceperunit() * $transactionLine->getQuantity();
		}
		
	    return $total;
	}
}
?>