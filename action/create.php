<?php
require_once 'db_connect.php';
session_start();
if (isset($_POST['enviar'])) {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco = floatval($_POST['preco']);
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO produtos (codigo,nome,preco,quantidade,categoria) VALUES(
        '$codigo',
        '$nome',
        '$preco',
        '$quantidade',
        '$categoria'
    )";
    if (mysqli_query($connect,$sql)) {
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../index.php');
    }
}
