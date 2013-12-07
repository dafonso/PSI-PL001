<?php 
require 'inc/init.php';

if(!$userLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}

$customer = ShopCUL::getCustomerByID($_SESSION['user_id']);
//$payoption = ShopCUL::getPayOptionByCustomer($customer);
//$address = ShopCUL::getAddressByCustomer($customer);

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
			<h1>ShopCUL - Dados Pessoais</h1>            
			<?php require 'inc/common/nav.php'; ?>
            <div class="row">
                <form class="form-horizontal">
                    <div class="controls-row">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Morada</label>                                
                                <div class="controls">                                    
                                    <label id="inputAddress" class="control-label" style="text-align: left;"><?=$customer->getAddresses()->getStreet();?></label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nº Contribuinte</label>                                
                                <div class="controls">                                    
                                    <label id="inputNIF" class="control-label" style="text-align: left;"><?=$customer->getNif();?></label>
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
                                        <label id="inputCardNumber" class="control-label" style="text-align: left;"><?=$customer->getPayoption()->getHiddenCardnr();?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Nome</label>                                
                                <div class="controls">                                    
                                    <label id="inputName" class="control-label" style="text-align: left;"><?=$customer->getName();?></label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Código Postal</label>                                
                                <div class="controls">                                    
                                    <label id="inputZipcode" class="control-label" style="text-align: left;"><?=$customer->getAddresses()->getPostalcode();?> <?=$customer->getAddresses()->getCity();?></label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Telemovel</label>                                
                                <div class="controls">                                    
                                    <label id="inputMovel" class="control-label" style="text-align: left;"><?=$customer->getPhonenr();?></label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>                                
                                <div class="controls">                                    
                                    <label id="inputEmail" class="control-label" style="text-align: left;"><?=$customer->getEmail();?></label>
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
                                <a class="btn btn-danger" onclick="window.history.back();">Voltar</a>
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