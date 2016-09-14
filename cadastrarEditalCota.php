<?php

require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();
validateGO();

if (isset($_POST['enviar']))
{
    cadastrarEditalOrcamento($_POST['ano'], $_POST['valTotal']);
    
    cadastrarCotaFinanciamento($_POST['ano'], $_POST['valTotal'], $_POST['cotaAluno'],
            $_POST['cotaProf'], $_POST['cotaServ']);
}
?>

<script>
    function Submeter()
    {
        with (document.cadastroEditalCota)
        {
            var option = confirm("Deseja realmente realizar o cadastro do Edital de Orçamento?");
            if (option == true) 
            {
                method = "POST";
                action = "cadastrarEditalCota.php";
                x = "Usuário Cadastrado com Sucesso";
                submit();
            }
        }
    }
</script>


<div class="container">
    <form name="cadastroEditalCota" onSubmit="Submeter();">
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" name="ano" required class="form-control" id="ano">
        </div>
        <div class="form-group">
            <label for="valTotal">Valor Total do Orçamento:</label>
            <input type="text" name="valTotal" required class="form-control" id="valTotal">
        </div>
        <div class="form-group">
            <label for="cotaAluno">Cota do Orçamento para Aluno:</label>
            <input type="text" name="cotaAluno" required class="form-control" id="cotaAluno">
        </div>
        
        <div class="form-group">
            <label for="cotaProf">Cota do Orçamento para Professor:</label>
            <input type="text" name="cotaProf" required class="form-control" id="cotaProf">
        </div>
        
        <div class="form-group">
            <label for="cotaServ">Cota do Orçamento para Servidores Técnicos:</label>
            <input type="text" name="cotaServ" required class="form-control" id="cotaServ">
        </div>
        
        
        <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
