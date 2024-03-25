<!--HTML do Cardapio-->

<?php
    session_start();

    if(!isset($_SESSION['id_usuario'])) {
        header("location:../view/login.html");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fred's Pizza: Onde sabores ganham vida">
    <meta name="keywords" content="Fred's Pizza, Pizzaria, Pizza, Entrega, Delivery">
    <link rel="shortcut icon" href="../imagens/minilogo.png">
    <link rel="stylesheet" href="../css/cardapio.css">

    <title>Cardápio</title>
</head>


<body>

    <header>
        <h2 class="titulo-cardapio">CARDÁPIO</h2>
    </header>

    <div class="container-sidebar">
        <div class="sidebar">
            <ul class="itens-sidebar">
                <li><a href="../index.html">Pagina Inicial</a></li>
                <li><a href="./carrinho.php">Carrinho</a></li>
            </ul>
        </div>

        <section class="cardapio">

            <?php
            include "../model/produto.class.php";
            include "../dao/produtodao.class.php";
            $produtoDao = new ProdutoDAO();
            $produtos = $produtoDao->listarProdutos();
            ?>

            <div class="itens-cardapio">

                <?php
                foreach ($produtos as $produto) {
                    echo <<<HTML
                        <div class="item">
                          <button class="botao-img" data-id="{$produto->id_produto}">
                            <img class="imagem-cardapio" src="data:image/jpeg;base64,{$produto->imagem}" alt="{$produto->nome_produto}">
                          </button>
                          <div class="info">
                            <div>
                                <h3>{$produto->nome_produto}</h3>
                                <h4>Preço <span>R$ {$produto->preco}</span></h4>
                                <br>
                                <h3>{$produto->descricao}</h3>
                            </div>
                            <div>
                                <button class="botao-deletar" data-id="{$produto->id_produto}" onclick="deleteItem({$produto->id_produto})">Deletar</button>
                                <button class="botao-editar" data-id="{$produto->id_produto}" onclick="putValueItem({$produto->id_produto})">Editar</button>
                            </div>
                          </div>
                        </div>
                        HTML;
                }
                ?>
            </div>
        </section>

        <script>
            let usuario = {
                    id_usuario: "<?php echo $_SESSION['id_usuario'] ?>",
                    email: "<?php echo $_SESSION['email'] ?>",
                    nome: "<?php echo $_SESSION['nome'] ?>"
            }

            localStorage.setItem('usuario', JSON.stringify(usuario))
            
            document.addEventListener('DOMContentLoaded', function() {
                let usuarioLocalStorage = JSON.parse(localStorage.getItem('usuario'))

                if(usuario.id_usuario == "" || usuarioLocalStorage.id_usuario == null) {
                    window.location.href = "../login.html"
                }
            })
        </script>
        <script src="../js/cardapio.js"></script>
</body>

</html>