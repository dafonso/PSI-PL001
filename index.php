<?php
require_once 'inc/init.php';

if (isset($_POST['inputUsername']) && isset($_POST['inputPassword'])) {
	$username = $_POST['inputUsername'];
	$password = $_POST['inputPassword'];
	
	$customer = ShopCUL::getCustomerByUsername($username);

	if(!$customer) {
		header('Location: '.REDIRECT_URL_PATH.'?loginFailed=1');
		exit;
	}

	if($customer->getPassword() == sha1($password)) {
		$_SESSION['user_id'] = $customer->getId();
		$_SESSION['user_name'] = $customer->getName();
		header('Location: '.REDIRECT_URL_PATH);
		exit;
	} else {
		header('Location: '.REDIRECT_URL_PATH.'login.php?loginFailed=1');
		exit;
	}
}

$categories = ShopCUL::getCategories();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home :: ShopCUL</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/stickyfooter.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div id="wrap">
	        <div class="container">
				<h1>ShopCUL</h1>            
				<?php require 'inc/common/nav.php'; ?>
	            <div class="row">
	                <?php foreach($categories as $category) { ?>
	                <div class="span4">                    
	                    <a href="escolherProdutos.php?category_id=<?=$category->getId();?>"><img src="<?=is_null($category->getImagesource()) ? 'img/dummy-big.png' : $category->getImagesource() ;?>" alt="" style=" width: 300px; height: 200px; "></a>
	                    <h3 style="text-align: center;"><a href="escolherProdutos.php?category_id=<?=$category->getId();?>"><?=$category->getName();?></a></h3>
	                </div>
	                <?php } ?>
	            </div>
	        </div>
        </div>
        <div id="footer" class="footer">
	      <div class="container">
	        <p class="muted credit">© ShopCUL 2013</p>
	      </div>
	    </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>