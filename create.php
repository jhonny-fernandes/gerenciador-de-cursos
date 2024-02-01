<?php

 require "./conexao.php";

$nome      = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
$estado    = filter_var($_POST['estado'], FILTER_SANITIZE_SPECIAL_CHARS);
$preco     = filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_INT);
$descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);

$dirUpload = "upload/";

$extensaoArquivo = strrchr($_FILES['arquivo']['name'], '.');             // FAZENDO UMA BUSCA PELA EXTENSÃO
$novoNomeArquivo = md5($_FILES['arquivo']['name']).$extensaoArquivo;     // Gera novo nome para o arquivo

$verifyName = "SELECT COUNT(*) as total FROM produtos WHERE nome = '$nome'";
$verifyNameExec = $conexao->query($verifyName);

if ($verifyNameExec) {
    $result = $verifyNameExec->fetch(PDO::FETCH_ASSOC);
    $total = $result['total'];

    if ($total >= 1) {
        echo "<p class='alert alert-danger'> Opa, o curso já existe em sua base de dados! </p>";
    } else {
       if(!is_dir($dirUpload)){    
            echo "<p class='alert alert-danger'> Diretório não encontrado, falha no upload </p>";
  
    }  else{
    
    if( $extensaoArquivo != '.jpg' && $extensaoArquivo != '.png') {
        echo "<p class='alert alert-danger'> Extensão não aceita, aceitamos: <strong> PNG, JPG </strong> </p>";
    }else{
        $nameFileServer = $dirUpload.$novoNomeArquivo;
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $nameFileServer);

        /* -- INSERT -- */
        $sqlInsert = "INSERT INTO produtos 
        (nome, descricao, arquivo, preco, estado, criado_em, atualizado_em)
        VALUES(:nome, :descricao, :arquivo, :preco, :estado, NOW(), NOW())";

            // LIMPANDO SUJEIRA DE DADOS
        $insert = $conexao->prepare($sqlInsert);
        $insert->bindValue(':nome', $nome, PDO::PARAM_STR);
        $insert->bindValue(':arquivo', $dirUpload.$novoNomeArquivo, PDO::PARAM_STR);
        $insert->bindValue(':descricao',  $descricao, PDO::PARAM_STR);
        $insert->bindValue(':preco',  $preco, PDO::PARAM_STR);
        $insert->bindValue(':estado', $estado, PDO::PARAM_STR);

        $insert->execute();

        echo "<p class='alert alert-success'> Cadastro realizado! </p>";
        
    }
    
}  
    }
}

// $dirUpload = "upload/";

// $extensaoArquivo = strrchr($_FILES['arquivo']['name'], '.');             // FAZENDO UMA BUSCA PELA EXTENSÃO
// $novoNomeArquivo = md5($_FILES['arquivo']['name']).$extensaoArquivo;     // Gera novo nome para o arquivo


// if(!is_dir($dirUpload)){    
//     echo "<p class='alert alert-danger'> Diretório não encontrado, falha no upload </p>";
  
// }  else{
    
//     if( $extensaoArquivo != '.jpg' && $extensaoArquivo != '.png') {
//         echo "<p class='alert alert-danger'> Extensão não aceita, aceitamos: <strong> PNG, JPG </strong> </p>";
//     }else{
//         $nameFileServer = $dirUpload.$novoNomeArquivo;
//         move_uploaded_file($_FILES['arquivo']['tmp_name'], $nameFileServer);

//         /* -- INSERT -- */
//         $sqlInsert = "INSERT INTO produtos 
//         (nome, descricao, arquivo, preco, estado, criado_em, atualizado_em)
//         VALUES(:nome, :descricao, :arquivo, :preco, :estado, NOW(), NOW())";

//             // LIMPANDO SUJEIRA DE DADOS
//         $insert = $conexao->prepare($sqlInsert);
//         $insert->bindValue(':nome', $nome, PDO::PARAM_STR);
//         $insert->bindValue(':arquivo', $dirUpload.$novoNomeArquivo, PDO::PARAM_STR);
//         $insert->bindValue(':descricao',  $descricao, PDO::PARAM_STR);
//         $insert->bindValue(':preco',  $preco, PDO::PARAM_STR);
//         $insert->bindValue(':estado', $estado, PDO::PARAM_STR);

//         $insert->execute();

//         echo "<p class='alert alert-success'> Cadastro realizado! </p>";
        
//     }
    
// }  
    