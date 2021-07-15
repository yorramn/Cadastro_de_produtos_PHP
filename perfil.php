<?php 
//conexão com banco de dados
include_once("action/db_connect.php");
//header
include_once("includes/header.php");
$msg = false;
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$query = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($query);
$img = "";

    if (isset($_FILES['arquivo'])) {
        $extensao = strtolower(substr($_FILES['arquivo']['name'],-4));
        $novo_nome = md5(time()).".$extensao";
        $diretorio = "action/arquivos/";
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        $img = '<img class="responsive-img" src="'.$diretorio.$novo_nome.'"'.'>';
    }
?>
 <section class="section container row">
  <div class="col s12 xl6">
    <div class="card-panel">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <div class="card-panel">
            <?php 
                if ($img != "") {
                    echo $img;
                }else{
                    echo "Nenhuma imagem selecionada";
                }
            ?>
        </div>
        <div class="file-field input-field">
            <div class="btn">
                <span>Arquivo</span>
                <input type="file" name="arquivo">    
            </div>
            <div class="file-path-wrapper">
                <input type="text" class="file-path">
            </div>
        </div>
        <input type="submit" value="+ Adicionar" class="btn right">
        <input type="submit" value="X Remover" class="btn right red">
        <div class="clearfix"></div>
    </form>
    </div>
    </div>
    <div class="col s12 xl6 card-panel">
    <div class="row ">
    <form class="col s12" method="post" action="action/update_perfil.php">
    <div class="purple-text lighten-3 center">
        <h3>MENU</h3>
    </div>
    <br>
    <span class="container">
      <div class="row">
        <div class="input-field ">
          <input id="id" type="text" class="validate" name="id" readonly value="<?php echo $dados['id'];  ?>">
          <label for="user">Id</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field ">
          <input id="id" type="text" class="validate" name="id" readonly value="<?php echo $dados['nome'];  ?>">
          <label for="user">Nome</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field ">
          <input id="id" type="text" class="validate" name="id" readonly value="<?php echo $dados['user'];  ?>">
          <label for="user">Login</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field ">
          <input id="email" type="text" class="validate" name="email" value="<?php echo $dados['email'];  ?>">
          <label for="email">Email</label>
        </div>
      </div>
            <button type="submit" name="salvar" class="btn right">Salvar</button>
      </div>
    </form>
    </span>
  </div>
    </div>
 </section>
<?php
//footer
include_once("includes/footer.php");
?>