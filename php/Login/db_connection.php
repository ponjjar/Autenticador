<!-- SE CONECTA AO BANCO DE DADOS -->
<?php
//CONEXÃO AO BANCO DE DADOS (DOMINIO, USUARIO, SENHA, TABELA)
@$db_connection = mysqli_connect('localhost', 'root','','usuarios');
// CHECA SE HÁ ERRO NA CONEXÃO
if (mysqli_connect_errno()){
  echo "<fieldset><h1>ERRO NA CONEXÃO, POR FAVOR, VERIFIQUE A SENHA E O NOME DO BANCO DE DADOS EM: <p>db_connection.php</p></h1></fieldset><fieldset><legend>Console</legend><p>Failed to connect to MySQL: " . mysqli_connect_error(). "</fieldset>";
}
?>
