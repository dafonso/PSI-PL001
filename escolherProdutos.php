<?php 
require 'inc/init.php';

$shopCULHelper = new ShopCUL();

if(!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}

$category_id = $_GET['category_id'];

$category = new Category($category_id);

$products = $shopCULHelper->getProductsByCategory($category);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Escolher Produto</title>
		<meta charset="utf-8">
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
                <div class="span12">
                    <h2><?=$category->getName();?></h2>
                </div>
            </div>     
            <div class="row">
                <div class="span12">
                    <ul class="thumbnails">
                    <?php foreach($products as $product) { ?>
	                    <li class="thumbnail span12">
	                            <img src="img/dummy.png" alt="" class="span2">
	                            <div class="span9"> 
	                                <div class="caption">
	                                    <h3><?=$product->getName();?></h3>
	                                    <div style="max-height: 60px;overflow-y: scroll;">
	                                    <?=$product->getDescription();?>
	                                    </div>                                
	                                </div>
	                            </div>
	                            <div class="pull-right">
	                                <a href="#" class="btn btn-small btn-success">Comprar</a>
	                            </div>
	                        </li>
                    <?php } ?>
                    </ul>
                 </div>
            </div>
            <div class="row">
                <div class="span4 offset4">
                    <div class="pagination">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>