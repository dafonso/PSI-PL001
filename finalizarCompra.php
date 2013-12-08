<?php 
require 'inc/init.php';

if(!isset($_REQUEST['product_id']) || !is_numeric($_REQUEST['product_id'])) {
	//header('Location: '.REDIRECT_URL_PATH);
	//exit;
}

$product_id = $_REQUEST['product_id'];

$product = ShopCUL::getProductByID($product_id);

if(isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$customer = ShopCUL::getCustomerByID($user_id);
} else {
	$customer = new Customer();
}

if(isset($_POST['product_id'])) {
	if(ShopCUL::createTransaction($customer, $product))
		header('Location: '.REDIRECT_URL_PATH.'compraSucesso.php');
}
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
        <script type="text/javascript">
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

	        function updateTotalPrice() {
				if($('#inputQuantity').val() > 0)
					$('#transactionTotal').html(Math.round(($('#sellPrice').val() * $('#inputQuantity').val()) * 100) / 100);
			}
        </script>
    </head>
    <body>
        <div class="container">
			<h1>ShopCUL - Finalizar Compra</h1>            
			<?php require 'inc/common/nav.php'; ?>
            <div class="row">
                <div class="pull-right">
                    <h3>Total: <span id="transactionTotal"><?=$product->getSellprice();?></span> €</h3>     
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI'];?>">
                	<input type="hidden" id="sellPrice" name="sellPrice" value="<?=$product->getSellprice();?>">
                	<input type="hidden" id="product_id" name="product_id" value="<?=$product->getId();?>">
                    <div class="controls-row">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Produto:</label>
                                <label class="control-label"><b><?=$product->getName();?></b></label>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputAddress">Morada</label>
                                <div class="controls">
                                    <input type="text" id="inputAddress" placeholder="Morada" class="input-xlarge" maxlength="255" value="<?=$customer->getAddresses()->getStreet();?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputNIF">Nº Contribuinte</label>
                                <div class="controls">
                                    <input type="text" id="inputNIF" placeholder="Nº Contribuinte" class="input-xlarge" value="<?=$customer->getNif();?>">
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
                                    	<input type="hidden" id="payoption_id" name="payoption_id" value="<?=$customer->getPayoption()->getId();?>">
                                        <input type="text" id="inputCardNumber" name="inputCardNumber"  placeholder="Nº Cartão" class="input-xlarge" maxlength="16" value="<?=$customer->getPayoption()->getCardnr();?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputExpiryDate">Data de Expiração</label>
                                    <div class="controls">
                                        <input type="text" id="inputExpiryDate" name="inputExpiryDate"  placeholder="mm/aa" class="input-small"  value="<?=$customer->getPayoption()->getExpirydate();?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputCS">Codigo de Segurança</label>
                                    <div class="controls">
                                        <input type="text" id="inputCS" name="inputCS"  placeholder="123" class="input-small" maxlength="3" value="<?=$customer->getPayoption()->getSecuritycode();?>">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group span6 offset2" id="paypalDetails" style="display: none;"> 
                                <input type="text" id="inputPaypalEmail" name="inputPaypalEmail"  placeholder="E-mail PayPal" class="input-xlarge" maxlength="255" value="<?=$customer->getPaypal();?>">
                            </div> 
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label" for="inputQuantity">Quantidade</label>
                                <div class="controls">
                                    <input type="number" id="inputQuantity" name="inputQuantity" placeholder="" class="input-xlarge" min="1" value="1" onchange="updateTotalPrice();">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputName">Nome</label>
                                <div class="controls">
                                    <input type="text" id="inputName" placeholder="Nome" class="input-xlarge" required maxlength="160"  value="<?=$customer->getName();?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputZipcode1">Código Postal</label>
                                <div class="controls controls-row">
                                    <input type="text" id="inputZipcode1" placeholder="Código" class="input-small" maxlength="12" value="<?=$customer->getAddresses()->getPostalcode();?>">
                                    <input type="text" id="inputZipcode2" placeholder="Localidade" class="input-medium pull-right" maxlength="60" value="<?=$customer->getAddresses()->getCity();?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputMovel">Telemovel</label>
                                <div class="controls">
                                    <input type="text" id="inputMovel" placeholder="Telemovel" class="input-xlarge" pattern="9(1|2|3|6)\d{7}" maxlength="16"  value="<?=$customer->getPhonenr();?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Email</label>
                                <div class="controls">
                                    <input type="email" id="inputEmail" placeholder="Email" class="input-xlarge" maxlength="255"  value="<?=$customer->getEmail();?>">
                                </div>
                            </div>
                            <div class="control-group">                               
                                <label class="control-label">Alertas</label>

                                <div class="controls controls-row">
                                    <label class="checkbox inline">
                                        <input type="checkbox" name="alertSMS" id="alertSms" value="sms"> SMS
                                    </label>
                                    <label class="checkbox inline">
                                        <input type="checkbox" name="alertEmail" id="alertEmail" value="email"> Email
                                    </label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputAlertDays">Nº Dias Anteriores</label>
                                <div class="controls">
                                    <input type="number" id="inputAlertDays" placeholder="" class="input-xlarge" min="1">
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
    </body>
</html>