<?php
  //Requerindo a classe de conexão com o banco:
  require '../persistence/conexaobanco.class.php';

  class ProdutoDAO { //DAO Acesso a dados do objeto
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
    public function cadastrarProduto($produto){
      try {
        //Tratando excessões de erros - Vê pnde não está funcionando no banco
        //Lembrando que BD não é case sensitive
        $stat = $this->conexao->prepare("INSERT INTO produto(id_produto,nome_produto,preco,imagem,descricao) VALUES(null,?,?,?,?)");
        //Pegando ps atributos da classe Contato e colocando no lugar dos ? - ?=bind
        $stat->bindValue(1,$produto->nome_produto);
        $stat->bindValue(2,$produto->preco);
        $stat->bindValue(3,$produto->imagem);
        $stat->bindValue(4,$produto->descricao);
        //Mandamos executar a linha de comando do prepare:
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao cadastrar produto." .$e;
      }
    }


    //Função para listar todos os cadastros:
    //Busca abrangente - retornar nenhum - um ou muitos resultado
    public function listarProdutos(){
      //try catch para tratar os erros vindos do banco
      try{
        //Variável stat para acessar o banco, utilizamos sempr QUERY para SELECT
        $stat = $this->conexao->query("SELECT * FROM produto");
        //Criamos uma variável para receber a lista de resultados - array
        $array = array();

        //Na linha abaixo ele irá percorrer toda a lista (fetchALL)
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Produto');
        //Finalizar a conexão
        $this->conexao = null;
        //Retorna o que encontrou
        return $array;
      }catch(PDOException $e){
        echo "Erro ao buscar contatos." .$e;
      }
    }

    //Função para deletar produto:
    public function deletarProduto($id_produto){
      //Tratando as excessões
      try{
        //Criamos uma variavel que acessa o banco e cria  script
        $stat = $this->conexao->prepare("DELETE FROM produto WHERE id_produto=?");
        //Definindo valor do bind:
        $stat->bindValue(1,$id_produto);
        //Executamos o script:
        $stat->execute();
        //finalizamos a execução
        $stat->conexao = null;
      }catch (PDOException $e){
        echo "Erro ao deletar produto." .$e;
      }
    }//fim da função deletar

    //Função para atualizar o valor do produto:
    public function atualizarProduto($produto){
      try{
        //Criamos uma variavel que acessa o banco e cria  script
        $stat = $this->conexao->prepare("UPDATE produto SET preco=? WHERE id_produto=?");
        //Definindo valor do bind:
        $stat->bindValue(1,$produto->preco);
        $stat->bindValue(2,$produto->id_produto);
        //Executamos o script:
        $stat->execute();
        //finalizamos a execução
        $stat->conexao = null;
      }catch (PDOException $e){
        echo "Erro ao atualizar produto." .$e;
      }
    }//fim da função atualizar

  }//Final da classe
?>