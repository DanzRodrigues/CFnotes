<div id="box_cadastrar" class="modal">
  <form class="login-form">
    <div class="container">
      <p class="titulo">Cadastrar</p>
      <p class="texto">Preencha os campos abaixo para criar uma conta</p>
      <input type="text" class="input" id="cad_user" placeholder="Usuario" name="usuario" required>
      <input type="text" class="input" id="cad_email" placeholder="Email" name="email" required>
      <input type="password" class="input" id="cad_pass1" placeholder="Senha" name="psw" required>
      <input type="password" class="input" id="cad_pass2" placeholder="Repita a senha" name="psw-repeat" required>
      <div class="clearfix">
        <button type="button" class="button" id="btn_cancel">Fechar</button>
        <button type="button" class="button" id="btn_sgnp">Cadastrar</button>
        <p class="texto" id="error_msg"></p>
      </div>
    </div>
  </form>
</div>