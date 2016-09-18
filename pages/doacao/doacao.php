<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateDonation();

$queryAutor = procuraAutor($_SESSION['cpf']);
$dadosAutor = mysql_fetch_array($queryAutor);
$queryProjeto = consultaProjetoPorId($_GET['id']);
$dadosProjeto = mysql_fetch_array($queryProjeto);

if ($dadosProjeto['autor'] == $_SESSION['cpf'])
{
    echo "<script>alert('Você não pode doar para seu próprio projeto!');"
    . "window.location='projetosAprovados.php';</script>";
}

if (isset($_POST['enviar']))
{
    if ($_POST['valor'] <= $dadosAutor['saldo'])
    {
        echo "<script>var option =  confirm('Você deseja doar " . $_POST['valor'] . "?');"
        . "if(option != true)"
        . "window.location='projetosAprovados.php';</script>";
        cadastraDoacao($_POST['projeto'], $_POST['autor'], $_POST['valor'], $_POST['data']);
    } else
        echo "<script>alert('Você não possui esta quantia!');</script>";
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
        v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
        /*v = v.replace(/(\d)(\d{11})$/, "$1$2");//coloca o ponto dos trilhões
         v = v.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos bilhões
         v = v.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhões
         */
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }
</script>

<div class="container">
    <form action="doacao.php?id=<?php echo $_GET['id'] ?>" method="post" name="doacao">
        <div class="form-group">
            <input type="hidden" name="autor" class="form-control" id="autor" value="<?php echo $_SESSION['cpf'] ?>">
        </div>

        <div class="form-group">
            <input type="hidden" name="projeto" class="form-control" id="projeto" value="<?php echo $dadosProjeto['id'] ?>">
        </div>

        <div class="form-group">
            <label for="valor">Valor para Doação:</label>
            <input type="text" name="valor" required class="form-control" id="valor" onkeypress="mascara(this, mmoney);">
        </div>

        <div class="form-group">
            <input type="hidden" name="data" required class="form-control" id="data" 
                   value="<?php
                   date_default_timezone_set('America/Sao_Paulo');
                   $date = date('Y-m-d');
                   echo $date;
                   ?>">  
        </div>

        <button type="submit" name="enviar" class="btn btn-success">Confirmar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>
