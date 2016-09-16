<?php

require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();
validateGO();

if (isset($_POST['enviar']))
{
    cadastrarEditalOrcamento($_POST['ano'], $_POST['valTotal'], $_POST['cotaAluno'], $_POST['cotaProf'], $_POST['cotaServ']);
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
    function mascara(o, f) {
        v_obj = o;
        v_fun = f;
        setTimeout("execmascara()", 1);
    }
    function execmascara() {
        v_obj.value = v_fun(v_obj.value);
    }
    function myear(v)
    {
        v = v.replace(/\D/g, "");                  //Remove tudo o que não é dígito
        return v;
    }
    function mmoney(v)
    {
        v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
        /*v = v.replace(/(\d)(\d{11})$/, "$1$2");//coloca o ponto dos trilhões
        v = v.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos bilhões
        v = v.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhões
        */
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }
    
    function mtaxa(v)
    {
        v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }
</script>


<div class="container">
    <form name="cadastroEditalCota" onSubmit="Submeter();">
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" name="ano" required class="form-control" id="ano" onkeypress="mascara(this, myear);" maxlength="4">
        </div>
        <div class="form-group">
            <label for="valTotal">Valor Total do Orçamento:</label>
            <input type="text" name="valTotal" required class="form-control" id="valTotal" onkeypress="mascara(this, mmoney);">
        </div>
        <div class="form-group">
            <label for="cotaAluno">Cota do Orçamento para Aluno (0,..):</label>
            <input type="text" name="cotaAluno" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaAluno">
        </div>

        <div class="form-group">
            <label for="cotaProf">Cota do Orçamento para Professor (0,..):</label>
            <input type="text" name="cotaProf" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaProf">
        </div>

        <div class="form-group">
            <label for="cotaServ">Cota do Orçamento para Servidores Técnicos (0,..):</label>
            <input type="text" name="cotaServ" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaServ">
        </div>


        <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
