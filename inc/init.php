<?php 
session_name('ShopCUL');
session_start();

require_once 'config.php';
require 'function-lib.php';

global $db;
$db = new OCI_DB();

if (isset($_GET['logout'])) {
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	session_destroy();
	header("Location: ".REDIRECT_URL_PATH);
	exit;
}

global $userLoggedIn;
global $loginFailed;

$userLoggedIn = false; 
$loginFailed = false;

if(isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
	$customer = ShopCUL::getCustomerByID($_SESSION['user_id']);
	
	if(!$customer) {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		session_destroy();
		header('Location: '.REDIRECT_URL_PATH);
		exit;
	} else {
		$userLoggedIn = true;
		$_SESSION['user_id'] = $customer->getId();
		$_SESSION['user_name'] = $customer->getName();	
	}
}

?>	