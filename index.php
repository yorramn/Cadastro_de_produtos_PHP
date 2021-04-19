<?php
//conexão com banco de dados
include_once("action/db_connect.php");
//mensagem
include_once("includes/mensagem.php");
//header
include_once("includes/header.php");
session_start();
if (!isset($_SESSION['logado'])) {
    header("Location: home.php");
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$resultado = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($resultado);


?>
<div class="container center-align pink lighten-3">
  <h3>MENU</h3>
</div>
<section class="row container right-align">
<ul id="dropdown2" class="dropdown-content">
    <li><a href="perfil.php">My profile</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
  <a class="btn dropdown-trigger" href="#!" data-target="dropdown2">Bem vindo, 
    <?php  echo $dados['nome'] ?>
    <i class="material-icons right">arrow_drop_down</i></a>
</section>
<table class="centered highlight container">
<div class="row  container">
  <div class="row right">
  <span class="col s12 xl9 ">
    <input type="text">
  </span>
  <span class="col s12 xl3">
    <a href="#modal" class="btn-floating ">
    <i class="material-icons ">search</i></a>
  </span>
  </div>
</div>
<thead>
    <th>Código</th>
    <th>Nome</th>
    <th>Preço</th>
    <th>Quantidade</th>
    <th>
        <a href="adicionar.php" class="btn-floating">
        <i class="material-icons">add</i></a>
        <p>Adicionar</p>
        
    </th>
    <th>
        <a href="pdf.php" target="_blank" class="btn-floating grey">
        <i class="material-icons">print</i></a>
        <p>PDF</p>
        
    </th>
    
    
</thead>

<tbody>
<?php 
    $sql = "SELECT * FROM produtos ORDER BY preco DESC";
    $result = mysqli_query($connect,$sql);
    while ($dados = mysqli_fetch_array($result)) {
?>
    <tr>
        <td><?php echo $dados['codigo']?></td>
        <td><?php echo $dados['nome']?></td>
        <td><?php echo "R$".$dados['preco']?></td>
        <td><?php echo $dados['quantidade']?></td>
        <td><a href="editar.php?codigo=<?php echo $dados['codigo']?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
        <td><a href="vender.php?codigo=<?php echo $dados['codigo']?>" class="btn-floating purple"><i class="material-icons">business_center</i></a></td>
        <td><a href="#modal<?php echo $dados['codigo']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>



  <!-- Modal Structure -->
  <div id="modal<?php echo $dados['codigo']; ?>" class="modal">
    <div class="modal-content">
      <h4>Êpa!</h4>
      <p>Quer mesmo excluir este item?</p>
    </div>
    <div class="modal-footer">
      <form action="action/delete.php" method="post">
        <input type="hidden" name="codigo" value="<?php echo $dados['codigo']; ?>">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>

        <button type="submit" name="deletar" class="btn red"> Sim, quero deletar</button>
      </form>
    </div>
  </div>
    </tr> 
<?php } ?>
</tbody>
</table>

<table class="centered highlight container"></table>

<?php
//footer
include_once("includes/footer.php");
?>