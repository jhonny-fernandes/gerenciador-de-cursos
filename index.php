<?php
    require "./conexao.php";
    
    $sqlResults  = "SELECT *FROM produtos";
    $execResults = $conexao->query($sqlResults);
    $totRegisters = $conexao->query($sqlResults);   // VERIFICA A QUANTIDADE DE PRODUTOS                    // DIRETÓRIO QUE OS ARQUIVOS FORAM SALVOS 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Sistema de Cadastro de cursos</title>
</head>
<body>
    
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAddProducts">
                        Adicione um novo curso
                    </button>
        
                    <div id="list" class="d-flex flex-wrap justify-content-between">
                
                        <?php 
                            if( $totRegisters->rowCount() == 0 )
                            {
                                echo "<p class='movie-txt'> Não existem produtos para serem exibidos </p>";
                            }   else 
                            {
                                while( $results = $execResults->fetch(PDO::FETCH_ASSOC))
                                {
                                    ?>
                                        <div class="box-img">
                                            
                                            <figure>
                                                <a href="">
                                                <img src="<?=$results['arquivo']?>" 
                                                    alt="<?=$results['nome']?>" title="<?=$results['nome']?>" class="img">
                                                </a>
                                                <figcaption class="title"> 
                                                <button type="button" class="btn btn-primary editBtn" value="<?=$results['id']?>"> Editar </button>
                                                <button type="button" class="btn btn-danger delBtn" value="<?=$results['id']?>"> Deletar </button>
                                                </figcaption>
                                            </figure>
                                            </a>
                                        </div>
                                    <?php 
                                }
                            }
                        ?>
                    </div>

    <!-- MODAL INSERT -->

    <div class="modal fade" id="modalAddProducts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastre o Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="center msg-alert message" style="display:none;">  </div>
                    
                    <form id="form" method="post" enctype="multipart/form-data" class="form">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="firstName">Nome do Produto</label>
                                <input type="text" class="form-control" name="nome" id="nome">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="preco">Preço</label>
                                    <input type="text" class="form-control" id="preco" name="preco" placeholder="">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status">Status</label>
                                    <select class="custom-select d-block w-100" id="status" name="estado">
                                        <option value=""></option>
                                        <option value="ativo">Ativo</option>
                                        <option value="inativo">Inativo</option>
                                    </select>
                                </div>

                            <div class="col-md-6 mb-3">
                                <label for="capa">Arquivo</label><br>
                                
                                <input type="file" id="arquiv" name="arquivo" class="arquiv">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-enviar"> 
                            <span> Inserir </span>
                         </button>

                        <button class="btn btn-primary btn-loader" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="sr-only">Loading...</span>
                        </button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
        <!-- -END MODAL INSERT -->

     <!-- MODAL UPDATE -->
    
        <div class="modal fade" id="editProcuts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Atualizar Produto </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="test"></div>
                        <div class="center msg-alert message" style="display:none;">  </div>
                            <form id="formUpdate" method="post" enctype="multipart/form-data" class="formUpdate">
                              <div class="row">
                                <div class="col-md-12 mb-3 cap">
                                    <input type="text" class="form-control d-none id" name="id" id="id"><br>
                                    <label for="firstName">Nome do Produto</label>
                                    <input type="text" class="form-control nome" name="nome">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="preco">Preço</label>
                                        <input type="text" class="form-control preco" name="preco" id="preco" class="preco" placeholder="" value="">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status">Status</label>
                                        <select class="custom-select d-block w-100" id="status" name="estado">
                                            <option value=""></option>
                                            <option value="ativo">Ativo</option>
                                            <option value="inativo">Inativo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Capa - Pré visualização</label> <br>
                                        <img class="image">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>Arquivo</label> <br>
                                        <label for="arquivo" class="btn btn-dark btn-sm ark"> Selecione </label>
                                        <input type="file" id="arquivo" class="arquiv" name="arquivo">
                                    </div>

                                <div class="col-md-12 mb-3">
                                    <label for="descricao">Descrição</label>
                                    <textarea class="form-control descricao" id="descricao" name="descricao" rows="3">  </textarea>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-salvar"> 
                                <span> Salvar </span>
                            </button>

                            <button class="btn btn-primary btn-loader" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     
        
        
        <!-- -END MODAL UPDATE -->

        <!-- MODAL DELETE -->
        <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Deletar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="center msg-alert message" style="display:none;">  </div>
                    Tem certeza que deseja remover este item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                    <button type="button" class="btn btn-primary delProduct">Sim</button>
                </div>
                </div>
            </div>
        </div>
        <!-- END MODAL DELETE -->
    </body>
    
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script>
   
    $(".btn-loader").addClass("d-none");
    
    $(".btn-enviar").on("click",function(e){
        e.preventDefault();                   // EVITA DE CARREGAR
       
        var form = $('form')[0];              // CAPTURA ELEMENTOS DO FORMULÁRIO
        var formData = new FormData(form);    // CRIA O ELEMENTO
        var ajaxUrl = "create.php";
    
        $.ajax({
            url : ajaxUrl,
            type : "POST",
            data : formData,
           
            contentType : false,
            processData : false, 

            beforeSend: function(){
                $(".btn-loader").removeClass("d-none");
                $(".btn-enviar").addClass("d-none");
            },success(response){
                $(".message").show();
                 $(".message").html(response);
                $(".btn-loader").addClass("d-none");
                $(".btn-enviar").removeClass("d-none"); 
                resetForm();
               // getProdutos();
                
            },error(response){
                $("#message").show();
                $(".btn-loader").addClass("d-none");
                $(".btn-enviar").removeClass("d-none"); 
            }
        });
    });

    $(".nome").on("click", function(){
        $(".message").hide();
    });

    $(".close").on("click", function(){
        $(".message").hide();
    });
    
    
    $(".editBtn").on("click", function(e){
        e.preventDefault();
        let product_id = $(this).val(); 

        $.ajax({
            url: 'read.php',
            type: 'POST',
            dataType: 'html',
            data: {id:product_id},

            success: function(responseList) 
            {
                const listResponse = JSON.parse(responseList); // CONVERTENDO STRING PARA OBJETO
            
                let id        = document.querySelector(".id"); 
                let nome      = document.querySelector(".nome");
                let preco     = document.querySelector(".preco");
                let arquivo   = document.querySelector(".image");
                let descricao = document.querySelector(".descricao");

                id.value        = listResponse.id;
                nome.value      = listResponse.nome;
                descricao.value = listResponse.descricao;
                preco.value     = listResponse.preco;
                arquivo.src     = listResponse.arquivo;
                arquivo.title   = listResponse.nome;
                
                $(".ark").text(listResponse.arquivo);
               
                $("#editProcuts").modal('show');  
               
            }
        });

        $(".btn-salvar").on("click", function(e)
        {
            e.preventDefault();
            var formUpdate = $('#formUpdate')[0];
            var formData = new FormData(formUpdate);         // CRIA O ELEMENTO
            
            $.ajax({
                url : 'update.php',
                type : "POST",
                data : formData,
                
                contentType : false,
                processData : false,
        
                beforeSend: function()
                {
                    $(".btn-loader").removeClass("d-none");
                    $(".btn-salvar").addClass("d-none");
                },
                success: function(resUpdate)
                {
                    $(".message").show();
                    $(".message").html(resUpdate);
                    $(".btn-loader").addClass("d-none");
                    $(".btn-salvar").removeClass("d-none");
                }, 
                error: function()
                {
                    $("#message").show();
                    $(".btn-loader").addClass("d-none");
                    $(".btn-salvar").removeClass("d-none");
                }
            });
        });
    });
        

    /* -- END EDITAR E SALVAR -- */

    /* -- DELETAR -- */

    $(".delBtn").on("click",function(e){
        var product_id = $(this).val();
        
        $("#deleteProduct").modal('show');             // ABRE O MODAL

        $(".delProduct").on("click", function(e){
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data:{ id:product_id },
                success: function(deleteData){
                    $(".message").show();
                    $(".message").html(deleteData);
                    
                },
                error: function(deleteData){
                    $(".message").show();
                }
            });
        });
    });

    /* -- END DELETAR -- */
    /*
    function getProdutos()
    {
        $.ajax({
            url: '#',
            dataType: 'html',
            success: function(response)
            {
                $("#list").html(response);
                
            }
        });
    }
    */
    function resetForm(){
        
        /* -- CAPTURANDO VALORES -- */
        var nome           = document.getElementById("nome");
        var descricao      = document.getElementById("descricao");
        var preco          = document.getElementById("preco");
        var arquivo        = document.getElementById("arquivo");

        /* -- ATRIBUINDO VALORES INICIAIS -- */

        nome.value='';
        descricao.value='';
        preco.value='';
        arquivo.value='';
    }

   

    $(document).ready(function()
    {
        $('.preco').mask('000.000.000.000.000,00', {reverse: true});
        getProdutos();
        //$("#list").load(location.href + "#list");
    });  

   
</script>
    