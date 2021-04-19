<?php
//conexão com banco de dados
include_once("db_connect.php");

if(isset($_FILES['upar'])){
    $formatos = array("png","jpg","jpeg");
    $extensao = pathinfo($_FILES['arquivo']['name'],pathinfo_extension);
    echo $extensao;
    
}
