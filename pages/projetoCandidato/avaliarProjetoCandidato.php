<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();

if (isset($_POST['enviar']))
{
    if ((int) $_POST['notaFinal'] < 1 || (int) $_POST['notaFinal'] > 10)
        echo"<script>alert('Valor inválido para a Nota!!');</script>";

    $criterios = "";    
    foreach ($_POST['criterio'] as $check)
    {
        $criterios = $criterios . ", ". $check;
    }

    if (isset($_POST['criterio']))
    {
        avaliarProjetoCandidato($_SESSION['id'], $_SESSION['cpf'], $criterios, $_POST['notaFinal'], $_POST['descricao']);
    } else
        echo "<script>alert('Você deve selecionar ao menos um critério!');</script>";
}
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
    <form action="avaliarProjetoCandidato.php" method="post" name="avaliarProjetoCandidato">
        <div class='form-group'>
            <center>
                <label for="criterios">Criterios</label>
                <table>
                    <?php
                    $projeto = mysql_fetch_array(consultaProjetoPorId($_SESSION['id']));
                    $query = consultaCriterioPorCategoria($projeto['categoria']);
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        ?>
                        <tr>
                            <td>
                                <input type='checkbox' class='form-control' id='criterio' name='criterio[]' value='<?php echo $dados['criterio'] ?>'>
                            </td>
                            <td> 
                                &nbsp;<?php echo $dados['criterio'] ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?> 
                </table>
            </center>
            <br/>

            <div class='form-group'>
                <label for='notaFinal'>Nota Final</label>
                <input type="text" name="notaFinal" required class="form-control" id="notaFinal" onkeypress="mascara(this, mnumber);">
            </div>
            <div class='form-group'>
                <textarea  name='descricao' required class='form-control' rows='6' id='descricao'></textarea>
            </div>
            <button type="submit" name="enviar" value="avaliar" class="btn btn-success">Avaliar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>
