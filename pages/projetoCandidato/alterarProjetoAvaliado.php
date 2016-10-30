<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();

if (isset($_POST['enviar']))
{
    if ((int) $_POST['notaFinal'] < 1 || (int) $_POST['notaFinal'] > 10)
        echo"<script>alert('Valor inválido para a Nota!!');</script>";


    if (isset($_POST['criterio']))
    {
        revisarProjetoCandidato($_SESSION['id'], $_POST['notaFinal'], $_POST['descricao']);
    } else
        echo "<script>alert('Você deve selecionar ao menos um critério!');</script>";
}

$query = consultaAvaliacaoPorId($_SESSION['id']);
$dadosAvaliacao = mysql_fetch_array($query);
$query = consultaProjetoPorId($_SESSION['id']);
$dadosProjeto = mysql_fetch_array($query);
?>

<div class="container">
    <form action="alterarProjetoAvaliado.php" method="post" name="alterarProjetoAvaliado">
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
            <input type="text" name="notaFinal" class="form-control" id="notaFinal" value="<?php echo $dadosAvaliacao['notaFinal'] ?>">
        </div>
        <div class='form-group'>
            <label for="titulo">Avaliação:</label>
            <textarea  name='descricao' class='form-control' rows='6' id='descricao'><?php echo $dadosAvaliacao['descricao']?></textarea>
        </div>
            <button type="submit" name="enviar" class="btn btn-success">Confirmar Revisão</button>
    </form>
</div>

<?php include("../template/footer.php") ?>