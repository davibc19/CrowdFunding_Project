<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();

if (isset($_POST['enviar']))
{
    cadastrarUsuario($_POST['tipoUsr'], $_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['senha']);
}
?>

<script type="text/javascript">
    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }
    function mcpf(v)
    {
        v = v.replace(/\D/g, "")                    //Remove tudo o que não é dígito
        v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
</script>

<div class="container">
    <form action="cadastrarUsuario.php" method="post" name="CadastrarUsuario">
        <div class="form-group">
            <label for="tipoUsr">Tipo de Usuário</label>
            <br/>
            <select class="selectpicker" id="tipoUsr" name="tipoUsr">
                <option value="gestorProjeto">Gestor de Projetos</option>
                <option value="tecnico">Financiador Técnico</option>
                <option value="aluno" selected>Financiador Aluno</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" required class="form-control" id="cpf" onkeypress="mascara(this, mcpf);" maxlength="14">
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

<?php include("../template/footer.php") ?>
