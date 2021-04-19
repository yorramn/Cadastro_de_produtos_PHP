<?php 
//conexão com banco de dados
include_once("action/db_connect.php");

$msg = false;
session_start();
$id = $_SESSION['id'];


    if (isset($_FILES['arquivo'])) {
        $extensao = strtolower(substr($_FILES['arquivo']['name'],-4));
        $novo_nome = md5(time()).".$extensao";
        $diretorio = "action/arquivos/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);


        $sql = "INSERT INTO imagens_usuario (codigo,id_usuario,arquivo,data) VALUES (
            null,'$id','$novo_nome', NOW()
            
            )";

         if(mysqli_query($connect,$sql)){
            $msg = "Deu certo";
         }else{
             $msg = "Deu errado";
         }
         $code = "SELECT * FROM imagens_usuario";
         $query = mysqli_query($connect,$code);
         $codigos = mysqli_fetch_array($query);
         $codigo = $codigos['codigo'];
            $sql = "SELECT * FROM imagens_usuario WHERE codigo = '$codigo'";
            $query = mysqli_query($connect,$sql);
              while ($dados = mysqli_fetch_array($query)) {
                    echo '<img src="'.$diretorio.$dados['arquivo'].'"'.'>';
            }
        
        
    }

?>
<h1>Upload de imagens</h1>
<?php  if($msg != false){echo $msg;}  ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    Arquivo: <input type="file" name="arquivo" >
    <input type="submit" value="Salvar">
</form>

<?php
//footer
include_once("includes/footer.php");
?>