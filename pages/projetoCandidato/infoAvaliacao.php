<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP();

if (isset($_POST['enviar']))
{
    requisitarRevisao($_SESSION['id']);
}

$query = consultaAvaliacaoPorId($_SESSION['id']);
$dadosAvaliacao = mysql_fetch_array($query);
$query = consultaProjetoPorId($_SESSION['id']);
$dadosProjeto = mysql_fetch_array($query);
?>

<div class="container">
    <form action="infoAvaliacao.php" method="post" name="visualizarAvaliacao">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" readonly name="titulo" class="form-control" id="titulo" value="<?php echo $dadosProjeto['titulo'] ?>">
        </div>
        <div class="form-group">
            <label for="titulo">Critérios:</label>
            <input type="text" readonly name="criterio" class="form-control" id="criterio" value="<?php echo $dadosAvaliacao['criterios'] ?>">
        </div>
        <div class="form-group">
            <label for="titulo">Nota Final:</label>
            <input type="text" readonly name="notaFinal" class="form-control" id="notaFinal" value="<?php echo $dadosAvaliacao['notaFinal'] ?>">
        </div>
        <div class='form-group'>
            <label for="titulo">Avaliação:</label>
            <textarea  name='descricao' readonly class='form-control' rows='6' id='descricao'><?php echo $dadosAvaliacao['descricao']?></textarea>
        </div>

        <?php if($dadosProjeto['status'] == 'reprovado'){ ?>
            <button type="submit" name="enviar" class="btn btn-success">Requisitar Revisão</button>
        <?php } ?>
    </form>
</div>

<?php include("../template/footer.php") ?>