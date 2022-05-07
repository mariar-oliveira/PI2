<?php
  $host="localhost";
  $usuario="root";
  $senha="";
  $db="nossavoz";
  $conexao=mysqli_connect($host,$usuario,$senha,$db);
  if(!$conexao){die("Erro na conexão: ". mysqli_connect_error());}

  $select_usuario = mysqli_query($conexao,"select * from usuario");
  $select_chamado = mysqli_query($conexao,"select * from chamado order by chamado_cod desc");
?>
