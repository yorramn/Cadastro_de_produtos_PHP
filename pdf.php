<?php
use Dompdf\Dompdf;
require_once './dompdf/autoload.inc.php';
//instanciando

//conexão com banco de dados
include_once("action/db_connect.php");
$html = '';
$html .= '<style>
                table{
                        position: relative;
                        width:100%;
                        text-align: center;
                }

            </style>';
$html .= '<table border=1> ';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<td>Código</td>';
$html .= '<td>Nome</td>';
$html .= '<td>Preço</td>';
$html .= '<td>Quantidade</td>';
$html .= '</tr>';
$html .= '</thead>';
$sql = "SELECT * FROM produtos";
$result = mysqli_query($connect,$sql);

    while($dados = mysqli_fetch_assoc($result)) {
        $html .= '<tbody>';
        $html .='<tr><td>'. $dados['codigo'].'</td>';
        $html .='<td>'. $dados['nome'].'</td>';
        $html .='<td>'. $dados['preco'].'</td>';
        $html .='<td>'. $dados['quantidade'].'</tr></td>';
        $html .= '</tbody>';
    }
    $html .= '</table>';
$dompdf = new DOMPDF();
$dompdf->load_html("
    <h1>ESTOQUE</h1>".$html.'
');
//renderiza
$dompdf->render();

//exibe a página
$dompdf->stream(
    "relatorio_de_estoque.pdf",
    array(
        "Attachment" => false //
    )
);