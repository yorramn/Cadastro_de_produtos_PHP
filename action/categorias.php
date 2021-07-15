<?php
//conexão com banco de dados
include_once("../action/db_connect.php");
 
if (isset($_POST['categorizar'])) {
    $nome = $_POST['nome'];
    $sql = "INSERT INTO categorias (nome) VALUES(
        '$nome'
    )";
        if (mysqli_query($connect,$sql)) {
            $_SESSION['mensagem'] = "Categoria cadastrada com sucesso!";
            header('Location: ../index.php');
        }else{
            $_SESSION['mensagem'] = "Erro ao cadastrar a categoria!";
            header('Location: ../index.php');
        }
}