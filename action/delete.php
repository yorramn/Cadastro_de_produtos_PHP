<?php
require_once 'db_connect.php';
session_start();
if (isset($_POST['deletar'])) {

    $codigo = $_POST['codigo'];
    $sql = "DELETE FROM produtos WHERE codigo = '$codigo'";

    if (mysqli_query($connect,$sql)) {
        $_SESSION['mensagem'] = "Excluído com sucesso!";
        header('Location: ../index.php');
    }else{
        $_SESSION['mensagem'] = "Erro ao excluir!";
        header('Location: ../index.php');
    }
}
