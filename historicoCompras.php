<?php 
require 'inc/init.php';

if(!$userLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}

$user_id = $_SESSION['user_id'];

$customer = ShopCUL::getCustomerByID($_SESSION['user_id']);
$transactions = ShopCUL::getTransactionsByCustomer($customer);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Histórico compras</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div class="container">
			<h1>ShopCUL - Histórico Compras</h1>            
			<?php require 'inc/common/nav.php'; ?>
			<?php foreach($transactions as $transaction) { ?>
            <div class="row">
                <div class="span12">
                    <ul class="thumbnails">            
                        <h4 class="span3">Data: <?=$transaction->getPurchasedate();?></h4>
                        <h4 class="pull-right">Total: <?=$transaction->getTransactionTotal();?> €</h4>
                        <?php foreach ($transaction->getTransactionLines() as $transactionLine) {  
                        	$images = $transactionLine->getProduct()->getImages();
                        ?>
                        <li class="thumbnail span12" style="margin-bottom:10px;">
                            <img src="<?=(count($images) == 0 ? 'img/dummy-big.png' : $images[0]->getSource());?>" alt="" class="span2" style=" width: 60px; height: 60px;">
                            <div class="span9"> 
                                <div class="caption">
                        			<h5><?=$transactionLine->getProduct()->getName();?> - <?=$transactionLine->getPriceperunit();?> €</h5>
                                </div>
                            </div>
							<div class="span1"><b>Qtd:</b> <?=$transactionLine->getQuantity();?></div>
                            <div class="span1"><?=($transactionLine->getPriceperunit()*$transactionLine->getQuantity());?> €</div>
                       </li>
                       <?php } ?>
            		</ul>
                </div>
            </div>            	
			<?php } ?>
                    
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
            </div> -->
        </div>
    </body>
</html>