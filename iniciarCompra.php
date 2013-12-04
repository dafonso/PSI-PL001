<?php 
require 'inc/init.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Iniciar Compra</title>		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>ShopCUL - Produtos</h1>            
                </div>
                <?php require 'inc/common/nav.php'; ?>
            </div>   
            <div class="row">
                <div class="span4">                    
                    <img src="img/dummy-big.png" alt="">
                    <h3 style="text-align: center;"><a href="#">Artesanato</a></h3>
                </div>
                <div class="span4">                    
                    <img src="img/dummy-big.png" alt="">
                    <h3 style="text-align: center;"><a href="#">Doçaria</a></h3>
                </div>
                <div class="span4">                    
                    <img src="img/dummy-big.png" alt="">
                    <h3 style="text-align: center;"><a href="#">Bilhetes</a></h3>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>