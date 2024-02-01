<?php 

require "./conexao.php";
    
    $id = $_POST['id'];                             // CAPTURANDO O ID 
   
    $sqlResults  = "SELECT *FROM produtos WHERE id=$id LIMIT 1";
    $execResults = $conexao->query($sqlResults);
    $dirUpload = "upload/";                        // DIRETÓRIO QUE OS ARQUIVOS FORAM SALVOS7
    
    echo json_encode($execResults->fetch(PDO::FETCH_ASSOC));
   