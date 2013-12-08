<?php 
require '../inc/init.php';

if($adminLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>		
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12" style="height: 100px;">
                    <h1>ShopCUL - Admin Login</h1>            
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal" action="index.php" method="post" >
                    <div class="control-group">
                        <label class="control-label" for="inputSystemUsername">Username</label>
                        <div class="controls">
                            <input type="text" id="inputSystemUsername" name="inputSystemUsername" placeholder="Username" maxlength="60">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Password</label>
                        <div class="controls">
                            <input type="password" id="inputPassword" name="inputPassword" placeholder="Password" maxlength="40">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <label class="checkbox">
                                <input type="checkbox"> Remember me
                            </label>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a class="btn btn-danger" onclick="window.history.back()">Cancelar</a>
                            <?=(isset($_GET['loginFailed']) ? 'Dados fornecidos incorrectos' : '');?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>