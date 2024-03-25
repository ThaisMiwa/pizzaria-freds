<?php
  //Requerindo a classe de conexão com o banco:
  require '../persistence/conexaobanco.class.php';

  class PedidoDAO { //DAO Acesso a dados do objeto
    //Atributo de conexao:
    private $conexao = null;

    //Método construtor:
    public function __construct(){
      //Quando pedir conexao - iremos acessar a pesistência e pegar a conexão do banco lá: getInstance()
      $this->conexao = ConexaoBanco::getInstance();
    }
    //Método para sair do banco - destruir a conexao:
    public function __destruct(){

    }

    //A PARTIR DAQUI FAREMOS UMA POR UMA DAS FUNÇÕES DO CRUD:
    //**Create - INSERT (banco) - Cadastrar
    //**Read - SELECT (banco) - ler - pesquisar - listar
    //Update - UPDATE (banco) - editar - atualizar
    //Delete - DELETE (banco) - excluir - deletar

    //Função para cadastrar:
    public function cadastrarPedido($pedido){
      try {
        //Tratando excessões de erros - Vê pnde não está funcionando no banco
        //Lembrando que BD não é case sensitive
        $stat = $this->conexao->prepare("INSERT INTO pedido(id_pedido,id_usuario,data_pedido,preco_total_pedido,comentario) VALUES(null,?,?,?,?)");
        //Pegando ps atributos da classe Contato e colocando no lugar dos ? - ?=bind
        $stat->bindValue(1,$pedido->id_usuario);
        $stat->bindValue(2,$pedido->data_pedido);
        $stat->bindValue(3,$pedido->preco_total_pedido);
        $stat->bindValue(4,$pedido->comentario);
        //Mandamos executar a linha de comando do prepare:
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao cadastrar pedido." .$e;
      }
    }
  }//Final da classe
?>