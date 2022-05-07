<?php
  include_once("../conexao.php");

  $comentario_cod = $_POST['comentario_cod'];
  $comentario_chamado = $_POST['comentario_chamado'];

  $delete = mysqli_query($conexao,"delete from comentario where comentario_cod = '$comentario_cod'");

  header("location: ../../tela/chamado_especifico.php?cod=$comentario_chamado");
 ?>
