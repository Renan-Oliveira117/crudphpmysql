<?php

class Contato
{
    public $id;
    public $nome;
    public $telefone;
    private $conexao;

    public function __construct($con)
    {
        $this->conexao = $con;
    }

    public function criar()
    {
        $SQL = "INSERT INTO contatos(nome,telefone) VALUES (:NOME,:TELEFONE)";

        $stmt = $this->conexao->prepare($SQL);

        $stmt->bindParam(':NOME', $this->nome);
        $stmt->bindParam(':TELEFONE', $this->telefone);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function lerTodos(){
            $SQL="select *from contatos";
            $stmt = $this->conexao->prepare($SQL);

           $stmt->execute();
           return  $stmt;
    }
}
