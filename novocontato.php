<?PHP
session_start();
$tituloPagina = "Novo Contato";

include_once 'layouts/header.php';
include_once 'classes/BancoDados.php';
include_once 'classes/Contato.php';

if ($_POST) {
    $bancodados = new BancoDados();
    $conexao = $bancodados->getConexao();
    $contato = new Contato($conexao);

    $contato->nome = $_POST['nome'];
    $contato->telefone = $_POST['telefone'];

    if ($contato->criar()) {
        $_SESSION['mensagem'] = " Contato criado com sucesso";
        echo " <div class='alert alert-success' role='alert'> Contato Salvo com Sucesso </div>";
        header("Location:novocontato.php");
        exit(0);
    } else {
        echo "<div class='alert alert-danger' role='alert'> Ocorreu um erro ao criar contato</div>";
    }
}
echo "<h1>Formulário de Contato</h1>";
if (isset($_SESSION['mensagem'])) {
    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);
}
?>


<form method='post'>
    <div class="form-group">
        <label for="exampleInputEmail1">Nome </label>
        <input type="text" class="form-control " name="nome">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Telefone</label>
        <input type="text" class="form-control" name="telefone">
    </div>
    <button type="submit" class="btn btn-primary">Cadastra</button>
    <a class="btn btn-warning" href="index.php">Início</a>
</form>
<?php
include_once 'layouts/footer.php';
?>