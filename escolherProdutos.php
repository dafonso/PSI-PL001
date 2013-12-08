<?php 
require 'inc/init.php';

$shopCULHelper = new ShopCUL();

if(!isset($_GET['category_id']) || !is_numeric($_GET['category_id'])) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}

$category_id = $_GET['category_id'];

$category = ShopCUL::getCategoryById($category_id);
$products = ShopCUL::getProductsByCategory($category);
/**
 * 
 * @var Product
 */
$product = null;

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
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
			<h1>ShopCUL - Produtos</h1>            
            <?php require 'inc/common/nav.php'; ?>
            <div class="row">
                <div class="span12">
                    <h2><?=$category->getName();?></h2>
                </div>
            </div>     
            <div class="row">
                <div class="span12">
                    <ul class="thumbnails">
                    <?php foreach($products as $product) { 
                    	$images = $product->getImages();
                   	?>
	                    <li class="thumbnail span12">
	                            <img src="<?=(count($images) == 0 ? 'img/dummy-big.png' : $images[0]->getSource());?>" alt="" class="span2" style=" width: 140px; height: 140px;">
	                            <div class="span9"> 
	                                <div class="caption">
	                                    <h3><?=$product->getName();?></h3>
	                                    <div style="max-height: 60px;overflow-y: scroll;">
	                                    <?=$product->getDescription();?>
	                                    </div>                                
	                                </div>
	                            </div>
	                            <div class="pull-right">
	                                <a href="finalizarCompra.php?product_id=<?=$product->getId();?>" class="btn btn-small btn-success">Comprar</a><br/>
	                                <?=$product->getSellprice();?> €
	                                <?php if(!is_null($product->getShowdate())) { ?>
	                                <br/>
	                                <?=$product->getShowdate();?><br/>
	                                <?=$product->getStarttime();?>-<?=$product->getEndtime();?>	
	                                <?php }?>
	                            </div>
	                        </li>
                    <?php } ?>
                    </ul>
                 </div>
            </div>
            <!-- <div class="row">
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
            </div>  -->
        </div>
    </body>
</html>