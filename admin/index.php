<?php 
require '../inc/init.php';

if(!$adminLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH.'login.php');
	exit;
}

header('Location: '.REDIRECT_URL_PATH.'relatorios.php');
?>