<!DOCTYPE html>

<?php 
require ('../inc/init.php');


defined('DB_SERVER') ? null : define("DB_SERVER", "//luna.di.fc.ul.pt/difcul.alunos.di.fc.ul.pt");
defined('DB_USER') ? null : define("DB_USER", "psi001pl");
defined('DB_PASS') ? null : define("DB_PASS", "Ps1PL001");
$conn = oci_connect(DB_USER, DB_PASS, DB_SERVER);


/*Relatorio 1*/
$queryTopCustomers = "
SELECT
customer.username,
customer.name,
customer.email,
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transaction
INNER JOIN transactionline ON transactionline.transaction_transaction_id = transaction.transaction_id
INNER JOIN customer ON customer.customer_id = transaction.customer_customer_id
GROUP BY transaction.customer_customer_id, customer.username, customer.name, customer.email
ORDER BY Total desc";

$stid = oci_parse($conn, $queryTopCustomers);
oci_execute($stid);

$relatorio_valor_1 = "";
$tabela_valor_1 = "";
$i = 0;
while ($row = oci_fetch_array($stid)) {
	$relatorio_valor_1 .= ", ['" . $row[1] . "', " . $row[3] . "]";
	// $tabela_valor_1 .= "<tr>";
	// $show = true;
	// foreach ($row as $cell) {
		// if ($show){
			// $tabela_valor_1 .= "<td>" . $cell . "</td>";
		// }	
		// $show = !$show;
// 		
	// }
	// $tabela_valor_1 .= "</tr>";
		if (!($i++ < 5)){
		break;
	}
}

/*Relatorio 2*/
$queryTopProducts = "
SELECT 
product.name,
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transactionline
INNER JOIN product ON product.product_id = transactionline.product_product_id
GROUP BY transactionline.product_product_id, product.name
ORDER BY Total desc";

$stid = oci_parse($conn, $queryTopProducts);
oci_execute($stid);

$relatorio_valor_2 = "";
$i = 0;
while ($row = oci_fetch_array($stid)) {
	$relatorio_valor_2 .= ", ['" . $row[0] . "', " . $row[1] . "]";
	if (!($i++ < 5)){
		break;
	}
}

/*Relatorio 3*/
$queryAllMonths = "
SELECT 
trunc(transaction.purchasedate,'mm'),
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transactionline
INNER JOIN transaction ON transaction.transaction_id = transactionline.transaction_transaction_id
GROUP BY trunc(transaction.purchasedate,'mm')
ORDER BY trunc(transaction.purchasedate,'mm')";

$stid = oci_parse($conn, $queryAllMonths);
oci_execute($stid);

$relatorio_valor_3 = "";
while ($row = oci_fetch_array($stid)) {
	$date = strtotime($row[0]);
	$relatorio_valor_3 .= ", ['" . date("M Y", $date) . "', " . $row[1] . "]";
}

/*Relatorio 4*/
$queryAllYears = "
SELECT 
trunc(transaction.purchasedate,'yy'),
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transactionline
INNER JOIN transaction ON transaction.transaction_id = transactionline.transaction_transaction_id
GROUP BY trunc(transaction.purchasedate,'yy')
ORDER BY trunc(transaction.purchasedate,'yy')";

$stid = oci_parse($conn, $queryAllYears);
oci_execute($stid);

$relatorio_valor_4 = "";
while ($row = oci_fetch_array($stid)) {
	$date = strtotime($row[0]);
	$relatorio_valor_4 .= ", ['" . date("Y", $date) . "', " . $row[1] . "]";
}

/*Relatorio 5*/
$queryAllWeekDays = "
SELECT TO_CHAR(transaction.purchasedate, 'D') WEEKDAY,
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transactionline
INNER JOIN transaction ON transaction.transaction_id = transactionline.transaction_transaction_id
GROUP BY TO_CHAR(transaction.purchasedate, 'D')
ORDER BY TO_CHAR(transaction.purchasedate, 'D')";

$stid = oci_parse($conn, $queryAllWeekDays);
oci_execute($stid);

$allWeekDays = array(
	"1" => array("Domingo", 0),
	"2" => array("Segunda", 0),
	"3" => array("Terça", 0),
	"4" => array("Quarta", 0),
	"5" => array("Quinta", 0),
	"6" => array("Sexta", 0),
	"7" => array("Sabado", 0)
	);
	


while ($row = oci_fetch_array($stid)) {
	$allWeekDays[$row[0]][1] = $row[1];
}

$relatorio_valor_5 = "";
foreach ($allWeekDays as $day_and_value) {
	$relatorio_valor_5 .= ", ['" . $day_and_value[0] . "', " . $day_and_value[1] . "]";
}

/*Relatorio 6*/
$queryTopCities = "
SELECT 
address.city,
sum(transactionline.quantity * transactionline.priceperunit) as Total
FROM transactionline
INNER JOIN product ON product.product_id = transactionline.product_product_id
INNER JOIN transaction ON transaction.transaction_id = transactionline.transaction_transaction_id
INNER JOIN customer_address ON customer_address.customer_customer_id = transaction.customer_customer_id
INNER JOIN address ON address.address_id = customer_address.address_address_id
GROUP BY address.city
ORDER BY Total desc";

$stid = oci_parse($conn, $queryTopCities);
oci_execute($stid);

$relatorio_valor_6 = "";
$i = 0;
while ($row = oci_fetch_array($stid)) {
	$relatorio_valor_6 .= ", ['" . $row[0] . "', " . $row[1] . "]";
	if (!($i++ < 5)){
		break;
	}
}

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
                    ['Nome', 'Total']
                    <?php echo $relatorio_valor_1; ?>
                ]);

                var options = {
                    title: 'Top de Clientes da shopCUL',
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
                    ['Produto', 'Total']
                    <?php echo $relatorio_valor_2; ?>
                ]);

                options = {
                    title: 'Top de Produtos da shopCUL',
                    vAxis: {title: "Vendas €"},
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
                    ['Mês', 'Total']
                    <?php echo $relatorio_valor_3; ?>
                ]);

                options = {
                    title: 'Total de vendas mensais',
                    vAxis: {title: "Total €"},
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
                    ['year', 'Total']
                    <?php echo $relatorio_valor_4; ?>
                ]);

                options = {
                    title: 'Total de vendas anuais',
                    vAxis: {title: "Total €"},
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
                    ['dayOfWeek', 'Total']
                    <?php echo $relatorio_valor_5; ?>
                ]);

                options = {
                    title: 'Total de vendas por dia da semana',
                    vAxis: {title: "Total €"},
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
                    ['city', 'Total']
                    <?php echo $relatorio_valor_6; ?>
                ]);

                options = {
                    title: 'Top de Cidades da shopCUL',
                    vAxis: {title: "Total €"},
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
        </div>
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>