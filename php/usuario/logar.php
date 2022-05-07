<?php
  include_once("../conexao.php");

  $usuario_email = $_POST['usuario_email'];
  $usuario_senha = MD5($_POST['usuario_senha']);

  $select_usuario = mysqli_query($conexao,"select * from usuario where usuario_email = '$usuario_email'");

  if(mysqli_num_rows($select_usuario) == 1){
    while ($u = $select_usuario -> fetch_array()) {
      $usuario_cod = $u['usuario_cod'];
      $senha_banco = $u['usuario_senha'];
      $usuario_nome = $u['usuario_nome'];
    }
    if ($senha_banco == $usuario_senha) {
      session_start();
      $_SESSION['usuario_cod'] = $usuario_cod;
      $_SESSION['usuario_nome'] = $usuario_nome;
      header("location: ../../tela/index.php");
    }else{
      echo "<script>alert('Senha incorreta'); window.location.href = '../../index.html'</script>";
    }
  }else{
    echo "<script>alert('E-mail não encontrado ou usuário inexistente'); window.location.href = '../../index.html'</script>";
  }

?>
