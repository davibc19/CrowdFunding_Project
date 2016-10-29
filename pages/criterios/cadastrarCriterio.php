<?php

require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();

if (isset($_POST['enviar']))
{
    if((int)$_POST['peso']>=1 && (int)$_POST['peso']<=10)
        cadastrarCriterio($_POST['categoria'], $_POST['criterio'], $_POST['descricao'], $_POST['status'], $_POST['peso']);
    else
        echo"<script>alert('Valor inválido para o peso!');</script>";
}
?>

<script>
    function Submeter()
    {
        with (document.cadastroEditalCota)
        {
            var option = confirm("Deseja realmente realizar o cadastro do Critério?");
            if (option == true)
            {
                method = "POST";
                action = "cadastrarCriterio.php";
                x = "Usuário Cadastrado com Sucesso";
                submit();
            }
        }
    }
    function mascara(o, f) {
        v_obj = o;
        v_fun = f;
        setTimeout("execmascara()", 1);
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value);
    }
    function mnumber(v)
    {
        v = v.replace(/\D/g, "");                  //Remove tudo o que não é dígito
        return v;
    }
</script>


<div class="container">
    <form name="cadastroEditalCota" onSubmit="Submeter();">
        <div class="form-group">
                <label for="categoria">Categoria do Projeto</label>
                <select class="selectpicker form-control" id="categoria" name="categoria">
                    <option value="Pesquisa">Pesquisa</option>
                    <option value="Competição Tecnológica">Competição Tecnológica</option>
                    <option value="Inovação no Ensino">Inovação no Ensino</option>
                    <option value="Manutenção e Reforma">Manutenção e Reforma</option>
                    <option value="Pequenas Obras">Pequenas Obras</option>
                </select>
            </div>
        <div class="form-group">
            <label for="criterio">Critério de Avaliação:</label>
            <input type="text" name="criterio" required class="form-control" id="criterio">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name=descricao required class="form-control" cols=8 rows=3 maxlength="100"></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="selectpicker form-control" id="status" name="status">
                    <option value="ativado">Ativado</option>
                    <option value="desativado">Desativado</option>
                </select>
        </div>
        <div class="form-group">
            <label for="peso">Peso:</label>
            <input type="text" name="peso" required class="form-control" id="peso" min="1" max="10" onkeypress="mascara(this, mnumber);">
        </div>
        


        <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>
<?php include("../template/footer.php") ?>
