<?php
//conexão com banco de dados
include_once("../action/db_connect.php");
session_unset();
session_start();
//validando o botão
if (isset($_POST['entrar'])) {
    $user = mysqli_escape_string($connect,$_POST['user']);
    $senha = mysqli_escape_string($connect,$_POST['senha']);
    $cargo = $_POST['cargo'];
        $pesquisa = "SELECT user FROM usuario WHERE user = '$user'";
        $resultado = mysqli_query($connect,$pesquisa);
        if (mysqli_num_rows($resultado)>0) {
            $query = "SELECT * FROM usuario WHERE user = '$user' AND senha = md5('$senha') and cargo = '$cargo'";
            $result = mysqli_query($connect,$query);
            if (mysqli_num_rows($result)==1) {
               $dados = mysqli_fetch_array($result);
               $_SESSION['cargo'] = $dados['cargo'];
               $_SESSION['logado'] = true;
               $_SESSION['id'] = $dados['id'];
               header('location: ../index.php');
            }else{
                header('location: ../home.php');
            }
        }else{
            header('location: ../home.php');
        }
    }
?>