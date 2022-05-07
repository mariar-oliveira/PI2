<?php
  session_start();
  if(!isset($_SESSION['usuario_cod'])){
    header("location: ../index.html");
  }
 ?>
