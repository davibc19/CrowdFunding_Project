<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();

if (isset($_POST['enviar']))
{
    if ($_POST['valMin'] < 0 || $_POST['valMax'] > $_POST['valTotal'] || $_POST['valMin'] > $_POST['valMax'] || $_POST['valMin'] > $_POST['valTotal'])
        echo "<script>alert('Erro nos Valores Mínimo ou Máximo')</script>";
    else
    {
        alterarEditalOrcamento($_GET['id'], $_POST['nome'], $_POST['dataPublicacao'], $_POST['dataTermino'], $_POST['valTotal'], 
                $_POST['valMin'], $_POST['valMax'], $_POST['cotaAluno'], $_POST['cotaProf'], $_POST['cotaServ']);
    }
}

$query = consultaCotaFinanciamenoPorId($_GET['id']);
$dadosCotaFinanciamento = mysql_fetch_array($query);

?>

<script>
    function Submeter()
    {
        with (document.alterarEditalCota)
        {
            var option = confirm("Deseja realmente realizar a atualização do Edital de Orçamento?");
            if (option == true)
            {
                method = "POST";
                action = "alterarEditalCota.php?id=<?php echo $_GET['id']?>";
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
    <form name="cadastroEditalCota?id=<?php echo $_GET['id'] ?>" onSubmit="Submeter();" method="post">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required class="form-control" id="nome" maxlength="50" value="<?php echo $dadosCotaFinanciamento['nome'] ?>">
        </div>
        <div class="form-group">
            <label for="dataPublicacao">Data de Publicação do Edital:</label>
            <input type="text" name="dataPublicacao" required class="form-control" id="dataPublicacao" value="<?php echo $dadosCotaFinanciamento['dataPublicacao'] ?>">
        </div>
        <div class="form-group">
            <label for="dataTermino">Data de Término do Edital:</label>
            <input type="text" name="dataTermino" required class="form-control" id="dataTermino" value="<?php echo $dadosCotaFinanciamento['dataTermino'] ?>">
        </div>
        <div class="form-group">
            <label for="valTotal">Valor Total do Orçamento:</label>
            <input type="text" name="valTotal" required class="form-control" id="valTotal" onkeypress="mascara(this, mmoney);" value="<?php echo $dadosCotaFinanciamento['valTotal'] ?>">
        </div>
        <div class="form-group">
            <label for="valMin">Valor Mínimo:</label>
            <input type="text" name="valMin" required class="form-control" id="valMin" onkeypress="mascara(this, mmoney);" value="<?php echo $dadosCotaFinanciamento['valMin'] ?>">
        </div>
        <div class="form-group">
            <label for="valMax">Valor Máximo:</label>
            <input type="text" name="valMax" required class="form-control" id="valMax" onkeypress="mascara(this, mmoney);"  value="<?php echo $dadosCotaFinanciamento['valMax'] ?>">
        </div>
        <div class="form-group">
            <label for="cotaAluno">Cota do Orçamento para Aluno (0,..):</label>
            <input type="text" name="cotaAluno" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaAluno" value="<?php echo $dadosCotaFinanciamento['cotaAluno'] ?>">
        </div>

        <div class="form-group">
            <label for="cotaProf">Cota do Orçamento para Professor (0,..):</label>
            <input type="text" name="cotaProf" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaProf" value="<?php echo $dadosCotaFinanciamento['cotaProfessor'] ?>">
        </div>

        <div class="form-group">
            <label for="cotaServ">Cota do Orçamento para Servidores Técnicos (0,..):</label>
            <input type="text" name="cotaServ" required class="form-control" onkeypress="mascara(this, mtaxa);" id="cotaServ" value="<?php echo $dadosCotaFinanciamento['cotaServ'] ?>">
        </div>


        <button type="submit" name="enviar" class="btn btn-success">Salvar Alterações</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>
<?php include("../template/footer.php") ?>
