<?php 
if(strstr($_SERVER['HTTP_HOST'], 'luna')) {
	define("ROOT_FOLDER", "/home/falua/psi-pl/psi-pl001/public_html");
	define('REDIRECT_URL_PATH', '/~psi-pl001/');
	define('ORACLE_CONN_STRING', '//luna.di.fc.ul.pt/difcul.alunos.di.fc.ul.pt');
} else {
	define("ROOT_FOLDER", "/var/www/html");
	define('REDIRECT_URL_PATH', '/');
	define('ORACLE_CONN_STRING', '//localhost');	
}
?>
