<?php
include_once 'action/db_connect.php';
//header
include_once("includes/header.php");

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM produtos WHERE codigo = '$codigo'";
    $resultado = mysqli_query($connect,$sql);
    $dados = mysqli_fetch_array($resultado);
}
?>
<div class="container">
    <form action="action/update.php" name="form-create" method="POST">
    <input type="hidden" name="codigo" value=" <?php echo $dados['codigo']; ?> ">
        Código:
        <input type="number" name="codigo" id="" required value="<?php echo $dados['codigo'] ?>" readonly>
        Nome:
        <input type="text" name="nome" id="" required value="<?php echo $dados['nome'] ?>">
        Preço:
        <input type="text" name="preco" id="" required value="<?php echo $dados['preco'] ?>">
        Quantidade:
        <input type="number" name="quantidade" id="" required value="<?php echo $dados['quantidade'] ?>">

        
        <button class="btn" name="enviar" id="btn-create">Enviar</button>

        <a href="index.php" class="btn yellow text-color orange"> Voltar</a>
        </div>
    </form>
    </div>
<?php
//footer
include_once("includes/footer.php");
?>