<?php
  include_once("../conexao.php");
  session_start();
  unset($_SESSION['usuario_nome']);
  unset($_SESSION['usuario_cod']);
  session_destroy();
  header("location: ../../index.html");
 ?>
