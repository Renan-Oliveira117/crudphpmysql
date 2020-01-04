<?php

$tituloPagina = "Excluir Contato";

include_once 'layouts/header.php';

include_once 'classes/BancoDados.php';
include_once 'classes/Contato.php';

$bancoDados = new BancoDados();
$db = $bancoDados->getConexao();

$contato = new Contato($db);

if ($_POST) {

    $contato->id = $_POST['id'];
    $contato->nome = $_POST['nome'];
    $contato->telefone = $_POST['telefone'];

    if ($contato->excluir()) {
        echo " <div class='alert alert-success' role='alert'> Contato Excluido com Sucesso </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Ocorreu um erro ao excluir contato</div>";
    }
}

if ($_GET['id']) {
    $contato->id = $_GET['id'];

    $contato->selecionar();
}

echo "<h1> Formulário de Excluir contato</h1>";
?>

<form method='post'>
    <div class="form-group">
        <label for="exampleInputEmail1">ID </label>
        <input type="text" class="form-control " name="id" value="<?php echo $contato->id ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">NOME </label>
        <input type="text" class="form-control " name="nome" value="<?php echo $contato->nome ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">TELEFONE </label>
        <input type="text" class="form-control " name="telefone" value="<?php echo $contato->telefone ?>">
    </div>

    <button type="submit" class="btn btn-primary">Excluir</button>
    <a href="index.php" class="btn btn-warning">Incício</a>

</form>

<?php
include_once "layouts/footer.php";

?>