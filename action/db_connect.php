<?php
$host="localhost";
$user="root";
$senha="";
$banco="store";

$connect = mysqli_connect($host, $user, $senha, $banco);
if (mysqli_connect_error()) {
    echo "Falha na conexão: ".mysqli_connect_error();
}