<?php

$host = "localhost";
$dbname = "db_tempo";
$username = "root";
$passwd = "";

try{
     $conexao = new PDO("mysql:host={$host};dbname={$dbname}", $username, $passwd);
    // echo "conectado";
}catch(Exception $e){
    throw new Exception("Erro na concexão do banco");
    echo $e->getMessage();
}
