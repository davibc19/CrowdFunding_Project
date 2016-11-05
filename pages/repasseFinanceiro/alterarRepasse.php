<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateRepasse();

$queryAutor = procuraAutor($_SESSION['cpf']);
$dadosAutor = mysql_fetch_array($queryAutor);
$queryProjeto = consultaProjetoPorId($_GET['idProjeto']);
$dadosProjeto = mysql_fetch_array($queryProjeto);
$queryRepasse = consultaRepassePorId($_GET['id']);
$dadosRepasse = mysql_fetch_array($queryRepasse);

if ($dadosProjeto['autor'] != $_SESSION['cpf'])
{
    echo "<script>alert('Você não acessar o repasse financeiro deste projeto, pois ele não o pertence!');"
    . "window.location='projetosAprovados.php';</script>";
}

if (isset($_POST['enviar']))
{
    if ($_POST['valor'] <= $dadosProjeto['valorTotal'])
    {
        echo "<script>var option =  confirm('Você deseja alterar o repasse para o valor de " . $_POST['valor'] . "?');"
        . "if(option != true)"
        . "window.location='../projetoAprovado/infoProjetosAprovados.php?id=" . $_GET['id'] . "';</script>";
        alterarRepasse($_GET['id'], $_POST['valor'], $_POST['data']);
    } else
        echo "<script>alert('Não é possível ter um repasse maior que o valor total do projeto!');</script>";
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
</script>

<div class="container">
    <form action="alterarRepasse.php?id=<?php echo $_GET['id'] ?>&idProjeto=<?php echo $_GET['idProjeto'] ?>" method="post" name="repasse">
        <div class="form-group">    
            <input type="hidden" name="data" required class="form-control" id="data" 
                   value="<?php
                   date_default_timezone_set('America/Sao_Paulo');
                   $date = date('Y-m-d');
                   echo $date;
                   ?>"
                   >  
        </div>

        <div class="form-group">
            <label for="valor">Valor para Doação:</label>
            <input type="text" name="valor" required class="form-control" value="<?php echo $dadosRepasse['valor'] ?>" id="valor" onkeypress="mascara(this, mmoney);"">
        </div>

        <button type="submit" name="enviar" class="btn btn-success">Confirmar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>
