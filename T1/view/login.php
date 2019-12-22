<?php 
    require 'cadastrar.php';
?>
<div class="bg">
    <form class="login-form" action="index.php" method="post">
        <p class="titulo">Bem-vindo!</p>
        <p class="texto"> Faça login para continuar</p>
        <input type="text" class="input" id="input_username" placeholder="Usuário" name="usuario">
        <input type="password" class="input" id="input_password" placeholder="Senha">
        <input type="button" class="button" id="btn_login" value="login">
        <a class="texto" id="btn_cadastrar">Cadastre-se</a>
        <p class="texto" id="error_msg2"></p>
    </form>
</div>
