<?php
//conexão com banco de dados
include_once("action/db_connect.php");
//header
include_once("includes/header.php");
?>

            <input type="text" id="cep">        
            <label for="cep">CEP</label>
            
            <input type="text" id="bairro">        
            <label for="cep">Bairro</label>

            <input type="text" id="estado">        
            <label for="cep">Estado</label>

            <input type="text" id="cidade">        
            <label for="cep">Cidade</label>

            <input type="text" name="logradouro" id="logradouro">
            <label for="cep">Logradouro</label>

<script src="js/cep.js"></script>
<?php
//footer
include_once("includes/footer.php");?>