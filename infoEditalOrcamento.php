<?php

require_once './validateSessionFunctions.php';
validateHeader();
?>

<section id="infoEditalOrcamento" class="container">
    <div class="container">

        <h2 class="sub-header">Editais de Orçamento</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->

            <script>$(document).ready(function ()
                {
                    $('#listarEditalOrcamento').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarEditalOrcamento" class="table table-striped">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2014</td>
                        <td>R$20.000,00</td>
                    </tr>
                    <tr>
                        <td>2015</td>
                        <td>R$30.000,00</td>
                    </tr>
                    <tr>
                        <td>2016</td>
                        <td>R$50.000,00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <hr/>
    <?php if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "1") == 0))
    {
    echo " 
        <br/><br/>
        <div style='text-align: center; border-top-width: 100px'>
            <div style='margin-left:30px;'>
                <!-- Caso exista, o sistema de recompensas será demonstrado aqui -->
                <label class='lbl'><b>CADASTRAR NOVO EDITAL</b></label>
                <br/><br/>
                <a href='cadastrarEditalOrcamento.php'>Cadastrar Novo Edital de Orçamento</a>
            </div>
        </div>
    ";
    }
    ?>

</section>
<?php include("footer.php") ?>