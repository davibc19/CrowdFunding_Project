<?php 
    require_once './validateSessionFunctions.php';
    require_once './functionsBd.php';
    validateHeader();
    
     if(isset($_POST['enviar']))
    {
        alterarUsuario($_GET['cod'], $_POST['nome'], $_POST['email'], $_POST['senha']);
    }
?>


<div class="container">
    <form action="alterarUsuario.php?cod=<?php echo $_SESSION['id'] ?>" method="post" name="CadastrarUsuario">
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" class="form-control" id="nome">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" name="senha" class="form-control" id="pwd">
        </div>

        <button type="submit" name="enviar" class="btn btn-default">Alterar</button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
