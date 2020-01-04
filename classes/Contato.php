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
    public function lerTodos()
    {
        $SQL = "select *from contatos";
        $stmt = $this->conexao->prepare($SQL);

        $stmt->execute();
        return  $stmt;
    }

    function selecionar()
    {
        $query = "SELECT * FROM contatos WHERE id = " . $this->id;

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        $linha = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $linha['id'];
        $this->nome = $linha['nome'];
        $this->telefone = $linha['telefone'];
    }

    function atualizar()
    {

        $query = "UPDATE contatos SET nome= :NOME, telefone = :TELEFONE WHERE id = :ID";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":NOME", $this->nome);
        $stmt->bindParam(":TELEFONE", $this->telefone);
        $stmt->bindParam(":ID", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function excluir()
    {

        $query = "DELETE  FROM contatos WHERE id =".$this->id;

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();

        $stmt->bindParam(":NOME", $this->nome);
        $stmt->bindParam(":TELEFONE", $this->telefone);
        $stmt->bindParam(":ID", $this->id);

       
    }
}
