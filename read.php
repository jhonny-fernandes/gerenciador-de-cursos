<?php 

require "./conexao.php";

$sqlResults  = "SELECT *FROM produtos";
$execResults = $conexao->query($sqlResults);
$totRegisters = $conexao->query($sqlResults);

$dirUpload = "upload/"; /* DIRETÓRIO QUE OS ARQUIVOS FORAM SALVOS */

if( $totRegisters->rowCount() == 0 )
{
    echo "<p class='movie-txt center'> Não existem produtos para serem exibidos </p>";
}   else 
{
    while( $results = $execResults->fetch(PDO::FETCH_ASSOC))
    {
        ?>
            <div class="box-img">
                
                <figure>
                    <a href="">
                    <img src="<?=$dirUpload.$results['arquivo']?>" 
                        alt="<?=$results['nome']?>" title="<?=$results['nome']?>" width="220" height="200">
                    </a>
                    <figcaption class="title"> 
                    
                     <button type="button" class="btn btn-primary editBtn" value="<?=$results['id']?>"> Editar </button>
                    </figcaption>
                </figure>
                </a>
            </div>
        <?php 
    }
}

?>


