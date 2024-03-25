<?php


    session_start();


    include "../model/produto.class.php";
    include "../dao/produtodao.class.php";
    include "../util/util.class.php";

    $util = new Util();

    switch($_GET['op']){

        case 'cadastrar':
            
          $produto = new Produto();

          $nome_produto = $_POST['nome_produto'];
          $preco = $_POST['preco'];
          $imagem = $_FILES['imagem']['tmp_name'];
          $descricao = $_POST['descricao'];

          if (empty($nome_produto) || empty($preco) || empty($imagem) || empty($descricao)) {
              echo "Preencha todos os campos";
              die();
          }
          if (!$util-> testarExpressaoRegular('/^[A-Za-zÙ-Áù-á ]{2,30}$/',$nome_produto)){
              echo 'Nome do produto está fora do padrão';
              die();
          }

          if (isset($_FILES['imagem'])) {
            $extensao = $_FILES['imagem']['type'];

            if ($extensao != 'image/png' && $extensao != 'image/jpeg' && $extensao != 'image/jpg') {
                echo "A imagem deve ser do tipo PNG ou JPEG";
                die();
            }

            // Leia o conteúdo da imagem
            $imagem_conteudo = file_get_contents($imagem);

            // Converta a imagem para base64
            $imagem_base64 = base64_encode($imagem_conteudo);

            // Salve a imagem no banco de dados
            $produto->imagem = $imagem_base64;
          }


          $produto->nome_produto = $nome_produto;
          $produto->preco = $preco;
          $produto->descricao = $descricao;

          $produtoDao = new ProdutoDAO();
          $produtoDao->cadastrarProduto($produto);

          header("location:../view/cardapio.php");
            
        break;
        // aqui inicia a função consultar
		case 'consultar':
            // instanciar a classe DAO
            $produto = new Produto();
            // buscar o array de contatos cadastrados
            $array = array();
            // ativar a função do select * from contato
            $array = $produto->buscarProdutos();



            header("location:../visao/olho.consultar.php");

        break;

        case 'deletar':
           //Instaciar novamente a classe DAO - não usar a instancia anterior, da erro:
            $produtoDao = new ProdutoDAO();
            //Vamos chamar a função que deleta:
            $produtoDao->deletarProduto($_REQUEST['id']);
            //Direcionar para uma página:
            header('location:../view/buscarcontatos.php');
        break;

        case 'atualizar':
            //Instaciar novamente a classe DAO - não usar a instancia anterior, da erro:
            $produtoDao = new ProdutoDAO();

            $id_produto = $_REQUEST['id'];
            $preco = $_REQUEST['preco'];

            $produto = new Produto();
            $produto->id_produto = $id_produto;
            $produto->preco = $preco;

            //Vamos chamar a função que deleta:
            $produtoDao->atualizarProduto($produto);
            //Direcionar para uma página:
            header('location:../view/buscarcontatos.php');
    }// fecha o switch 

        


?>