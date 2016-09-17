<?php
require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();

if (isset($_POST['enviar']))
{
    avaliarProjetoCandidato($_SESSION['id'], $_POST['enviar'], $_POST['descricao'], $_POST['criterio1'], $_POST['criterio2'], $_POST['criterio3']);
}
?>

<script>
    function mostraDiv(valor)
    {
        if (valor == "2") {
            document.getElementById("criterio2").style.display = "block";
            document.getElementById("criterio3").style.display = "none";
        } else if (valor == "3") {
            document.getElementById("criterio2").style.display = "block";
            document.getElementById("criterio3").style.display = "block";
        }
        else if (valor == "1")
        {
            document.getElementById("criterio2").style.display = "none";
            document.getElementById("criterio3").style.display = "none";
        }
    }
</script>

<style type="text/css">
    #criterio2, #criterio3
    {
        display:none;
    }
</style>

<div class="container">
    <form action="avaliarProjetoCandidato.php" method="post" name="avaliarProjetoCandidato">

        <br/>
        <div class='form-group'>
            <br/>
            <label for="qtdCriterio">Selecione a quantidade de criterios: </label>
            <select class='selectpicker' id='qtdCriterio' name='qtdCriterio' onchange='mostraDiv(this.value)'>
                <option selected value='1'>Um</option>
                <option value='2'>Dois</option>
                <option value='3'>Três</option>
            </select>
            <br/><br/>
            <center>
                <label for="criterios">Criterios</label>
                <table border='1 '>
                    <tr>
                        <td>
                            <!-- Criterio 1 -->
                            <select class='selectpicker' required id='criterio1' name='criterio1'>
                                <?php
                                $query = consultaCriterios();
                                while ($dados = mysql_fetch_array(($query)))
                                {
                                    echo "<option value='" . $dados['id'] . "'> " . $dados['criterio'] . "</option>";
                                }
                                echo "</select>";
                                ?> 
                        </td>
                        <td>
                            <!-- Criterio 2 -->
                            <select class='selectpicker' id='criterio2' name='criterio2'>
                                <option value='nenhum' selected>Nenhum</option>
                                <?php
                                $query = consultaCriterios();
                                while ($dados = mysql_fetch_array(($query)))
                                {
                                    echo "<option value='" . $dados['id'] . "'> " . $dados['criterio'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                        </td>
                        <td>
                            <!-- Criterio 3 -->
                            <select class='selectpicker' id='criterio3' name='criterio3'>
                                <option value='nenhum' selected>Nenhum</option>
                                <?php
                                $query = consultaCriterios();
                                while ($dados = mysql_fetch_array(($query)))
                                {
                                    echo "<option value='" . $dados['id'] . "'> " . $dados['criterio'] . "</option>";
                                }
                                echo "</select>";
                                ?>
                        </td>
                    </tr>
                </table>
            </center>
            <?php echo "<br/><div class='form-group'>
                    <textarea  name='descricao' required class='form-control' rows='6' id='descricao'></textarea>
                    <br/><br/>";
            ?>
            <button type="submit" name="enviar" value="aprovado" class="btn btn-success">Aprovar</button>
            <button type="submit" name="enviar" value="reprovado" class="btn btn-danger">Reprovar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
