<?php 
    require_once './validateSessionFunctions.php';
    require_once './functionsBd.php';
    validateHeader();
    
    if(isset($_POST['enviar']))
    {
        cadastrarEditalOrcamento($_POST['ano'], $_POST['valTotal']);
    }
?>


<div class="container">
    <form action="cadastrarEditalOrcamento.php" method="post" name="CadastrarEditalOrcamento">
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" name="ano" required class="form-control" id="ano">
        </div>
        <div class="form-group">
            <label for="valTotal">Valor Total:</label>
            <input type="text" name="valTotal" required class="form-control" id="valTotal">
        </div>

        <button type="submit" name="enviar" class="btn btn-default">Cadastrar</button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
