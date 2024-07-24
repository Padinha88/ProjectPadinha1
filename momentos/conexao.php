<!-- Estabelece uma conexão com um banco de dados MySQL -->

<?php
  function conectar() {
    $servidor="localhost";
    $utilizador="root";
    $password="";
    $bd="momentos";
       
    $con = new mysqli($servidor,$utilizador,$password,$bd);
    return $con;
  }
       
  $conexao = conectar();
    
  if (false === $conexao->set_charset('utf8')) {
    printf('Error: %s', $mysqli->error);
  }
?>