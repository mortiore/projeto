<?php

// Dados de conexão com o banco
define ('HOST', 'localhost');
define ('USER', 'root');
define ('PASS', '');
define ('BANCO', 'bdpi');

function conecta () {
  $con = mysqli_connect(HOST, USER, PASS, BANCO);
  return $con;
}

?>