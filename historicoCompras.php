<?php 
require 'inc/init.php';

if(!$userLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Histórico compras</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>ShopCUL - Histórico Compras</h1>            
                </div>
                <?php require 'inc/common/nav.php'; ?>
            </div>   
            <div class="row">
                <div class="span12">
                    <ul class="thumbnails">
                        <li class="thumbnail span12">
                            <img src="img/dummy.png" alt="" class="span2">
                            <div class="span7"> 
                                <div class="caption">
                                    <h3>Thumbnail label</h3>
                                    <div style="max-height: 60px;overflow-y: scroll;">Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                    </div>                                
                                </div>
                            </div>
                            <div class="span3">
                                <p class="lead">Total: xxx,xx€</p>
                                <p class="lead">Quantidade: 1</p>
                                <p>Data: 30-11-2013</p>
                            </div>
                        </li>
                        <li class="thumbnail span12">
                            <img src="img/dummy.png" alt="" class="span2">
                            <div class="span7"> 
                                <div class="caption">
                                    <h3>Thumbnail label</h3>
                                    <div style="max-height: 60px;overflow-y: scroll;">Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                    </div>                                
                                </div>
                            </div>
                            <div class="span3">
                                <p class="lead">Total: xxx,xx€</p>
                                <p class="lead">Quantidade: 1</p>
                                <p>Data: 30-11-2013</p>
                            </div>
                        </li>
                        <li class="thumbnail span12">
                            <img src="img/dummy.png" alt="" class="span2">
                            <div class="span7"> 
                                <div class="caption">
                                    <h3>Thumbnail label</h3>
                                    <div style="max-height: 60px;overflow-y: scroll;">Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                        Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
                                        Donec id elit non mi porta gravida at eget metus.
                                        Nullam id dolor id nibh ultricies vehicula ut id elit.
                                    </div>                                
                                </div>
                            </div>
                            <div class="span3">
                                <p class="lead">Total: xxx,xx€</p>
                                <p class="lead">Quantidade: 1</p>
                                <p>Data: 30-11-2013</p>
                            </div>
                        </li>
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
            </div> -->
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>