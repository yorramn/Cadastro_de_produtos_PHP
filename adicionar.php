<?php
//header
include_once("includes/header.php");
?>
<div class="container">
    <form action="action/create.php" name="form-create" method="POST">
        Código:
        <input type="number" name="codigo" id="" required>
        Nome:
        <input type="text" name="nome" id="" required>
        Preço:
        <input type="text" name="preco" id="" required>
        Quantidade:
        <input type="number" name="quantidade" id="" required>

        
        <button class="btn" name="enviar" id="btn-create">Enviar</button>

        <a href="index.php" class="btn yellow text-color orange"> Voltar</a>
        </div>
    </form>
    </div>
<?php
//footer
include_once("includes/footer.php");
?>