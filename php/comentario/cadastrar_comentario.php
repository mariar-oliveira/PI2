<?php
  include_once("../conexao.php");
  session_start();
  $comentario_descricao = $_POST['comentario_descricao'];
  $comentario_data = date('Y-m-d');
	$comentario_usuario = $_SESSION['usuario_cod'];
  $comentario_chamado = $_POST['chamado_cod'];

  $insert = mysqli_query($conexao,"insert into comentario (comentario_descricao, comentario_data, comentario_usuario, comentario_chamado) values('$comentario_descricao', '$comentario_data', '$comentario_usuario', '$comentario_chamado')");


  header("location: ../../tela/chamado_especifico.php?cod=$comentario_chamado");
 ?>
