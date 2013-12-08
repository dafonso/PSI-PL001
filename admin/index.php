<?php 
require '../inc/init.php';

if (isset($_POST['inputSystemUsername']) && isset($_POST['inputPassword'])) {
	$username = $_POST['inputSystemUsername'];
	$password = $_POST['inputPassword'];
	
	$systemUser = ShopCUL::getSystemUserByUsername($username);
	
	
	if(is_null($systemUser)) {
		header('Location: '.REDIRECT_URL_PATH.'admin/login.php?loginFailed=1');
		exit;
	}
	
	if($systemUser->getPassword() == sha1($password)) {
		$_SESSION['systemuser_id'] = $systemUser->getId();
		$_SESSION['systemuser_name'] = $systemUser->getName();
		header('Location: '.REDIRECT_URL_PATH.'admin/');
		exit;
	} else {
		header('Location: '.REDIRECT_URL_PATH.'admin/login.php?loginFailed=1');
		exit;
	}
}

if(!$systemuserLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH.'admin/login.php');
	exit;
}

header('Location: '.REDIRECT_URL_PATH.'admin/relatorios.php');
?>