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
            <div class="row">
                <div class="span12">
                    <h1>ShopCUL - Finalizar Compra</h1>            
                </div>
                <?php require 'inc/common/nav.php'; ?>
            </div>
            <div class="row">
                <div class="pull-right">
                    <h3>Total: xxxx,xx €</h3>     
                </div>
            </div>
            <div class="row">
                <form class="form-horizontal">
                    <div class="controls-row">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label">Produto:</label>
                                <label class="control-label">Galo de Barcelos</label>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputAddress">Morada</label>
                                <div class="controls">
                                    <input type="text" id="inputAddress" placeholder="Morada" class="input-xlarge" maxlength="255">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputNIF">Nº Contribuinte</label>
                                <div class="controls">
                                    <input type="text" id="inputNIF" placeholder="Nº Contribuinte" class="input-xlarge">
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
                                        <input type="text" id="inputCardNumber" placeholder="Nº Cartão" class="input-xlarge" maxlength="16">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputCS">Codigo de Segurança</label>
                                    <div class="controls">
                                        <input type="text" id="inputCS" placeholder="Codigo de Segurança" class="input-xlarge" maxlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group span6 offset2" id="paypalDetails" style="display: none;"> 
                                <!-- Display the payment button. -->  
                                <input type="image" name="submit" src="img/btn_subscribe_LG.gif"  
                                       alt="PayPal - The safer, easier way to pay online">
                            </div> 
                        </div>
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label" for="inputQuantity">Quantidade</label>
                                <div class="controls">
                                    <input type="number" id="inputQuantity" placeholder="" class="input-xlarge" min="1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputName">Nome</label>
                                <div class="controls">
                                    <input type="text" id="inputName" placeholder="Nome" class="input-xlarge" required maxlength="160">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputZipcode1">Código Postal</label>
                                <div class="controls controls-row">
                                    <input type="text" id="inputZipcode1" placeholder="Código" class="input-small" maxlength="12">
                                    <input type="text" id="inputZipcode2" placeholder="Localidade" class="input-medium pull-right" maxlength="60">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputMovel">Telemovel</label>
                                <div class="controls">
                                    <input type="text" id="inputMovel" placeholder="Telemovel" class="input-xlarge" pattern="9(1|2|3|6)\d{7}" maxlength="16">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Email</label>
                                <div class="controls">
                                    <input type="email" id="inputEmail" placeholder="Email" class="input-xlarge" maxlength="255">
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