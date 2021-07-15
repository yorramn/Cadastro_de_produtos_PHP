<?php
//header
include_once("includes/header.php");
?>

<div class="alinhar card-panel">
<div class="container cen z-depth-4 purple lighten-5">
<div class="row im">
    <img src="img/capa.png" alt="">
</div>
<div class="row ">
    <form class="col s12" method="post" action="includes/validacao.php">
    <div class="purple-text lighten-3">
        <h3>MENU</h3>
    </div>
    <br>
      <div class="row">
        <div class="input-field ">
          <input id="user" type="text" class="validate" name="user">
          <label for="user">Usuário</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field">
          <input id="senha" type="text" class="validate" name="senha">
          <label for="senha">Senha</label>
        </div>
      </div>
      <div class="input-field col s12">
        <select onchange="forma-pagamento()" id="formas" name="cargo">
          <option value="" disabled selected>Selecione o cargo</option>
          <option value="Gerente">Gerente</option>
          <option value="Balconista">Balconista</option>
          <option value="Estoquista">Estoquista</option>
        </select>
        </div>
      <div class="row">
        <div class="input-field col s12">
            <button type="submit" name="entrar" class="btn">Entrar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<?php
//header
include_once("includes/footer.php");
?>