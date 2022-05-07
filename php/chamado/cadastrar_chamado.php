<?php
  include_once("../conexao.php");
  session_start();
  $chamado_titulo = $_POST['chamado_titulo'];
  $chamado_descricao = $_POST['chamado_descricao'];
  $chamado_bairro = $_POST['chamado_bairro'];
  $chamado_data_acontecimento = $_POST['chamado_data'];
  $chamado_data_relato = date('Y-m-d');
  $chamado_usuario = $_SESSION['usuario_cod'];

  $insert = mysqli_query($conexao,"insert into chamado (chamado_titulo,chamado_descricao,chamado_bairro,chamado_data_acontecimento,chamado_data_relato,chamado_usuario) values ('$chamado_titulo','$chamado_descricao','$chamado_bairro','$chamado_data_acontecimento','$chamado_data_relato','$chamado_usuario')");

  header("location: ../../tela/index.php");
 ?>
