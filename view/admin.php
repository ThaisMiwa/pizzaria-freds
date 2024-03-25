<?php
    session_start();

    if(!isset($_SESSION['id_usuario'])) {
        header("location:../view/login.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" contente="YE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Fred's Pizza: Onde sabores ganham vida" />
    <meta
      name="keywords"
      content="Fred's Pizza, Pizzaria, Pizza, Entrega, Delivery"
    />
    <link rel="shortcut icon" href="imagens/minilogo.png" />
    <link rel="stylesheet" href="../css/style.css" />

    <!--Link dos logos facebook, instagran e carrinho-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />

    <title>Página de Administração</title>
  </head>

  <body>
    <!--Criamos o header, onde fica a página de navegação-->
    <!-- Coloca o logo do projeto junto com nome na barra de navegação-->

    <header class="content">
      <div class="logo">
        <img
          class="img"
          src="./imagens/WhatsApp Image 2024-02-07 at 14.30.22 (1).jpeg"
          alt="Logo"
        />
        <h3 class="titulo-admin">Página de Administração</h3>
      </div>
      <nav>
        <!--Colocamos uma nav para deixar o html semantica.-->
        <!--Essa nav explica para o brawser que a nav nada mais é que uma barra de nevegação-->
        <ul class="list-menu">
          <li><a href="./painelcadastro.html">Cadastro</a></li>
          <li><a href="./cardapio.php">Cárdapio</a></li>
          <li><a href="#">contatos</a></li>
          <li>
            <a href="#"><i class="bi bi-facebook"></i></a>
          </li>
          <li>
            <a href="#"><i class="bi bi-instagram"></i></a>
          </li>
          <li>
            <a href="./carrinho.php"><i class="bi bi-cart3"></i></a>
          </li>
        </ul>
      </nav>
    </header>

    <section class="cadastro-pizza">
      <div class="formulario">
        <form
          class="gerenciar"
          action="../controller/produto.controller.php?op=cadastrar"
          method="post"
          enctype="multipart/form-data"
        >
          <h3 class="preencha">Preencha o formulário de cadastro</h3>
          <div class="campos">
            <div class="campo">
              <label for="nome">Nome do Produto:</label>
              <input type="text" name="nome_produto" class="nome" required />
            </div>
            <div class="campo">
              <label for="descricao">Descrição:</label>
              <textarea name="descricao" class="descricao" required></textarea>
            </div>
            <div class="campo">
              <label for="preco">Preço:</label>
              <input type="number" name="preco" class="preco" step="0.01" min="0" required />
            </div>
            <div class="campo">
              <label for="imagem">Imagem:</label>
              <input type="file" name="imagem" class="imagem" required />
            </div>
          </div>

          <button type="submit">Adicionar</button>

          <div class="back-home">
            <a href="../index.html">Voltar</a>
          </div>
        </form>
      </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
          let usuarioLocalStorage = JSON.parse(localStorage.getItem("usuario"));

          if (
            usuarioLocalStorage.id_usuario == null
          ) {
            window.location.href = "../login.html";
          }
        });
    </script>
  </body>
</html>
