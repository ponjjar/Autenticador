<!---ALTERADOR DE USUARIOS:--->
<?php
require 'db_connection.php';
// CHECA OS ESPAÇOS EM BRANCOS:
if(isset(($_POST['telefone'])) && isset(($_POST['email'])) && isset(($_POST['senha'])) && isset(($_POST['nome'])) && isset(($_POST['endereco']))){
  if(!empty(($_POST['telefone'])) || !empty(($_POST['email'])) || !empty(($_POST['senha'])) || !empty(($_POST['nome'])) || !empty(($_POST['endereco']))){
    @session_start();
    //DECLARANDO VARIAVEIS INICIAIS:
    $usermail = $_SESSION['user_email'];
    $get_user_data = mysqli_query($db_connection, "SELECT * FROM `usuario` WHERE user_email = '$usermail'");
    $userData =  mysqli_fetch_assoc($get_user_data);
    $username=$userData['username'];
    $user_email=$userData['user_email'];
    $phone=$userData['telefone'];
    $query = mysqli_query($db_connection, "SELECT * FROM `usuario` WHERE user_email = '$user_email'");
    $row = mysqli_fetch_assoc($query);
    $enderecoalterado=($_POST['endereco']);
    $user_db_pass = $row['user_password'];
    //CHECA SE A SENHA ESTÁ CORRETA:
    $check_password = password_verify($_POST['senha'], $user_db_pass);

    //CHECA SE O NOME ESTÁ PREENCHIDO:
    if(!empty(trim($_POST['nome']))){
      //$username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['nome']));
      $nomealterado=trim($_POST['nome']);
      mysqli_query($db_connection,"UPDATE usuario SET username = '$nomealterado' WHERE user_email='$user_email'");
    }

    //CHECA SE O TELEFONE ESTÁ PREENCHIDO:
    if(!empty(trim($_POST['telefone']))){
      $phonealterado=trim($_POST['email']);
      $check_phone = mysqli_query($db_connection, "SELECT `telefone` FROM `usuario` WHERE telefone = '$phonealterado' ");
      //CHECA SE O NUMERO DE TELEFONE É UNICO NO BANCO DE DADOS:
      if(mysqli_num_rows($check_phone) > 0){
        $error_message = "Esse numero ja está cadastrado. Tente outro.";
      }
      //ANALISA SE O TELEFONE TEM MAIS DE 15 CARACTERES:
      else if(strlen($_POST['telefone'])>=11){
        $phonealterado=trim($_POST['telefone']);
        mysqli_query($db_connection,"UPDATE usuario SET telefone = '$phonealterado' WHERE user_email='$user_email'");
      }
      //SE NÃO DECLARA ERRO.
      else{
        $error_message = "Numero de telefone invalido.";
      }
    }
      //CHECA SE O ENDEREÇO ESTA PREENCHIDO
      if(!empty(trim($_POST['endereco']))){
        mysqli_query($db_connection,"UPDATE usuario SET endereco = '$enderecoalterado' WHERE user_email='$user_email'");
      }
      //CHECA SE A SENHA ESTÁ PREENCHIDA:
      if(!empty($_POST['senha']) ){
        //ANALISA SE A SENHA TEM MAIS DE 15 CARACTERES E ALTERA A SENHA:
        if(strlen($_POST['senha'])>8){
          $user_hash_password = password_hash($_POST['senha'], PASSWORD_DEFAULT);
          mysqli_query($db_connection,"UPDATE usuario SET user_password = '$user_hash_password' WHERE user_email='$user_email'");
          //  $_SESSION['user_password'] = $user_hash_password;
        }
        //SE NÃO DECLARA ERRO.
        else{
          $error_message="A senha é muito curta";
        }
      }

          //CHECA SE O EMAIL ESTÁ PREENCHIDO:
          if(!empty(trim($_POST['email']))){
            $emailalterado=trim($_POST['email']);
            $check_email = mysqli_query($db_connection, "SELECT `user_email` FROM `usuario` WHERE user_email = '$emailalterado'");
            //CHECA SE O EMAIL JA EXISTE NO BANCO DE DADOS:
            if(mysqli_num_rows($check_email) > 0){
              $error_message = "Esse email ja está cadastrado. Tente outro.";
            }
            else{
              //ANALISA SE O EMAIL É VALIDO:
              if (filter_var($emailalterado, FILTER_VALIDATE_EMAIL)) {
                mysqli_query($db_connection,"UPDATE usuario SET user_email = '$emailalterado' WHERE user_email='$user_email'");
                $_SESSION['user_email'] = $emailalterado;
              }
              //SE NÃO DECLARA ERRO.
              else{
                $error_message = "O email é invalido.";
              }
            }}
    }else{
      $error_message="Nada foi alterado.";
    }
    if(!empty($error_message)){
      echo '<center><div id="sumir">'.$error_message."</div></center>";
    }
    //SE TUDO ESTIVER CERTO O PROGRAMA DECLARA SUCESSO.
    else {
      echo '<center><div id="sumir">Alterado com sucesso!</center></div>';
    }
  }
?>
