<?php 
    require_once './validateSessionFunctions.php';
    require_once './functionsBd.php';
    validateHeader();
    
    if(isset($_POST['enviar']))
    {
        cadastrarUsuario($_POST['tipoUsr'], $_POST['cpf'], $_POST['nome'],
                $_POST['email'], $_POST['senha']);
    }
?>


<div class="container">
    <form action="cadastrarUsuario.php" method="post" name="CadastrarUsuario">
        <div class="form-group">
            <label for="tipoUsr">Tipo de Usuário</label>
            <br/>
            <select class="selectpicker" id="tipoUsr" name="tipoUsr">
                <option value="3">Gestor de Projetos</option>
                <option value="4">Financiador Técnico</option>
                <option value="5" selected>Financiador Aluno</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required class="form-control" id="cpf">
        </div>
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" required class="form-control" id="nome">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" required class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" name="senha" required class="form-control" id="pwd">
        </div>
        

        <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
