<?php
  include_once("../conexao.php");

  $chamado_cod = $_POST['chamado_cod'];
  $chamado_titulo = $_POST['chamado_titulo'];
  $chamado_descricao = $_POST['chamado_descricao'];
  $chamado_bairro_atual = $_POST['chamado_bairro_atual'];
  $chamado_bairro_novo = $_POST['chamado_bairro_novo'];

  if ($chamado_bairro_novo == "") {
    $update = mysqli_query($conexao,"update chamado set chamado_titulo = '$chamado_titulo', chamado_descricao = '$chamado_descricao' where chamado_cod = $chamado_cod");
      echo "<script>alert('Editado com sucesso!'); window.location.href = '../../tela/index.php'</script>";
  }else{
    $update = mysqli_query($conexao,"update chamado set chamado_titulo = '$chamado_titulo', chamado_bairro = '$chamado_bairro_novo', chamado_descricao='$chamado_descricao' where chamado_cod = '$chamado_cod'");
    echo "<script>alert('Editado com sucesso!'); window.location.href = '../../tela/index.php'</script>";
  }

 ?>
