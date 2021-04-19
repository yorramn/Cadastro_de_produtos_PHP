<?php
require_once 'db_connect.php';
session_start();
if (isset($_POST['enviar'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $preco = floatval($_POST['preco']);
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET nome = '$nome', preco = '$preco', quantidade = '$quantidade' WHERE codigo = '$codigo'";
    if (mysqli_query($connect,$sql)) {
        $_SESSION['mensagem'] = "Atualizado com sucesso!";
        header('Location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao Atualizar!";
        header('Location: ../index.php');
    }
}
