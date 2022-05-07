<?php
  include_once("../conexao.php");

  $chamado_cod = $_POST['chamado_cod'];

  $delete_comentario = mysqli_query($conexao,"delete from comentario where comentario_chamado = '$chamado_cod'");
  $delete_chamado = mysqli_query($conexao,"delete from chamado where chamado_cod = '$chamado_cod'");
  
  header("location: ../../tela/index.php");

 ?>
