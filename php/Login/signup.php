<?php
session_start();
require 'db_connection.php';
require 'insert_user.php';
include "../Incluidos/cabecalho.php";
// CHECA SE O USUARIO ESTA LOGADO
if(isset($_SESSION['user_email'])){
  header('Location: ../index.php');
  exit;
}
?>
<!---CADASTRO DE USUARIOS:--->
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../../css/css.css" media="all" type="text/css">
  <!---IMPORTA OS SCRIPTS DE MASK PARA O NUMERO DE TELEFONE--->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</head>
<body style='animation: fadeIn 0.5s;'>
  <fieldset>
    <!-- FORMULÁRIO DE CADASTRO -->
    <form method="post">
      <a href="index.php">← Voltar</a>
      <center>
        <h2>Ola, seja bem vindo.</h2>
        <hr/>
        <!---DECLARADO O CONTEINER--->
        <div class="container">
          <!-- NOME -->
          <section>
            <p><label for="username">Nome</p></label>
            <input type="text" placeholder="Como você se chama?" id="username" name="username" required><br>
          </section>
          <!-- EMAIL -->
          <section>
            <p><label for="email">Email</p></label>
            <input type="email" placeholder="Qual seu email?" id="email" name="user_email" required><br>
          </section>
          <!-- TELEFONE -->
          <section>
            <p><label for="telefone">Telefone</p></label>
            <input type="text" class="form-control" id="telefone"required="required" onkeypress="$(this).mask('(00) 00000-0009')"  minlength=15 name="telefone" placeholder="Qual seu numero?"><br/>
          </section>
          <!-- ENDEREÇO -->
          <section>
            <p><label for="endereco">Endereço</p></label>
            <input type="text" placeholder="Qual seu endereço?" id="endereco" name="endereco" required><br>
          </section>
          <!-- SENHA -->
          <section>
            <p><label for="password">Senha</p></label>
            <input type="password" placeholder="Digite uma senha" id="password" name="user_password" minlength=8 required><br/><br>
          </section>
          <!-- BOTÃO CADASTRAR -->
          <button type="submit">Cadastrar</button><br/>
          <?php
          //CHECA SE HÁ ALGUMA MENSAGEM.
          if(isset($error_message)){
            echo '<div class="error_message">'.$error_message.'</div>';
          }
          if(isset($success_message)){
            echo '<div class="success_message">'.$success_message.'</div>';
            header("Location: index.php?sucess=true");
            exit;
          }
          ?>
        </div>


      </form>
    </fieldset></center>

    <?
    require 'Incluidos/rodape.php';
    $footermessage=<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><fieldset><center><legend>Dicas</legend><center><p>Rodar o script sql/usuario.sql para criar o banco de dados no phpmyADMIN.</p><p>Para cadastrar preencha os dados corretamente.</p><p> A senha precisa ter pelo menos 8 caracteres.</p><p> saiba mais em leia-me.</p></center></fieldset>
    ?>
  </body>
  </html>
