<?php
  //Requerindo a classe de conexão com o banco:
  require '../persistence/conexaobanco.class.php';

  class UsuarioDAO { //DAO Acesso a dados do objeto
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
    public function cadastrarUsuario($usuario){
      try {
        //Tratando excessões de erros - Vê pnde não está funcionando no banco
        //Lembrando que BD não é case sensitive
        $stat = $this->conexao->prepare("INSERT INTO usuario(id_usuario,nome,email,senha,situacao)VALUES(null,?,?,?,?)");
        //Pegando ps atributos da classe Contato e colocando no lugar dos ? - ?=bind
        $stat->bindValue(1,$usuario->nome); 
        $stat->bindValue(2,$usuario->email);
        $stat->bindValue(3,$usuario->senha);
        $stat->bindValue(4,$usuario->situacao);
        //Mandamos executar a linha de comando do prepare:
        $stat->execute();
      }catch(PDOException $e){
        echo "Erro ao cadastrar usuario." .$e;
      }
    }

    //Função para buscar um usuario pelo id:
    public function buscarUsuarioPorId($id_usuario){
      try{
        //Variável stat para acessar o banco, utilizamos sempr QUERY para SELECT
        $stat = $this->conexao->query("SELECT * FROM usuario WHERE id_usuario = $id_usuario");
        //Criamos uma variável para receber a lista de resultados - array
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
        //Finalizar a conexão
        $this->conexao = null;
        //Retorna o que encontrou
        return $array;
      }catch(PDOException $e){
        echo "Erro ao buscar usuario." .$e;
      }
    }

    public function buscarUsuarioPorEmail($email) {
      try {
        $stat = $this->conexao->query("SELECT * FROM usuario WHERE email = '$email'");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, 'Usuario');
        $this->conexao = null;
        return $array;
      } catch (PDOException $e) {
        echo "Erro ao buscar usuario." . $e;
      }
    }
  


    //Função para listar todos os cadastros:
    //Busca abrangente - retornar nenhum - um ou muitos resultado
    public function buscarUsuario(){
      //try catch para tratar os erros vindos do banco
      try{
        //Variável stat para acessar o banco, utilizamos sempr QUERY para SELECT
        $stat = $this->conexao->query("SELECT * FROM usuario");
        //Criamos uma variável para receber a lista de resultados - array
        $array = array();

        //Na linha abaixo ele irá percorrer toda a lista (fetchALL)
        $array = $stat->fetchAll(PDO::FETCH_CLASS,'Usuario');
        //Finalizar a conexão
        $this->conexao = null;
        //Retorna o que encontrou
        return $array;
      }catch(PDOException $e){
        echo "Erro ao buscar contatos." .$e;
      }
    } 

    //Função para deletar contato:
    public function deletarContato($id_usuario){
      //Tratando as excessões
      try{
        //Criamos uma variavel que acessa o banco e cria  script
        $stat = $this->conexao->prepare("DELETE FROM usuario WHERE id_usuario=?");
        //Definindo valor do bind:
        $stat->bindValue(1,$id_usuario);
        //Executamos o script:
        $stat->execute();
        //finalizamos a execução
        $stat->conexao = null;
      }catch (PDOException $e){
        echo "Erro ao deletar contato." .$e;
      }
    }
  }//Final da classe
?>