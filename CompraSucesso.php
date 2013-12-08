<?php
require 'inc/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Finalizar compra</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h1>ShopCUL - Compra sucesso</h1>        
            <?php require 'inc/common/nav.php'; ?>
            <div class="alert alert-success">
                <p><strong>A sua compra foi registada...</strong></p>
                Obrigado pela sua prefência.<br/>                
                ShopCUL
            </div>
        </div>
    </body>
</html>