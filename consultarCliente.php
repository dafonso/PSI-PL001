<?php 
require 'inc/init.php';

if($userLoggedIn) {
	header('Location: /');
	exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consultar Cliente</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>ShopCUL - Dados Pessoais</h1>            
                </div>
                <?php require 'inc/common/nav.php'; ?>
            </div>
            <div class="row">
                <form class="form-horizontal">
                    <div class="controls-row">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Morada</label>                                
                                <div class="controls">                                    
                                    <label id="inputAddress" class="control-label" style="text-align: left;">Rua do Norte 1</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nº Contribuinte</label>                                
                                <div class="controls">                                    
                                    <label id="inputNIF" class="control-label" style="text-align: left;">123456789</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Modo de Pagamento</label>                                
                                <div class="controls">                                    
                                    <label id="paymentMethod" class="control-label" style="text-align: left;">Cartão de Crédito</label>
                                </div>
                            </div>
                            <div class="control-group" id="ccDetails">
                                <div class="control-group">
                                    <label class="control-label">Nº Cartão</label>                                
                                    <div class="controls">                                    
                                        <label id="inputCardNumber" class="control-label" style="text-align: left;">xxx xxx xxx xxx</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Nome</label>                                
                                <div class="controls">                                    
                                    <label id="inputName" class="control-label" style="text-align: left;">Maria Silva</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Postal</label>                                
                                <div class="controls">                                    
                                    <label id="inputZipcode" class="control-label" style="text-align: left;">1000-100 Lisboa</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Telemovel</label>                                
                                <div class="controls">                                    
                                    <label id="inputMovel" class="control-label" style="text-align: left;">912 345 678</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>                                
                                <div class="controls">                                    
                                    <label id="inputEmail" class="control-label" style="text-align: left;">maria@fc.ul.pt</label>
                                </div>
                            </div>
                            <div class="control-group">                               
                                <label class="control-label">Alertas</label>                                
                                <div class="controls">                                    
                                    <label id="alerts" class="control-label" style="text-align: left;">SMS e Email : 2 dias</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="controls-row">
                        <div class="control-group span12">
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                                <button class="btn btn-danger">Voltar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>