<?php
//conexão com banco de dados
include_once("../action/db_connect.php");
//header
include_once("../includes/header.php");

$sql = "SELECT * FROM produtos WHERE codigo = '$pesquisa'";
$query = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($query);

$sqlV = "SELECT sum(quantidade) as Soma FROM vendas WHERE codigo_produto = '$pesquisa'";
$queryV = mysqli_query($connect,$sqlV);
$dadosV = mysqli_fetch_array($queryV);
$qtdVendas = $dadosV['Soma'];
$ganho = ($dados['preco'] * $qtdVendas);
$preco = $dados['preco'];

$date = "SELECT month(data_venda) as mes FROM vendas WHERE codigo_produto = '$pesquisa'";
$pesq = mysqli_query($connect,$date);
?>

<div id="curve_chart"></div>


<script src="https://www.gstatic.com/charts/loader.js"></script>
<script type='text/javascript'>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['MÊS', 'TOTAL'],
    <?php 
    while($data = mysqli_fetch_array($pesq)){
        $mes =  $data['mes'];
        $pes = "SELECT sum(distinct(quantidade)*'$preco') as Total FROM vendas WHERE codigo_produto = '$pesquisa' && month(data_venda) = '$mes'";
        $qu = mysqli_query($connect,$pes);

        switch ($mes) {
          case 4:
                $mes = "Abril";
            break;
          
          default:
            # code...
            break;
        }
        while ($dado = mysqli_fetch_array($qu)) {
            $total = $dado['Total'];
    ?>
    ['<?php  echo $mes;  ?>',<?php echo $total;  ?>],
    <?php }}  ?>
  ]);

  var options = {
    'legend':'right',
    'title':'My Big Pie Chart',
    'is3D':true,
    'width':530,
    'height':490
  }

  var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

  chart.draw(data, options);
}
</script>

<?php
//footer
include_once("../includes/footer.php");?>