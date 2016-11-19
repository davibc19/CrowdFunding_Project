<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP();

$totalPesquisa = 0;
$totalCompeticao = 0;
$totalInovacao = 0;
$totalManutencao = 0;
$totalPequenasObras = 0;
$total = 0;

$queryProjeto = consultaTodosProjetos("aprovado");
while ($dadosProjeto = mysql_fetch_array($queryProjeto))
{
    if($dadosProjeto['categoria'] == "Pesquisa")
        $totalPesquisa += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Competição Tecnológica")
        $totalCompeticao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Inovação no Ensino")
        $totalInovacao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Manutenção e Reforma")
        $totalManutencao += $dadosProjeto['valArrecadado'];
    else if($dadosProjeto['categoria'] == "Pequenas Obras")
        $totalPequenasObras += $dadosProjeto['valArrecadado'];
    
    $total += $dadosProjeto['valArrecadado'];
}
?>

<section id="relatorioProjetos" class="container">
    <div class="container">
        <div class='row'>
            <!-- Título do Projeto -->
            <h2><center>Relatório de Projetos por Categoria</center></h2>
            <div class='row' align="center">
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="../../functions/plotFunctions/geradorGrafico2.php" width="500" height="500" class="img-responsive" alt="Grafico de Valores por Tempo">
                    </div>
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="../../functions/plotFunctions/geradorGraficoPizza2.php" width="500" height="500" class="img-responsive" alt="Grafico de Pizza">
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- CRIAÇÃO DA TABELA DINÂMICA -->
                    <script>$(document).ready(function ()
                        {
                            $('#Pesquisa').DataTable();
                            $('#Competicao').DataTable();
                            $('#Inovacao').DataTable();
                            $('#Manutencao').DataTable();
                            $('#PequenasObras').DataTable();
                        });
                    </script>
                    <!-- FIM DA CRIAÇÃO -->
                    
                    <!-- PESQUISA -->
                    <label class='lbl'><h3>Pesquisa</h3></label>
                    <table id="Pesquisa" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título do Projeto</th>
                                <th>Valor Investido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryProjeto = consultaProjetosPorCategoria("pesquisa");
                            while ($dadosProjeto = mysql_fetch_array($queryProjeto))
                            {
                                    echo ""
                                    . "<tr>"
                                        . "<td>" . $dadosProjeto['titulo'] . "</td>"
                                        . "<td> R$ " . number_format($dadosProjeto['valArrecadado'], 2, ',', '.') . "</td>"
                            . "</tr>";
                            }
                                echo "<th>TOTAL</th>"
                                . "<td> R$ " . number_format($totalPesquisa, 2, ',', '.') . "</td>";
                            ?>
                        </tbody>
                    </table>
                    
                    <!-- COMPETIÇÃO TECNOLÓGICA -->
                    <label class='lbl'><h3>Competição Tecnológica</h3></label>
                    <table id="Competicao" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título do Projeto</th>
                                <th>Valor Investido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryProjeto = consultaProjetosPorCategoria("Competição Tecnológica");
                            while ($dadosProjeto = mysql_fetch_array($queryProjeto))
                            {
                                    echo ""
                                    . "<tr>"
                                        . "<td>" . $dadosProjeto['titulo'] . "</td>"
                                        . "<td> R$ " . number_format($dadosProjeto['valArrecadado'], 2, ',', '.') . "</td>"
                            . "</tr>";
                            }
                                echo "<th>TOTAL</th>"
                                . "<td> R$ " . number_format($totalCompeticao, 2, ',', '.') . "</td>";
                            ?>
                        </tbody>
                    </table>
                    
                    <!-- INOVAÇÃO NO ENSINO -->
                    <label class='lbl'><h3>Inovação no Ensino</h3></label>
                    <table id="Inovacao" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título do Projeto</th>
                                <th>Valor Investido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryProjeto = consultaProjetosPorCategoria("Inovação No Ensino");
                            while ($dadosProjeto = mysql_fetch_array($queryProjeto))
                            {
                                    echo ""
                                    . "<tr>"
                                        . "<td>" . $dadosProjeto['titulo'] . "</td>"
                                        . "<td> R$ " . number_format($dadosProjeto['valArrecadado'], 2, ',', '.') . "</td>"
                            . "</tr>";
                            }
                                echo "<th>TOTAL</th>"
                                . "<td> R$ " . number_format($totalInovacao, 2, ',', '.') . "</td>";
                            ?>
                        </tbody>
                    </table>
                    
                    <!-- MANUTENÇÃO E REFORMAS -->
                    <label class='lbl'><h3>Manutenção e Reformas</h3></label>
                    <table id="Manutencao" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título do Projeto</th>
                                <th>Valor Investido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryProjeto = consultaProjetosPorCategoria("Inovação No Ensino");
                            while ($dadosProjeto = mysql_fetch_array($queryProjeto))
                            {
                                    echo ""
                                    . "<tr>"
                                        . "<td>" . $dadosProjeto['titulo'] . "</td>"
                                        . "<td> R$ " . number_format($dadosProjeto['valArrecadado'], 2, ',', '.') . "</td>"
                            . "</tr>";
                            }
                                echo "<th>TOTAL</th>"
                                . "<td> R$ " . number_format($totalManutencao, 2, ',', '.') . "</td>";
                            ?>
                        </tbody>
                    </table>
                    
                    <!-- PEQUENAS OBRAS -->
                    <label class='lbl'><h3>Pequenas Obras</h3></label>
                    <table id="PequenasObras" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título do Projeto</th>
                                <th>Valor Investido</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryProjeto = consultaProjetosPorCategoria("Inovação No Ensino");
                            while ($dadosProjeto = mysql_fetch_array($queryProjeto))
                            {
                                    echo ""
                                    . "<tr>"
                                        . "<td>" . $dadosProjeto['titulo'] . "</td>"
                                        . "<td> R$ " . number_format($dadosProjeto['valArrecadado'], 2, ',', '.') . "</td>"
                            . "</tr>";
                            }
                                echo "<th>TOTAL</th>"
                                . "<td> R$ " . number_format($totalPequenasObras, 2, ',', '.') . "</td>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("../template/footer.php") ?>