<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateDonation();

$queryDoacao = procuraDoacaoPorCPF($_SESSION['cpf']);

?>

<section id="infoEditalOrcamento" class="container">
    <div class="container">

        <h2 class="sub-header">Doações Realizadas</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarDoacoes').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarDoacoes" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome do Projeto</th>
                        <th>Data</th>
                        <th>Valor da Doação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($dadosDoacao = mysql_fetch_array($queryDoacao))
                    {
                        $queryProjeto = consultaProjetoPorId($dadosDoacao['idDoacao']);
                        $dadosProjeto = mysql_fetch_array($queryProjeto);
                        echo "<tr>"
                            . "<td> <a href='../projetoAprovado/infoProjetosAprovados.php?id=".$dadosProjeto['id']."'>" . $dadosProjeto['titulo'] . "</a></td>"
                            . "<td> " . $dadosDoacao['data'] . "</td>
                            <td> R$ " . number_format($dadosDoacao['valor'], 2, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
</section>

<?php include("../template/footer.php") ?>
