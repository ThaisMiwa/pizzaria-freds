<?php
  class Pedido{
    //Atributos - características:
    private $id_pedido;
    private $id_usuario;
    private $data_pedido;
    private $preco_total_pedido;
    private $comentario;
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
      return "<br>id: ".$this->id_pedido.
             "<br>id_usuario: ".$this->id_usuario.
             "<br>data_pedido: ".$this->data_pedido.
             "<br>preco_total_pedido: ".$this->preco_total_pedido.
             "<br>comentario: ".$this->comentario;
    }
}

?>
