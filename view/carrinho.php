<?php
    session_start();

    if(!isset($_SESSION['id_usuario'])) {
        header("location:../view/login.html");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Fred's Pizza: Onde sabores ganham vida" />
    <meta
      name="keywords"
      content="Fred's Pizza, Pizzaria, Pizza, Entrega, Delivery"
    />
    <link rel="shortcut icon" href="imagens/minilogo.png" />
    <link rel="stylesheet" href="../css/carrinho.css" />

    <title>Carrinho</title>
  </head>

  <body>
    <header>
      <h2 class="titulo-carrinho">CARRINHO</h2>
    </header>

    <div class="container-sidebar">
      <div class="sidebar">
        <ul class="itens-sidebar">
          <li><a href="../index.html">Página Inicial</a></li>
          <li><a href="./cardapio.php">Cardápio</a></li>
        </ul>
      </div>

      <section class="carrinho">
        <div class="itens-carrinho">
          <h3 class="titulo-itens-carrinho">Itens no Carrinho</h3>
          <ul id="cart-items">
            <!-- Itens do carrinho serão inseridos aqui -->
          </ul>
          <p>Total: R$ <span id="total-price">0.00</span></p>
        </div>

        <div class="botoes-carrinho">
          <button class="botao-finalizar" onclick="finalizarPedido()">
            Finalizar Pedido
          </button>

          <button onclick="cleanAll()">Limpar Carrinho</button>
        </div>
      </section>
    </div>
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

    <script src="../js/carrinho.js"></script>
  </body>
</html>
