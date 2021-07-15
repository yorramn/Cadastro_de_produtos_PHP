<?php
require_once 'db_connect.php';
session_start();
if (isset($_POST['salvar'])) {
    $id = $_SESSION['id'];
    $email = $_POST['email'];
    $extensao = strtolower(substr($_FILES['arquivo']['name'],-4));
    $novo_nome = md5(time()).".$extensao";
    $diretorio = "action/arquivos/";

    move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
    $sql = "INSERT INTO imagens_usuario (codigo,id_usuario,arquivo,data) VALUES (
        null,'$id','$novo_nome', NOW()
        
        )";
    $upar = "UPDATE usuario SET email = '$email' WHERE id = '$id'";

     if(mysqli_query($connect,$sql)){
         if (mysqli_query($connect,$upar)) {
            $_SESSION['mensagem'] = "Atualizado com sucesso!";
            header('Location: ../index.php'); 
         }
     }else{
        $_SESSION['mensagem'] = "Erro ao Atualizar!";
        header('Location: ../index.php');
     }
}
