<!---INSERIDOR DE USUARIOS:--->
<?php
// CHECA SE ESTÃO TODAS VARIAVEIS DEFINIDAS
if(isset($_POST['username']) && isset($_POST['user_email']) && isset($_POST['user_password'])&& isset($_POST['telefone'])){

  // CHECA HÁ ESPAÇO EM BRANCO

  if(!empty(trim($_POST['username'])) && !empty(trim($_POST['user_email'])) && !empty($_POST['user_password'])&& !empty($_POST['telefone'])){



    // Escape de caracteres especiais (INCLUI TODOS OS CARACTERES).
    $endereco = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['endereco']));
    $username = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['username']));
    $user_email = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['user_email']));
    $phone = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['telefone']));
    //Cheacka se o email é valido
    if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {



      // CHECA SE O EMAIL JA FOI REGISTRADO

      $check_email = mysqli_query($db_connection, "SELECT `user_email` FROM `usuario` WHERE user_email = '$user_email'");

      if(mysqli_num_rows($check_email) > 0){
        $error_message = "Esse email ja está cadastrado. Tente outro.";
      }
      else if(mysqli_num_rows(mysqli_query($db_connection, "SELECT `telefone` FROM `usuario` WHERE telefone = '$phone'")) > 0){
        $error_message = "Esse numero ja está cadastrado. Tente outro.";
      }
      else{
        // SE O EMAIL NÃO FOI REGISTRADO
        /* --

        CRIPTOGRAFAR SENHA DE USUÁRIO USANDO PHP password_hash function
        MAIS SOBRE password_hash EM: http://php.net/manual/en/function.password-hash.php

        -- */

        $user_hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

        // ADICIONA NO BANCO DE DADOS
        $user_email = strtolower($user_email);
        $insert_user = mysqli_query($db_connection, "INSERT INTO `usuario` (username, user_email, user_password, telefone, endereco) VALUES ('$username', '$user_email', '$user_hash_password', '$phone', '$endereco')");

        if($insert_user === TRUE){
          $success_message = "Eba! Sua conta foi cadastrada.";
        }
        else{
          $error_message = "Oops! Algo deu errado.";
        }

      }

    }
    else {
      // SE O EMAIL É INVALIDO
      $error_message = "Esse endereço de email é invalido.";
    }

  }
  else{
    // SE TEM ESPAÇOS EM BRANCOS
    $error_message = "Por favor, complete todos os espaços vazios.";

  }

}

?>
