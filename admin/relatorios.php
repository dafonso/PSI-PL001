<!DOCTYPE html>

<?php 
require ('../inc/init.php');


defined('DB_SERVER') ? null : define("DB_SERVER", "//luna.di.fc.ul.pt/difcul.alunos.di.fc.ul.pt");
defined('DB_USER') ? null : define("DB_USER", "psi001pl");
defined('DB_PASS') ? null : define("DB_PASS", "Ps1PL001");

$queryTopCustomers = "
SELECT
customer.username,
customer.name,
customer.email,
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transaction
INNER JOIN transactionline ON transactionline.transaction_transaction_id = transaction.transaction_id
INNER JOIN customer ON customer.customer_id = transaction.customer_customer_id
WHERE rownum <= 5
GROUP BY transaction.customer_customer_id, customer.username, customer.name, customer.email
ORDER BY Total desc";


$conn = oci_connect(DB_USER, DB_PASS, DB_SERVER);

$stid = oci_parse($conn, $queryTopCustomers);
oci_execute($stid);


$relatorio_valor_1 = "";
while ($row = oci_fetch_array($stid)) {
	$relatorio_valor_1 .= ", ['" . $row[1] . "', " . $row[3] . "]";
}


echo $relatorio_valor_1;



?>

<html>
    <head>
        <title>Relatório</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
        <script type="text/javascript">
            function drawVisualization() {
                // relatorio 1
                // Some raw data (not necessarily accurate)
                var data = google.visualization.arrayToDataTable([
                    ['username', 'Total']
                    <?php echo $relatorio_valor_1; ?>
                ]);

                var options = {
                    title: 'Melhores Clientes da shopCUL',
                    vAxis: {title: "Compras €"},
                    hAxis: {title: "Nome"},
                    seriesType: "bars",
                    'height': 300
                };

                var chart = new google.visualization.ComboChart(document.getElementById('top5_clients'));
                chart.draw(data, options);

                // relatorio 2
                // Some raw data (not necessarily accurate)
                data = google.visualization.arrayToDataTable([
                    ['products', 'Total'],
                    ['doces', 16],
                    ['bilhetes', 15],
                    ['eventos', 17],
                    ['pastel nata', 19],
                    ['dança', 35]
                ]);

                options = {
                    title: 'Top 5 de produtos com maior numero de vendas',
                    vAxis: {title: "Quantidade"},
                    hAxis: {title: "Produto"},
                    seriesType: "bars",
                    'height': 300,                    
                    colors: ['#006600']
                };

                chart = new google.visualization.ComboChart(document.getElementById('top5_products'));
                chart.draw(data, options);

                //relatorio 3
                // Some raw data (not necessarily accurate)
                data = google.visualization.arrayToDataTable([
                    ['month', 'Total'],
                    ['Janeiro', 160],
                    ['Fevereiro', 105],
                    ['Março', 127],
                    ['Abril', 199],
                    ['Maio', 351]
                ]);

                options = {
                    title: 'Total de vendas mensais',
                    vAxis: {title: "Total"},
                    hAxis: {title: "Mês"},
                    seriesType: "bars",
                    'height': 300,
                    colors: ['#FF0000']
                };

                chart = new google.visualization.ComboChart(document.getElementById('total_by_month'));
                chart.draw(data, options);

                //relatorio 4
                // Some raw data (not necessarily accurate)
                data = google.visualization.arrayToDataTable([
                    ['year', 'Total'],
                    ['2011', 16022],
                    ['2012', 10512],
                    ['2013', 12712]
                ]);

                options = {
                    title: 'Total de vendas anuais',
                    vAxis: {title: "Total"},
                    hAxis: {title: "Ano"},
                    seriesType: "bars",
                    'height': 300,
                    colors: ['#FF9933']
                };

                chart = new google.visualization.ComboChart(document.getElementById('total_by_year'));
                chart.draw(data, options);

                //relatorio 5
                // Some raw data (not necessarily accurate)
                data = google.visualization.arrayToDataTable([
                    ['dayOfWeek', 'Total'],
                    ['2ª', 15],
                    ['3ª', 20],
                    ['4ª', 12],
                    ['5ª', 42],
                    ['6ª', 5],
                    ['sabado', 45],
                    ['domingo', 23]
                ]);

                options = {
                    title: 'Total de vendas semanal',
                    vAxis: {title: "Total"},
                    hAxis: {title: "Dia de semana"},
                    seriesType: "bars",
                    'height': 300,
                    colors: ['#339999']
                };

                chart = new google.visualization.ComboChart(document.getElementById('total_by_day_of_week'));
                chart.draw(data, options); 
                
                
                
                //relatorio 6
                // Some raw data (not necessarily accurate)
                data = google.visualization.arrayToDataTable([
                    ['city', 'Total'],
                    ['Lisboa', 1602],
                    ['Porto', 1052],
                    ['Coimbra', 1712]
                ]);

                options = {
                    title: 'Total de vendas por cidade',
                    vAxis: {title: "Total"},
                    hAxis: {title: "Cidade"},
                    seriesType: "bars",
                    'height': 300,
                    colors: ['#C0C0C0']
                };

                chart = new google.visualization.ComboChart(document.getElementById('total_by_city'));
                chart.draw(data, options); 
            }
            google.setOnLoadCallback(drawVisualization);
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h1>ShopCUL - Relatórios</h1>            
                </div>
                <?php require ('../inc/common/nav.php'); ?>
            </div>   

            <div class="row">
                <div class="span12">
                    <h2>Relatório 1</h2>            
                </div>
            </div> 
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="top5_clients"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>eneves</td>
                                <td>Emanuel</td>
                                <td>neves.emanuel@gmail.com</td>
                                <td>100,00€</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>eneves</td>
                                <td>Emanuel</td>
                                <td>neves.emanuel@gmail.com</td>
                                <td>100,00€</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>eneves</td>
                                <td>Emanuel</td>
                                <td>neves.emanuel@gmail.com</td>
                                <td>100,00€</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>            
            <div class="row">
                <div class="span12">
                    <h2>Relatório 2</h2>            
                </div>
            </div>  
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="top5_products"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Quantidade Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>doces</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>bilhetes</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>eventos</td>
                                <td>17</td>
                            </tr>
                            <tr>
                                <td>pastel nata</td>
                                <td>19</td>
                            </tr>
                            <tr>
                                <td>dança</td>
                                <td>35</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>                        
            <div class="row">
                <div class="span12">
                    <h2>Relatório 3</h2>            
                </div>
            </div>  
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="total_by_month"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span3">
                    <label class="control-label">Ano</label>
                    <select>
                        <option>2011</option>
                        <option>2012</option>
                        <option>2013</option>
                    </select>
                </div>
                <div class="span9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mês</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Janeiro</td>
                                <td>160</td>
                            </tr>
                            <tr>
                                <td>Fevereiro</td>
                                <td>105</td>
                            </tr>
                            <tr>
                                <td>Março</td>
                                <td>127</td>
                            </tr>
                            <tr>
                                <td>Abril</td>
                                <td>199</td>
                            </tr>
                            <tr>
                                <td>Maio</td>
                                <td>351</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>                        
            <div class="row">
                <div class="span12">
                    <h2>Relatório 4</h2>            
                </div>
            </div>  
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="total_by_year"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Ano</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2011</td>
                                <td>16022</td>
                            </tr>
                            <tr>
                                <td>2012</td>
                                <td>10512</td>
                            </tr>
                            <tr>
                                <td>2013</td>
                                <td>12712</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>                        
            <div class="row">
                <div class="span12">
                    <h2>Relatório 5</h2>            
                </div>
            </div>  
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="total_by_day_of_week"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span3">
                    <label class="control-label">Ano</label>
                    <select>
                        <option>2011</option>
                        <option>2012</option>
                        <option>2013</option>
                    </select>
                    <label class="control-label">Semana</label>
                    <select>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                    </select>
                </div>
                <div class="span9">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Dia da semana</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2ª</td>
                                <td>15</td>
                            </tr>
                            <tr>
                                <td>3ª</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>4ª</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>5ª</td>
                                <td>42</td>
                            </tr>
                            <tr>
                                <td>6ª</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>sabado</td>
                                <td>45</td>
                            </tr>
                            <tr>
                                <td>domingo</td>
                                <td>23</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>                       
            <div class="row">
                <div class="span12">
                    <h2>Relatório 6</h2>            
                </div>
            </div>  
            <div class="row">
                <div class="span12">
                    <!--Div that will hold the pie chart-->
                    <div id="total_by_city"></div>
                </div>
            </div> 
            <div class="row">
                <div class="span12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cidade</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lisboa</td>
                                <td>1602</td>
                            </tr>
                            <tr>
                                <td>Porto</td>
                                <td>1052</td>
                            </tr>
                            <tr>
                                <td>Coimbra</td>
                                <td>1712</td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>   
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>