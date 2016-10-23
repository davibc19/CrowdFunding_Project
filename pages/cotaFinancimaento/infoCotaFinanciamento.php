<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<section id="infoCotaFinanciamento" class="container">
    <div class="container">

        <h2 class="sub-header">Cota de Financiamento</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarCotaFinanciamento').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarCotaFinanciamento" class="table table-striped">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Valor Total</th>
                        <th>Cota do Aluno</th>
                        <th>Cota do Professor</th>
                        <th>Cota do Servidor Técnico</th>
                        <th>Valor do Orçamento para Aluno</th>
                        <th>Valor do Orçamento para Professor</th>
                        <th>Valor do Orçamento para Servidor Técnico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = consultaCotaFinanciameno();
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        echo "<tr style='text-align: center'>"
                        . "<td> " . $dados['ano'] . "</td>
                                      <td width='15%'> R$ " . number_format($dados['valTotal'], 2, ',', '.') . "</td>
                                      <td> " . $dados['cotaAluno'] . "</td>
                                      <td> " . $dados['cotaProfessor'] . "</td>
                                      <td> " . $dados['cotaServ'] . "</td>
                                      <td> R$ " . number_format($dados['valTotalAluno'], 2, ',', '.') . "</td>
                                      <td> R$ " . number_format($dados['valTotalProfessor'], 2, ',', '.') . "</td>
                                      <td> R$ " . number_format($dados['valTotalServ'], 2, ',', '.') . "</td>"
                        . "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include("../template/footer.php") ?>