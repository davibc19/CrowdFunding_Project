<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();

if (isset($_POST['enviar'])) {
    alterarUsuario($_SESSION['cpf'], $_POST['nome'], $_POST['email'], $_POST['senha']);
}

$query = procuraAutor($_SESSION['cpf']);
$dados = mysql_fetch_array($query);
?>


<div class="container">
    <form action="alterarUsuario.php" method="post" name="AlterarUsuario">
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $dados['nome'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $dados['email'] ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" name="senha" class="form-control" id="pwd" value="<?php echo $dados['senha'] ?>">
        </div>

        <button type="submit" name="enviar" class="btn btn-success">Alterar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>