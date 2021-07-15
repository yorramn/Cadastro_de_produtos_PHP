<?php
//conexão com banco de dados
include_once("db_connect.php");
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $valor = $_POST['valor'];
    $parametro = $_POST['parametro'];
    $regra = $_POST['regra'];
    $sql = "INSERT INTO descontos (nome,cod_funcionario,codigo,opcao,valor,regra) VALUES (
        '$nome',
        '$id',
        '$codigo',
        '$parametro',
        '$valor',
        '$regra')";
    if (mysqli_query($connect,$sql)) {
        $_SESSION['mensagem'] = "Cupom cadastrado!";
        header('Location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar cupom!";
        header('Location: ../index.php');
    }
    
}