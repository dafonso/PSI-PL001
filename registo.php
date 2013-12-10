<?php 
require 'inc/init.php';

if($userLoggedIn) {
	header('Location: '.REDIRECT_URL_PATH);
	exit;
}

$userRegistered = false;

if(isset($_POST['inputUsername'])) {
	ShopCUL::createCustomer();
	$userRegistered = true;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registo de Cliente</title>		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/stickyfooter.css" rel="stylesheet" media="screen">
    </head>
    <body>
    	<div id="wrap">
	        <div class="container">
				<h1>ShopCUL</h1>            
				<?php require 'inc/common/nav.php'; ?>
				<ul class="breadcrumb">
				  <li><a href="<?=REDIRECT_URL_PATH;?>">Home</a> <span class="divider">/</span></li>
				  <li class="active">Registo de Cliente</li>
				</ul>
            	<?php if($userRegistered == true) { ?>
            	<div class="alert alert-success">Utilizador Registado</div>
            	<?php } ?>				
	            <div class="row">
	                <form id="teste" class="form-horizontal" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
	                    <div class="controls-row">
	                        <div class="span6">
	                            <div class="control-group">
	                                <label class="control-label" for="inputUsername">Username</label>
	                                <div class="controls">
	                                    <input type="text" id="inputUsername" name="inputUsername"  placeholder="Username" required class="input-xlarge" maxlength="60">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputAddress">Morada</label>
	                                <div class="controls">
	                                    <input type="text" id="inputAddress" name="inputAddress"  placeholder="Morada" class="input-xlarge" maxlength="255">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputNIF">Nº Contribuinte</label>
	                                <div class="controls">
	                                    <input type="text" id="inputNIF" name="inputNIF"  placeholder="Nº Contribuinte" class="input-xlarge" pattern="[1-9][0-9]{8}" maxlength="9">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label">Modo de Pagamento</label>
	                                <label class="checkbox inline">
	                                    <input type="radio" name="paymentMethod" id="paymentMethod1" value="paypal"> PayPal
	                                </label>
	                                <label class="checkbox inline">
	                                    <input type="radio" name="paymentMethod" id="paymentMethod2" value="creditCard" checked="checked"> Cartão de Crédito
	                                </label>
	                            </div>
	                            <div class="control-group" id="ccDetails">
	                                <div class="control-group">
	                                    <label class="control-label" for="inputCardNumber">Nº Cartão</label>
	                                    <div class="controls">
	                                        <input type="text" id="inputCardNumber" name="inputCardNumber"  placeholder="Nº Cartão" class="input-xlarge" maxlength="16" pattern="[0-9]{16}">
	                                    </div>
	                                </div>
	                                <div class="control-group">
	                                    <label class="control-label" for="inputExpiryDate">Data de Expiração</label>
	                                    <div class="controls">
	                                        <input type="text" id="inputExpiryDate" name="inputExpiryDate"  placeholder="mm/aa" class="input-small" pattern="^(0[1-9]|1[1-2])/(1[3-9]|2[0-9])$">
	                                    </div>
	                                </div>
	                                <div class="control-group">
	                                    <label class="control-label" for="inputCS">Codigo de Segurança</label>
	                                    <div class="controls">
	                                        <input type="text" id="inputCS" name="inputCS"  placeholder="123" class="input-small" maxlength="3" pattern="[0-9]{3}">
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="control-group" id="paypalDetails" style="display: none;"> 
	                                <label class="control-label" for="inputPaypalEmail">E-mail PayPal</label>
                                    <div class="controls">
                                        <input type="email" id="inputPaypalEmail" name="inputPaypalEmail"  placeholder="E-mail PayPal" class="input-xlarge" maxlength="255">
                                    </div>
	                            </div> 
	                        </div>
	                        <div class="span6">
	                            <div class="control-group">
	                                <label class="control-label" for="inputName">Nome</label>
	                                <div class="controls">
	                                    <input type="text" id="inputName" name="inputName"  placeholder="Nome" class="input-xlarge" required maxlength="160">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputZipcode1">Código Postal</label>
	                                <div class="controls controls-row">
	                                    <input type="text" id="inputZipcode1" name="inputZipcode1"  placeholder="Código" class="input-small" maxlength="8" pattern="^(\d{4}|\d{4}-\d{3})$">
	                                    <input type="text" id="inputCity" name="inputCity"  placeholder="Localidade" class="input-medium pull-right" maxlength="60">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputMovel">Telemovel</label>
	                                <div class="controls">
	                                    <input type="text" id="inputMovel" name="inputMovel"  placeholder="Telemovel" class="input-xlarge" pattern="9(1|2|3|6)\d{7}" maxlength="16">
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputEmail">Email</label>
	                                <div class="controls">
	                                    <input type="email" id="inputEmail" name="inputEmail" placeholder="Email" class="input-xlarge" required maxlength="255">
	                                </div>
	                            </div>
	                            <div class="control-group">                               
	                                <label class="control-label">Alertas</label>
	
	                                <div class="controls controls-row">
	                                    <label class="checkbox inline">
	                                        <input type="checkbox" name="alertSMS" id="alertSms" name="alertSms"  value="sms"> SMS
	                                    </label>
	                                    <label class="checkbox inline">
	                                        <input type="checkbox" name="alertEmail" id="alertEmail" value="email"> Email
	                                    </label>
	                                </div>
	                            </div>
	                            <div class="control-group">
	                                <label class="control-label" for="inputAlertDays">Nº Dias Anteriores</label>
	                                <div class="controls">
	                                    <input type="number" id="inputAlertDays" name="inputAlertDays"  placeholder="" class="input-xlarge" min="1">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="controls-row">
	                        <div class="control-group span12">
	                            <div class="controls">
	                                <button type="submit" class="btn btn-primary">Confirmar</button>
	                                <button class="btn btn-danger">Cancelar</button>
	                            </div>
	                        </div>
	                    </div>
	                </form>
	            </div>
	        </div>
        </div>
        <div id="footer" class="footer">
	      <div class="container">
	        <p class="muted credit">© ShopCUL 2013</p>
	      </div>
	    </div>
	    <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input[name="paymentMethod"]').change(function() {
                    if ($(this).val() === 'paypal') {
                        $('#ccDetails').hide();
                        $('#paypalDetails').show();
                    } else {
                        $('#ccDetails').show();
                        $('#paypalDetails').hide();
                    }
                });
            });
        </script>
    </body>
</html>