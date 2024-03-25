<?php


    session_start();


    include "../model/usuario.class.php";
    include "../dao/usuariodao.class.php";
    include "../util/util.class.php";

    $util = new Util();

    switch($_GET['op']){

        case 'login':

            $usuario = new Usuario();

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            if (empty($email) || empty($senha)) {
                echo "Preencha todos os campos";
                die();
            }

            if (!$util-> validarEmail($email)){
                echo 'Email fora do padrão';
                die();
            }

            $usuario->email = $email;
            $usuario->senha = $senha;

            $usuarioDao = new UsuarioDAO();
            $verificarEmail = $usuarioDao->buscarUsuarioPorEmail($usuario->email);

            if(count($verificarEmail) == 0){
                echo "Email não cadastrado";
                die();
            }

            if($verificarEmail[0]->senha != $usuario->senha){
                echo "Senha incorreta";
                die();
            }

            $_SESSION['id_usuario'] = $verificarEmail[0]->id_usuario;
            $_SESSION['email'] = $verificarEmail[0]->email;
            $_SESSION['nome'] = $verificarEmail[0]->nome;

            header("location:../view/cardapio.php");
        break;

        case 'cadastrar':
            
          $usuario = new Usuario();

          $nome = $_POST['nome'];
          $email = $_POST['email'];
          $senha = $_POST['senha'];

          if (empty($nome) || empty($email) || empty($senha)) {
              echo "Preencha todos os campos";
              die();
          }
          if (!$util-> testarExpressaoRegular('/^[A-Za-zÙ-Áù-á ]{2,30}$/',$nome)){
              echo 'Nome fora do padrão';
              die();
          }
          if (!$util-> validarEmail($email)){
              echo 'Email fora do padrão';
              die();
          }

          $usuario->nome = $nome;
          $usuario->email = $email;
          $usuario->senha = $senha; 
          $usuario->situacao = 1;

          $usuarioDao = new UsuarioDAO();
          $usuarioDao->cadastrarUsuario($usuario);

          header("location:../index.html");
            
        break;


    }// fecha o switch 

        


?>