<?php
  //Iremos integrar PHP com banco utilizando a classe PDO - PHP acesso a dados do objeto:
  //Iremos estender esta classe - utilizando o que chamamos Herança:
  class ConexaoBanco extends PDO {
    //Nesta classe iremos pegar a instancia do banco através do PDO:
    private static $instance = null;
    //Método Construtor - mágico:
    public function __construct($dsn,$user,$pass){
      //Este construtor iremos puxar da classe Super - Pai - PDO:
      parent::__construct($dsn,$user,$pass);
    }
    //Função estática para pegar a conexão do banco - para acessar:
    public static function getInstance(){
      //testando se a conexão já existe - se não existe ele vai conectar
      if(!isset(self::$instance)){
        try{ //tratando excessoes de erro
          self::$instance = new ConexaoBanco("mysql:dbname=dbloja;host=localhost","root","");
        }catch(PDOException $e){
          echo "Erro ao conectar com o BD." .$e;
        }//fechando tratamento
      }//fecha if
      return self::$instance;
    }//fecha o getInstance
  }//fecha a classe
 ?>
