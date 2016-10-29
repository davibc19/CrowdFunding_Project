<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();

if (isset($_POST['enviar']))
{
    if((int)$_POST['peso']>=1 && (int)$_POST['peso']<=10)
        alterarCriterio($_POST['id'], $_POST['criterio'], $_POST['peso']);
    else
        echo"<script>alert('Valor inválido para o peso!');</script>";
}

$query = consultaCriterioPorId($_GET['id']);
$dados = mysql_fetch_array($query);

?>

<script>
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
    <form action="alterarCriterio.php" method="post" name="AlterarCriterio">
        <div class="form-group">
            <label for="criterio">Critério de Avaliação:</label>
            <input type="text" name="criterio" class="form-control" id="criterio" value="<?php echo $dados['criterio'] ?>">
        </div>
        <div class="form-group">
            <label for="peso">Peso:</label>
            <input type="text" name="peso" maxlength="2" class="form-control" id="peso" value="<?php echo $dados['peso'] ?>" onkeypress="mascara(this, mnumber)";>
        </div>
        
        <input type='hidden' id='id' name='id' value='<?php echo $_GET['id']?>'>
        
        <button type="submit" name="enviar" class="btn btn-success">Alterar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>