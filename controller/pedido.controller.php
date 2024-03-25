<?php


    session_start();


    include "../model/pedido.class.php";
    include "../dao/pedidodao.class.php";
    include "../util/util.class.php";

    $util = new Util();

    switch($_GET['op']){

        case 'cadastrar':

          $jsonPedido =  $_GET['pedido'];
          $jsonUsuario = $_GET['usuario'];

          // Converter a string JSON em um array de objetos PHP
          $carrinho = json_decode($jsonPedido, true); // true para array associativo
          $usuario = json_decode($jsonUsuario, false); // false para objeto padrão (stdClass

          $precoTotal = 0;
          foreach ($carrinho as $produto) {
              $precoTotal += $produto['preco'];
          }

          $comentario = "Itens do pedido: ";
          foreach ($carrinho as $produto) {
              $comentario .= $produto['nome'] . ", ";
          }

          $pedido = new Pedido();

          $pedido->id_usuario = $usuario->id_usuario;
          $pedido->data_pedido = date('Y-m-d H:i:s');
          $pedido->preco_total_pedido = $precoTotal;
          $pedido->comentario = $comentario;

          $pedidoDao = new PedidoDAO();
          $pedidoDao->cadastrarPedido($pedido);

          session_destroy();
          
        break;

    }// fecha o switch 

        


?>