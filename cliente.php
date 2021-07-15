<?php
//conexão com banco de dados
include_once("action/db_connect.php");
//header
include_once("includes/header.php");
session_start();
?>
<section class="container">
    <div class="container center-align pink lighten-3">
      <h3>MENU</h3>
    </div>
    <section class="container">
        <form action="action/clienteCadastro.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="validate">     
            
            <label for="cpf">RG OU CPF</label>
            <input type="text" name="doc" id="doc" class="validate">        
            
            <label for="cep">CEP</label>
            <input type="text" name="cep" id="cep">        
            
            <label for="bairro">Bairro</label>
            <input type="text" id="bairro">        
            
            <label for="estado">Estado</label>
            <input type="text" id="estado">        
            
            <label for="cidade">Cidade</label>
            <input type="text" id="cidade">        
            
            <label for="logradouro">Logradouro</label>
            <input type="text" name="logradouro" id="logradouro">

            <a href="encomendar.php" class="btn red darken-1">Cancelar</a>
            <button type="submit" class="btn green lighten-1" name="cadastrar">Cadastrar</button>
        </form>
    </section>
</section>
<script src="js/cep.js"></script>
<?php
//footer
include_once("includes/footer.php");
?>