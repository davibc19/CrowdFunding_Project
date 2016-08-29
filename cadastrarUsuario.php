<?php 
    require_once './validateSessionFunctions.php';
    validateHeader();
?>


<div class="container">
    <form>
        <div class="form-group">
            <label for="tipoUsr">Tipo de Usuário</label>
            <br/>
            <select class="selectpicker" id="tipoUsr">
                <option value="3">Gestor de Projetos</option>
                <option value="4">Financiador Técnico</option>
                <option value="5" selected>Financiador Aluno</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" required class="form-control" id="nome">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" required class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" required class="form-control" id="pwd">
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" required class="form-control" id="cpf">
        </div>

        <button type="submit" class="btn btn-default">Cadastrar</button>
        <button type="reset" class="btn btn-default">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
