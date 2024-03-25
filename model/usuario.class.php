<?php
  class Usuario{
    //Atributos - características:
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $situacao;
    //Funções - ações da classe:
    
    //Gets e Sets - mágicos (serve para qualquer atributo acima, reduz código):
    public function __get($atributo){
      return $this->$atributo;
    }

    public function __set($atributo,$valor){
      $this->$atributo = $valor;
    }

    //Função toString:
    public function __toString(){
      return "<br>id: ".$this->id_usuario.
             "<br>Nome: ".$this->nome.
             "<br>Email: ".$this->email.
             "<br>senha: ".$this->senha.
             "<br>situacao: ".$this->situcao;
    }
}

?>
