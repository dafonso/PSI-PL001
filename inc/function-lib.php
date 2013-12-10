<?php
function __autoload($class_name) {	
	if(file_exists(ROOT_FOLDER.'/inc/classes/'.$class_name . '.php')) {
		require_once ROOT_FOLDER.'/inc/classes/'.$class_name . '.php';
	} else {
		require_once ROOT_FOLDER.'/inc/db/'.$class_name . '.php';
	}
}

function dump($var) {
	echo '<pre>'.var_dump($var).'</pre>';
}

function sendSMS($number, $message) {
	if(!strstr($_SERVER['HTTP_HOST'], 'luna')) {
		$xml = file_get_contents("http://api.textmarketer.co.uk/gateway/?username=".SMSGW_USERNAME."&password=".SMSGW_PASSWORD."&message=".$message."&orig=ShopCUL&number=351".$number."&option=xml");
		
		$xmlResponseObj = simplexml_load_file($xml);
	} else {

	}
}

?>