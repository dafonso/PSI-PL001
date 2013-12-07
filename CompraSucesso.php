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
            <h1>ShopCUL - Compra com sucesso</h1>        
            <?php require 'inc/common/nav.php'; ?>
            <div class="row">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Sucesso!!!</strong> Aguarde alguns segundos...
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location = "/~psi-pl001/";
            }, 1000);
        });
    </script>
</body>
</html>