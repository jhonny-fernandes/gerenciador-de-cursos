<?php

 require "./conexao.php";
 
/* -- UPDATE-- */

$id = $_POST['id'];
$nome      = filter_var($_POST['nome'], FILTER_SANITIZE_SPECIAL_CHARS);
$estado    = filter_var($_POST['estado'], FILTER_SANITIZE_SPECIAL_CHARS);
$preco     = filter_var($_POST['preco'], FILTER_SANITIZE_NUMBER_INT);
$descricao = filter_var($_POST['descricao'], FILTER_SANITIZE_SPECIAL_CHARS);

$dirUpload = "upload/";

if(!empty($_FILES['arquivo'])){
    // SE NÃO ESTIVER VAZIA,CRIE O ARQUIVO

    $extensaoArquivo = strrchr($_FILES['arquivo']['name'], '.');             // FAZENDO UMA BUSCA PELA EXTENSÃO

    if(empty($extensaoArquivo)){
        echo "sem extensão";
        
        return false;
   }    else{
        $novoNomeArquivo = md5($_FILES['arquivo']['name']).$extensaoArquivo;     // Gera novo nome para o arquivo

        $nameFileServer = $dirUpload.$novoNomeArquivo;
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $nameFileServer);

        
            $sqlUpdate = "UPDATE produtos 
                            SET nome= :nome, 
                                arquivo= :arquivo, 
                                estado=:estado,
                                preco= :preco, 
                                descricao= :descricao 
                        WHERE id =:id";

            $update = $conexao->prepare($sqlUpdate);

            $update->bindValue(':id', $id);
            $update->bindValue(':nome', $nome);
            $update->bindValue(':arquivo', $dirUpload.$novoNomeArquivo);
            $update->bindValue(':estado', $estado);
            $update->bindValue(':preco', $preco);
            $update->bindValue(':descricao', $descricao);
            
            $update->execute();

        echo "<p class='alert alert-success'> Produto atualizado com sucesso! </p>";
        return true;
   }
   
}   else {
                   
       /* -- UPDATE -- */
       
       $sqlUpdate = "UPDATE produtos 
                        SET nome= :nome, 
                            estado=:estado,
                            preco= :preco, 
                            descricao= :descricao 
                      WHERE id =:id";


        $update = $conexao->prepare($sqlUpdate);

        $update->bindValue(':id', $id);
        $update->bindValue(':nome', $nome);
        $update->bindValue(':estado', $estado);
        $update->bindValue(':preco', $preco);
        $update->bindValue(':descricao', $descricao);


        $update->execute();

        echo "<p class='alert alert-success'> Produto atualizado com sucesso! </p>";
        }

// $dirUpload = "upload/";

// $extensaoArquivo = strrchr($_FILES['arquivo']['name'], '.');             // FAZENDO UMA BUSCA PELA EXTENSÃO
// $novoNomeArquivo = md5($_FILES['arquivo']['name']).$extensaoArquivo;     // Gera novo nome para o arquivo

// if(!is_dir($dirUpload)){    
//     echo "<p class='alert alert-danger'> Diretório não encontrado, falha na atualização </p>";
// }  else{
    
//     if( $extensaoArquivo != '.jpg' && $extensaoArquivo != '.png') {
//         echo "<p class='alert alert-danger'> Extensão não aceita, aceitamos: <strong> PNG, JPG </strong> </p>";
//     }else{
       

        // $nameFileServer = $dirUpload.$novoNomeArquivo;
        // move_uploaded_file($_FILES['arquivo']['tmp_name'], $nameFileServer);


        // /* -- UPDATE -- */
        //     $sqlUpdate = "UPDATE produtos 
        //                      SET nome= :nome, 
        //                          arquivo= :arquivo, 
        //                          estado=:estado,
        //                          preco= :preco, 
        //                          descricao= :descricao 
        //                    WHERE id =:id";

        // // LIMPANDO SUJEIRA DE DADOS
        //     $update = $conexao->prepare($sqlUpdate);

        //     $update->bindValue(':id', $id);
        //     $update->bindValue(':nome', $nome);
        //     $update->bindValue(':arquivo', $novoNomeArquivo);
        //     $update->bindValue(':estado', $estado);
        //     $update->bindValue(':preco', $preco);
        //     $update->bindValue(':descricao', $descricao);
            

        //     $update->execute();

        // echo "<p class='alert alert-success'> Produto atualizado com sucesso! </p>";
//     }
    
// }  
