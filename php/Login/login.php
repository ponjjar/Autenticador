<!-- FUNCIONA EM CONJUNTO COM A PAGINA DE LOGIN. -->
<?php
// CHECA SE FOI DECLARADO AS VARIAVEIS INICIAIS
if(isset($_POST['user_email']) && isset($_POST['user_password'])){

  // CHECA SE NÃO TEM ESPAÇO EM BRANCO:
  if(!empty(trim($_POST['user_email'])) && !empty(trim($_POST['user_password']))){

    // ADICIONA CARACTERES ESPECIAIS.
    $user_email = mysqli_real_escape_string($db_connection, htmlspecialchars(trim($_POST['user_email'])));

    $query = mysqli_query($db_connection, "SELECT * FROM `usuario` WHERE user_email = '$user_email'");

    if(mysqli_num_rows($query) > 0){

      $row = mysqli_fetch_assoc($query);
      $user_db_pass = $row['user_password'];

      // VERIFICA SE SENHA ESTÁ CORRETA
      $check_password = password_verify($_POST['user_password'], $user_db_pass);

      if($check_password === TRUE){

        session_regenerate_id(true);

        $_SESSION['user_email'] = $user_email;
        header('Location: ../index.php');
        exit;

      }
      else{
        // SENHA INCORRETA.
        $error_message = "a Senha ou o Email está incorreto.";
      }
    }
    else{
      // EMAIL NÃO REGISTRADO.
      $error_message = "a Senha ou o Email está incorreto.";
    }
  }
  else{
    // SE ALGUM ESPAÇO ESTIVER VAZIO.
    $error_message = "Por favor, preencha todos os espaços.";
  }

}

?>
