<?php

// Conecta ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'cadastro_tcc');
// Verifica se ocorreu algum erro
if (mysqli_connect_error()) {
die('Não foi possível conectar-se ao banco de dados:'  . mysqli_connect_error());
exit();
}




