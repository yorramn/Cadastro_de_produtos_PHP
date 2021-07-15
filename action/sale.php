<?php
require_once 'db_connect.php';
session_start();

if (isset($_POST['enviar'])) {
    $forma = $_POST['forma'];
    
    $id = $_POST['id_funcionario'];
    $codigo = $_POST['codigo'];
    $quantidadeC = $_POST['quantidadeC'];
    $qtd = $_POST['quantidade'];
    $resultado =  $qtd - $quantidadeC;

    $sql = "UPDATE produtos SET  quantidade = '$resultado' WHERE codigo = '$codigo'";

    $venda = "INSERT INTO vendas (codigo_produto,codigo_funcionario,forma_pagamento,quantidade,data_venda) VALUES('$codigo','$id','$forma','$quantidadeC',NOW())";
    
    if (mysqli_query($connect,$sql) && mysqli_query($connect,$venda)) {
        $_SESSION['mensagem'] = "Vendida realizada com sucesso!";
        header('Location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao realizar a venda!";
        header('Location: ../index.php');
    }
}
