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
    </head>
    <body>
        <div class="container">
            <h1>ShopCUL - Compra sucesso</h1>        
            <?php require 'inc/common/nav.php'; ?>
            <div class="alert alert-success">
                <p><strong>Sucesso!!!</strong></p>Aguarde alguns segundos...
            </div>
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                setTimeout(function() {
                    window.location = "/~psi-pl001/";
                }, 2000);
            });
        </script>
    </body>
</html>