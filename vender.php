<?php
//header
include_once("includes/header.php");
//conexão com banco de dados
include_once("action/db_connect.php");
if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM produtos WHERE codigo = '$codigo'";
    $resultado = mysqli_query($connect,$sql);
    $dados = mysqli_fetch_array($resultado);
}

?>
<div class="container">
    <form action="action/sale.php" name="formula" method="POST">
        Código do Produto:
        <input type="text" name="codigo" id="" readonly value=" <?php echo $dados['codigo']; ?> ">
        Nome do Produto:
        <input type="text" name="nome" readonly value=" <?php echo $dados['nome']; ?> ">
        Preço:
        <input type="text" name="preco" id="preco" readonly value=" <?php echo $dados['preco']; ?> ">
        <div class="input-field col s12">
        <select onchange="forma-pagamento()" id="formas" name="forma">
          <option value="" disabled selected>Escolha a forma de pagamento</option>
          <option value="Crédito">Crédito</option>
          <option value="Débito">Débito</option>
          <option value="Dinheiro">Dinheiro</option>
        </select>
        </div>
        Quantidade:
        <input type="text" name="quantidadeC" id="quantidade" required>


        <div class="row container">
            <div class="col s12 xl6">
            <a href="#modal<?php echo $dados['codigo']; ?>" class="btn green modal-trigger" id="confirmar" name="confirmar">Confirmar</a>
            <button class="btn red" name="limpar" id="limpar">Limpar</button>
             <a href="index.php" class="btn orange">Cancelar</a>
            </div>
        </div>
    </div>

      <!-- Modal Structure -->
  <div id="modal<?php echo $dados['codigo']; ?>" class="modal">
    <div class="modal-content">
      <h4>Oba!</h4>
      <p>Deseja finalizar a venda?</p>
      <h2>O valor final da venda é de: <p id="res"></p>
      <h3><p id="frm"></p>
      <?php echo "<script src='./js/preco.js'>
                      
                  </script>"; ?> </h2>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="codigo" value="<?php echo $dados['codigo']; ?>">
      <input type="hidden" name="quantidade" value="<?php echo $dados['quantidade']; ?>">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      <button type="submit" name="enviar" class="btn red"> Sim, quero vender</button>
    </form>
    </div>
  </div>
    </div>
<?php
//footer
include_once("includes/footer.php");
?>