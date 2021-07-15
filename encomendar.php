<?php
//conexão com banco de dados
include_once("action/db_connect.php");

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
?>
<section class="container">
    <div class="center-align pink lighten-3">
        <h3>MENU</h3>
    </div>

    <span class="row red">
        <div class="col s12 xl6">
            <div class="card-panel pink lighten-5">
                <form action="" method="post">
                    <div class="center-align">
                        <h3>PRODUTO</h3>
                    </div>
                    <?php 
                        $pesquisa = "SELECT * FROM produtos";
                        $query = mysqli_query($connect,$pesquisa);
                        while ($dado = mysqli_fetch_array($query)) {
                    ?>
                    <p>
                      <label>
                        <input type="checkbox" value="<?php echo $dado['codigo']; ?>">
                          <span><?php echo $dado['nome']; ?></span>
                      </label>
                    </p>
                    <?php } ?>

            </div>

            <div class="card-panel pink lighten-5">
                    <div class="center-align">
                        <h3>FORMA DE PAGAMENTO</h3>
                    </div>
                    
                    <select onchange="forma-pagamento()" id="formas" name="forma">
                        <option value="" disabled selected>Escolha a forma de pagamento</option>
                        <option value="Crédito">Crédito</option>
                        <option value="Débito">Débito</option>
                        <option value="Dinheiro">Dinheiro</option>
                    </select>
            </div>


            <div class="card-panel pink lighten-5">
                  <div class="center-align">
                      <h3>QUANTIDADE</h3>
                  </div>  
                <input id="quantidade" type="number" class="validate" name="quantidade">
                <label for="quantidade">Quantidade</label>
            </div>
        </div>

        <div class="col s12 xl6 orange">
            <div class="card-panel">
                  <div class="center-align">
                      <h3>CLIENTE</h3>
                  </div>  
                <input id="cpf" type="text" class="validate" maxlength="11" name="cpf">
                <label for="cpf">CPF</label>
                <a href="cliente.php" rel="noopener noreferrer">Cliente não cadastrado?</a>
            </div>

            <div class="card-panel pink lighten-5">
                    <div class="center-align">
                        <h3>INSERIR DESCONTO</h3>
                    </div>
                    
                    <select onchange="forma-pagamento()" id="formas" name="forma">
                        <option value="" disabled selected>Escolha o desconto</option>
                        <?php 
                            $sql = "SELECT * FROM descontos";
                            $query = mysqli_query($connect,$sql);
                            while ($dados = mysqli_fetch_array($query)) {
                        ?>
                        <option value="<?php echo $dados['nome']; ?>"><?php echo $dados['nome']; ?></option>
                        <?php } ?>
                    </select>
            </div>

            <div class="card-panel">
                  <div class="center-align">
                      <h3>TOTAl</h3>
                  </div>  
                <input id="cpf" type="text" class="validate" maxlength="11" name="cpf">
                <label for="cpf">CPF</label>
                <a href="cliente.php" rel="noopener noreferrer">Cliente não cadastrado?</a>
            </div>
        </div>
        </form>
    </span>
</section>

<?php
//footer
include_once("includes/footer.php");
?>