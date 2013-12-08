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
	header("Location: ".REDIRECT_URL_PATH);
	exit;
}

if (isset($_GET['logoutAdmin'])) {
	unset($_SESSION['systemuser_id']);
	unset($_SESSION['systemuser_name']);
	header("Location: ".REDIRECT_URL_PATH.'admin/');
	exit;
}

global $userLoggedIn;
global $systemuserLoggedIn;
global $loginFailed;

$userLoggedIn = false;
$systemuserLoggedIn = false; 
$loginFailed = false;

if(isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
	$customer = ShopCUL::getCustomerByID($_SESSION['user_id']);
	
	if(!$customer) {
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		header('Location: '.REDIRECT_URL_PATH);
		exit;
	} else {
		$userLoggedIn = true;
		$_SESSION['user_id'] = $customer->getId();
		$_SESSION['user_name'] = $customer->getName();	
	}
}

if(isset($_SESSION['systemuser_id']) && is_numeric($_SESSION['systemuser_id'])) {
	
	$systemuser = ShopCUL::getSystemUserByID($_SESSION['systemuser_id']);

	if(is_null($systemuser)) {
		unset($_SESSION['systemuser_id']);
		unset($_SESSION['systemuser_name']);
		header('Location: '.REDIRECT_URL_PATH);
		exit;
	} else {
		$systemuserLoggedIn = true;
		$_SESSION['systemuser_id'] = $systemuser->getId();
		$_SESSION['systemuser_name'] = $systemuser->getName();
	}
}


?>	