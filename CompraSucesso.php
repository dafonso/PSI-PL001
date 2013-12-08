<?php
require 'inc/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compra registada :: ShopCUL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/stickyfooter.css" rel="stylesheet" media="screen">
    </head>
    <body>
    	<div id="wrap">
	        <div class="container">
	            <h1>ShopCUL - Compra sucesso</h1>        
	            <?php require 'inc/common/nav.php'; ?>
	            <ul class="breadcrumb">
					<li><a href="<?=REDIRECT_URL_PATH;?>">Home</a> <span class="divider">/</span></li>
					<li class="active">Compra Registada</li>
				</ul>
	            <div class="alert alert-success">
	                <p><strong>A sua compra foi registada...</strong></p>
	                Obrigado pela sua prefência.<br/>                
	                ShopCUL
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