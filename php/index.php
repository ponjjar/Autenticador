<!---PAGINA DE USUARIOS (ADMIN, USUARIO COMUM, USUARIO NÃO LOGADO):--->
<?php
include './Incluidos/cabecalho.php';
require './Login/alteruser.php';
ini_set('display_errors','Off');
session_start();
require './Login/db_connection.php';
//ALTERA O HORARIO PARA O FUSO DE SÃO PAULO
date_default_timezone_set('America/Sao_Paulo');
// CHECA SE O USUARIO ESTÁ LOGADO
if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
  $user_email = $_SESSION['user_email'];
  $get_user_data = mysqli_query($db_connection, "SELECT * FROM `usuario` WHERE user_email = '$user_email'");
  $userData =  mysqli_fetch_assoc($get_user_data);
  echo "<center><fieldset><h3>Ola, ". $userData['username'] . "</h3> <a href='#' onclick='window.location.href=`./Login/logout.php`'><i>Sair</i></a></fieldset><br/>";
  //CHECA SE O USUARIO QUE ESTA LOGADO NÃO É UM ADMIN:
  if(strcmp($userData['user_email'], "admin@ifsp.edu.br")){
    //FORMULARIO PARA ALTERAR SEUS DADOS DE USARIO
    echo "<fieldset><legend>Alterar seus dados de usuario</legend>
    <br/> <p>Nome</p>
    <form id='alterardados' action='' method='post' autocomplete='off'>
    <input type='text' name='nome' autocomplete='off' placeholder='".$userData['username'].   "'/>
    <br/> <p>Email</p>
    <input type='email' name='email' placeholder='".$userData['user_email']."'/>
    <br/> <p>Telefone</p>
    <div class='form-group col-md-4'>
    <input type='text' name='telefone' minlength=15 class='form-control' onkeypress='$(this).mask(`(00) 00000-0009`)' placeholder='".$userData['telefone']."'/></div>
    <p><label for='endereco'>Endereço</p></label>
    <input type='text' placeholder='".$userData['endereco']."' minlength=6 id='endereco' name='endereco'><br>
    <br/> <p>Senha</p>
    <input type='password' name='senha' minlength=8 placeholder='********'/><br/></br>
    <input type='submit' name='alterar' value='alterar'/></form>";
  }
  // CASO O USUARIO LOGADO SEJA UM ADMIN:
  else{
    echo"<fieldset id='fielddata'><legend>Alterar dados de usuarios</legend>";
    echo "<table>";
    require './Login/remove.php';
    $resultado = mysqli_query($db_connection, "select * from usuario");
    //IMPRIME MENSAGEM SE HOUVER ALGO ESCRITO.
    if(!empty($message)){
      echo '<center><div id="sumir">'. $message . "</div>";
    }
    $hourMin = date('H:i');
    echo '</center> <div id="hora">Consulta realizada as '.$hourMin.' horas.</div>';
    echo"<th>Nome</th><th>Email</th><th>Endereço</th><th>Telefone</th><th colspan='2'>Opções</th>";
    //FORMULARIO OU TABELA PARA ALTERAR OS DADOS DE OUTROS USUARIOS:
    while($usuario = mysqli_fetch_assoc($resultado)) {
      //VERIFICA SE O NOME É IGUAL AO DO ADMIN E REMOVE DA LISTA.
      if(strcmp($usuario['user_email'], "admin@ifsp.edu.br")){
        echo "<form action='#' method='post'><tr><td>
        <input type='text' name='nomeusuario' value='".$usuario['username']."' id='dado'></td> <td>
        <input type='email' name='emailusuario' value='".$usuario['user_email']."' id='dado'>
        <input type='hidden' name='emailanterior' value='".$usuario['user_email']."' id='dado' readonly></td><td>
        <input type='text' name='endereco' value='".$usuario['endereco']."' id='dado'> </td><td>
        <input type='text' name='telefone' minlength=15 class='form-control' onkeypress='$(this).mask(`(00) 00000-0009`)' value='".$usuario['telefone']."' id='dado'> </td><td>
        <input type = 'checkbox' name='excluir'></input><a><i>excluir</i></a> </td>
        ";
        echo "<td><input type=submit name='aplicar' value='aplicar' id='dado'></td></tr></form>";    }
      }
      echo "</table></fieldset>";
    }
  }else{
    //MENSAGEM DE USUARIO NÃO AUTENTICADO:
    echo "<center><fieldset><p>Você não está autenticado</p> </fieldset> <br/> <button onclick='window.location.href=`./Login`'>Fazer login</button></center>";
  }



  ?>

  <html lang="pt-br">
  <head>
    <!---IMPORTA OS SCRIPTS DE MASK PARA O NUMERO DE TELEFONE--->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="../css/css.css" media="all" type="text/css">
    <meta charset="utf-8">
    <title>Autenticação</title>
  </head>
  <?php
  //IMPRIME RODA PÉ:
  if(isset($_SESSION['user_email']) && !empty($_SESSION['user_email'])){
    if(strcmp($userData['user_email'], "admin@ifsp.edu.br")){
      $footermessage="</fieldset><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><footer><fieldset id='fielddata'><legend>Dicas</legend><p> Altere seus dados preenchendo os espaços acima e clicando em <input type='button'readonly value='alterar'/></p>
      <p> Não é necessário preencher todos</p>
      <p>Para sair da conta e retornar a tela de login, clique em <u><i style='color:white'>sair</i></u></p>
      <p>Para saber mais, clique em <span id='sobrenos' style='display:inline;'> Sobre nós </span></footer>";}
      else{
        $footermessage="<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><footer><fieldset id='fielddata'><legend>Dicas</legend><p> É possivel alterar os dados de um usuario, modificando uma linha por vez e clicando em <input type='button'readonly value='aplicar'/></p>
        <p> Para excluir um usuario, marque a caixa <input type='checkbox'><i style='color:white'>excluir</i> e clique em <input type='button'readonly value='aplicar'/></p>
        <p>Para sair da conta e retornar a tela de login, clique em <u><i style='color:white'>sair</i></u></p>
        <p>Para saber mais, clique em <span id='sobrenos' style='display:inline;'> Sobre nós </span></footer>";
      }}
      else{

$footermessage="<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><hr/><footer><fieldset id='fielddata'><legend>Dicas</legend>Rodar o script sql/usuario.sql para criar o banco de dados no phpmyADMIN.</footer>";
      }
      require 'Incluidos/rodape.php';
      ?>
