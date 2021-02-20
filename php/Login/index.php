<!-- PAGINA DE LOGIN -->
<?php
include '../Incluidos/cabecalho.php';
session_start();
require 'db_connection.php';
require 'login.php';
// CHECA SE O USUARIO ESTA LOGADO:
if(isset($_SESSION['user_email'])){
  header('Location: ../index.php');
  exit;
}

// IMPRIMI MENSAGEM DE ERRO.
if(!empty($error_message)){
  echo '<center><div id="sumir">'. $error_message . '</center></div>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/css.css" media="all" type="text/css">
  <setlocale(LC_ALL,"pt-br")>
  <title>Login</title>
</head>
<body style='animation: fadeIn 0.5s;'>
  <?php
  if(isset($_GET['sucess'])){
    //CHECA SE CADASTROU UMA CONTA NOVA.
    echo '<center><div id="sumir">'."Oba! Sua conta foi criada com sucesso, <br/> Faça o login.".'</div></center> <br>';

  }
  ?>
  <fieldset>

    <a href="../index.php">← Voltar ao inicio</a>
    <center>
      <!-- FORMULÁRIO DE LOGIN -->
      <form action="" method="post">
        <h2>Quem é você?</h2>

        <div class="container">
          <!-- EMAIL -->
          <label for="email"><legend id="legendind">Email</legend></label>
          <input type="email" placeholder="Digite seu email..." id="email" name="user_email" required>
          <br/><br>
          <!-- SENHA -->
          <label for="password"><legend id="legendind">Senha</legend></label>
          <input type="password" placeholder="Digite sua senha..." id="password" name="user_password" required>
          <br/><br>
          <!-- BOTÃO LOGIN -->
          <button type="submit">Login</button></center><a href="signup.php" style="margin-left: 75%; display: inherit;">Cadastrar →</a>
        </div>

      </form>
    </fieldset>
  </center>
</body>
<?
require 'Incluidos/rodape.php';
$footermessage=<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><fieldset><legend>Dicas</legend><center><p>Rodar o script sql/usuario.sql para criar o banco de dados no phpmyADMIN.</p><p>Para efetuar o login coloque o nome e a senha corretamente</p><p> saiba mais em leia-me.</p></center></fieldset>
?>
