<?php
  include_once("../conexao.php");
  $usuario_nome = $_POST['usuario_nome'];
  $usuario_email = $_POST['usuario_email'];
  $usuario_senha = MD5($_POST['usuario_senha']);

  $select_usuario = mysqli_query($conexao,"select * from usuario where usuario_email = '$usuario_email'");

  if(mysqli_num_rows($select_usuario) == 1){
    echo "<script>alert('E-mail já cadastrado'); window.location.href = '../../index.html'</script>";
    }else{
      $insert = mysqli_query($conexao, "insert into usuario(usuario_nome, usuario_email, usuario_senha) values('$usuario_nome', '$usuario_email', '$usuario_senha')");
      echo "<script>alert('Cadastrado com sucesso! Faça login!'); window.location.href = '../../index.html'</script>";
    }


 ?>
