<?php
  class Produto{
    //Atributos - características:
    private $id_produto;
    private $nome_produto;
    private $preco;
    private $imagem;
    private $descricao;
    //Funções - ações da classe:
    
    //Gets e Sets - mágicos (serve para qualquer atributo acima, reduz código):
    public function __get($atributo){
      return $this->$atributo;
    }

    public function __set($atributo,$valor){
      $this->$atributo = $valor;
    }

    // //Função toString:
    public function __toString(){
      return "<br>id: ".$this->id_usuario.
             "<br>Nome: ".$this->nome_produto.
             "<br>Preco: ".$this->preco.
             "<br>Imagem: ".$this->imagem.
             "<br>Descricao: ".$this->descricao;
    }
}

?>
