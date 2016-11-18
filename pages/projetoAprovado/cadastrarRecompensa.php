<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateRepasse();

$queryAutor = procuraAutor($_SESSION['cpf']);
$dadosAutor = mysql_fetch_array($queryAutor);
$queryProjeto = consultaProjetoPorId($_GET['id']);
$dadosProjeto = mysql_fetch_array($queryProjeto);

if ($dadosProjeto['autor'] != $_SESSION['cpf'])
{
    echo "<script>alert('Você não acessar o cadastro de recompensas deste projeto, pois ele não o pertence!');"
    . "window.location='projetosAprovados.php';</script>";
}

if (isset($_POST['enviar']))
{
    if ($_POST['valMin'] <= $_POST['valMax'])
    {
        cadastrarRecompensa($_POST['projeto'], $_POST['descricao'], $_POST['valMin'], $_POST['valMax'], $_POST['limite']);
    } else
        echo "<script>alert('Não é possível ter um valor maximo menor que o valor minimo!');</script>";
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

    function mmoney(v)
    {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }

    function mnumber(v)
    {
        v = v.replace(/\D/g, "");
        return v;
    }
</script>

<div class="container">
    <form action="cadastrarRecompensa.php?id=<?php echo $_GET['id'] ?>" method="post" name="repasse">
        <div class="form-group">
            <input type="hidden" name="projeto" class="form-control" id="projeto" value="<?php echo $dadosProjeto['id'] ?>">
        </div>

        <div class="form-group">
            <label for="valor">Descrição da Recompensa:</label>
            <input type="text" name="descricao" required class="form-control" id="descricao">
        </div>
        
        <div class="form-group">
            <label for="valMin">Valor Mínimo:</label>
            <input type="text" name="valMin" required class="form-control" id="valMin" onkeypress="mascara(this, mmoney);">
        </div>
        
        <div class="form-group">
            <label for="valMax">Valor Máximo:</label>
            <input type="text" name="valMax" required class="form-control" id="valMax" onkeypress="mascara(this, mmoney);">
        </div>
        
        <div class="form-group">
            <label for="limite">Limite de Recompensas:</label>
            <input type="text" name="limite" required class="form-control" id="limite" onkeypress="mascara(this, mnumber);">
        </div>
        
        <button type="submit" name="enviar" class="btn btn-success">Confirmar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>
