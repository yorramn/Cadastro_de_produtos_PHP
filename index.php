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
echo '<input type="hidden" name="cargo" value="'.$_SESSION['cargo'].'">';

$id = $_SESSION['id'];
$sql = "SELECT * FROM usuario WHERE id = '$id'";
$resultado = mysqli_query($connect,$sql);
$dados = mysqli_fetch_array($resultado);

$listar = "";
if (isset($_POST['filtro'])) {
    $filtro = $_POST['filtro'];
    if ($filtro != "Todos") {
      $listar = "SELECT * FROM produtos WHERE categoria = '$filtro'";
    }else{
      $listar = "SELECT * FROM produtos ORDER BY quantidade ASC";
    }
}else{
  $listar = "SELECT * FROM produtos ORDER BY quantidade ASC";
}

?>
<section>
<div class="container center-align pink lighten-3">
  <h3>MENU</h3>
</div>
<section class="row container right-align itens">
  <form action="search.php" method="post">
    <div class="col s12 xl5">
      <label for="query">Código ou Nome</label>
      <input type="text" name="query" required>
    </div>
    <div class="col s12 xl1 left-align">
       <button type="submit" class="material-icons btn-floating green lighten-3" name="procurar">search</button>
    </div>
    </form>
    
      <div class="col s12 xl1 right-align">
        <a href="#modal10" class="btn-floating yellow darken-2 modal-trigger">
         <i class="material-icons">local_offer</i>
        </a>
      </div>

      <div class="col s12 xl1 right-align">
        <a href="#modal20" class="btn-floating yellow darken-2 modal-trigger">
         <i class="material-icons">filter_list</i>
        </a>
      </div>
    
    <div class="col s12 xl4">
      <ul id="dropdown2" class="dropdown-content">
        <li><a href="perfil.php">My profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <a class="btn dropdown-trigger" href="#!" data-target="dropdown2">Bem vindo, 
        <?php  echo $dados['nome'] ?>
        <i class="material-icons right">arrow_drop_down</i>
      </a>
    </div>
</section>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <section class="section container">
    <span class="row">
      <div class="col s12 xl2 grey lighten-5">
        <select onchange="filtro()" id="categorias">
        <option value="" disabled selected>Filtrar</option>
        <option value="Todos">Todos</option>
        <?php 
          $sql = "SELECT * FROM categorias";
          $resultado = mysqli_query($connect,$sql);
          while ($dados = mysqli_fetch_array($resultado)) {  
        ?>  
        <option value="<?php echo $dados['nome'] ?>"><?php echo $dados['nome'] ?></option>
          <?php }?>
        </select>
      </div>

      <input type="hidden" id="filter" name="filtro">

      <div class="col s12 xl2">
        <button id="filtrar" class="btn-large waves-effect waves-light  grey darken-3">Aplicar </button>
      </div>
    </span>
  </section>
  </form>
<table class="centered highlight container" id="tabela1">
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
        <i class="material-icons ">print</i></a>
        <p>PDF</p>
    </th>  
    <th>
        <a href="encomendar.php" class="btn-floating purple lighten-3">
        <i class="material-icons ">redeem</i></a>
        <p>Encomenda</p>
    </th>  
</thead>
<tbody>
<?php 
    $sql = $listar;
    $result = mysqli_query($connect,$sql);
    while ($dados = mysqli_fetch_array($result)) {
?>
    <tr>
        <td><?php echo $dados['codigo']?></td>
        <td><?php echo $dados['nome']?></td>
        <td><?php echo "R$".$dados['preco']?></td>
        <td><input type="hidden"  id="qtd"><?php echo $dados['quantidade']?></td>
        <td><a href="editar.php?codigo=<?php echo $dados['codigo']?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
        <td><a href="vender.php?codigo=<?php echo $dados['codigo']?>" class="btn-floating purple"><i class="material-icons">store</i></a></td>
        <td><a href="#modal<?php echo $dados['codigo']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td></tr>
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
  
<?php } ?>
</tbody>
</table>
  <!-- Modal Structure -->
  <div id="modal20" class="modal">
  <form action="action/categorias.php" method="post">
    <div class="modal-content">
    <div class="center-align pink lighten-3">
          <h3>CÓDIGO</h3>
    </div>
    <div class="input-field ">
          <input id="nome" type="text" class="validate" name="nome">
          <label for="nome">Categoria</label>
        </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <button type="submit" name="categorizar" class="btn green darken-5"> Gravar</button>
    </div>
    </form>
  </div>
    <!-- Modal Structure -->
    <div id="modal10" class="modal">
    <form action="action/promocao.php" method="post">
      <div class="modal-content container">
        <div class="center-align pink lighten-3">
          <h3>CÓDIGO</h3>
        </div>
        <div class="input-field ">
        <?php 
          $sql = "SELECT * FROM usuario WHERE id = '$id'";
          $resultado = mysqli_query($connect,$sql);
          $dados = mysqli_fetch_array($resultado);
        ?>
              <input id="funcionario" value = "<?php echo $dados['nome']; ?> " type="text" name="funcionario">
              
              <input id="nome" type="text" name="nome" placeholder="Nome Promocional">

              <input id="codigo" type="text" name="codigo" placeholder="Código promocional">

              <input id="valor" type="text" name="valor" placeholder="Valor do desconto">

              <input type="hidden" class="validate" name="id" value="<?php echo $dados['id'];?>">
              <p>
                <label>
                  <input class="with-gap" name="parametro" type="radio" value="porcentagem"  />
                  <span>%</span>
                </label>
                <label>
                  <input class="with-gap" name="parametro" type="radio" value="dinheiro"  />
                  <span>R$</span>
                </label>
              </p>
              <select onchange="promocao()" id="promos">
                <option value="" disabled selected>Escolha a regra de aplicação do desconto</option>
                <option value="produto">Por produto</option>
                <option value="categoria">Por categoria</option>
                <option value="dinheiro" >Valor final da compra</option>
              </select>

            <input type="hidden" name="regra" value="valor final">
              <div id="produtos" style="display: none">
              <?php 
                        $pesquisa = "SELECT * FROM produtos";
                        $query = mysqli_query($connect,$pesquisa);
                        while ($dado = mysqli_fetch_array($query)) {
                    ?>
                    <p>
                      <label>
                        <input name="regra" type="checkbox" value="<?php echo $dado['codigo']; ?>">
                          <span><?php echo $dado['nome']; ?></span>
                      </label>
                    </p>
                    <?php } ?>
              </div>


              <div id="categoriasC" style="display: none">
              <?php 
                        $pesquisa = "SELECT * FROM categorias";
                        $query = mysqli_query($connect,$pesquisa);
                        while ($dado = mysqli_fetch_array($query)) {
                    ?>
                    <p>
                      <label>
                      <input class="with-gap" name="regra" type="radio" value="<?php echo $dado['nome']; ?>">
                          <span><?php echo $dado['nome']; ?></span>
                      </label>
                    </p>
                    <?php } ?>
              </div>
        </div>
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
        <button type="submit" name="cadastrar" class="btn green">Cadastrar</button>
      </div>
      </form>
  </div>
</section>
<script src="js/promocao.js"></script>
<script src="js/filtrar.js"></script>
<?php 
echo '<script>
let elemento = document.getElementsByName("cargo");
let search = document.querySelector("#search");
let res = document.querySelector(".res");

let qtd = document.querySelector("#qtd").value;
  search.addEventListener("click",function(){
      let tabela = "";
      tabela += "<table>";
      tabela += "<thead>";
      tabela += "<th>Oi</th>";
      tabela += "</thead>";
      tabela += "</table>"
      res.innerHTML += tabela;
  });


      </script>';
?>
<?php
//footer
include_once("includes/footer.php");
?>