<?php
//conexão com banco de dados
include_once("action/db_connect.php");
//header
include_once("includes/header.php");
session_start();
if (isset($_POST['procurar']) && isset($_POST['query'])) {
    $pesquisa = $_POST['query'];
    $sql = "SELECT * FROM produtos WHERE codigo = '$pesquisa' OR nome = '$pesquisa'";
    $query = mysqli_query($connect,$sql);
    $dados = mysqli_fetch_array($query);
    
}
$sql = "SELECT * FROM produtos WHERE codigo = '$pesquisa' OR nome = '$pesquisa'";
$query = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($query);

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

<section class="container">

<div class="center-align pink lighten-3">
  <h3>MENU</h3>
</div>

<span class="row" id="test1">
    <div class="col s12 xl6">
        <div class="row card-panel hoverable grey pink lighten-5 center">
            <div class="col s6 xl6 purple-text text-darken-2">
                <h5>
                    CÓDIGO:
                </h5>
            </div>
            <div class="col s6 xl6">
                <h5>
                    <?php echo $dados['codigo']  ?>
                </h5>
            </div>
        </div>
        <div class="row card-panel hoverable grey pink lighten-5 center">
        <div class="col s6 xl6 purple-text text-darken-2">
                <h5>
                    NOME:
                </h5>
            </div>
            <div class="col s6 xl6">
                <h5>
                    <?php echo $dados['nome']  ?>
                </h5>
            </div>
        </div>
        <div class="row card-panel hoverable grey pink lighten-5 center">
        <div class="col s6 xl6 purple-text text-darken-2">
                <h5>
                    PREÇO:
                </h5>
            </div>
            <div class="col s6 xl6">
                <h5>
                    <?php echo "R$".$dados['preco']  ?>
                </h5>
            </div>
        </div>
        <div class="row card-panel hoverable grey pink lighten-5 center">
        <div class="col s6 xl6 purple-text text-darken-2">
                <h5>
                    QUANTIDADE:
                </h5>
            </div>
            <div class="col s6 xl6">
                <h5>
                    <?php echo $dados['quantidade']  ?>
                </h5>
            </div>
        </div>
    </div>
    <div class="col s12 xl6">
        <div id="curve_chart"></div>
    </div>
</span>

</section>


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
          case 1:
                $mes = "Janeiro";
            break;
            case 2:
                $mes = "Fevereir";
            break;
            case 3:
                $mes = "Março";
            break;
            case 4:
                $mes = "Abril";
            break;
            case 5:
                $mes = "Maio";
            break;
            case 6:
                $mes = "Junho";
            break;
            case 7:
                $mes = "Julho";
            break;
            case 8:
                $mes = "Agosto";
            break;
            case 9:
                $mes = "Setembro";
            break;
            case 10:
                $mes = "Outubro";
            break;
            case 11:
                $mes = "Novembro";
            break;
            case 12:
                $mes = "Dezembro";
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
include_once("includes/footer.php");?>