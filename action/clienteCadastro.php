<?php
//conexão com banco de dados
include_once("db_connect.php");

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $doc = $_POST['doc'];
    $cep = $_POST['cep'];

    $sql = "INSERT INTO clientes (nome,doc,cep) VALUES ('$nome','$doc','$cep')";

    if (mysqli_query($connect,$sql)) {
        $_SESSION['mensagem'] = "Cadastrado com sucesso!";
        header('Location: ../encomendar.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao cadastrar!";
        header('Location: ../encomendar.php');
    }
}