<?php
require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();
validateGP_AV();

$queryAutor = procuraAutor($_SESSION['cpf']);
$dadosAutor = mysql_fetch_array($queryAutor);
$queryProjeto = consultaProjetoPorId($_GET['id']);
$dadosProjeto = mysql_fetch_array($queryProjeto);

if (($dadosProjeto['autor'] != $_SESSION['cpf']))
{
    echo "<script>alert('Você não pode visualizar este relatório!');"
    . "window.location='projetosAprovados.php';</script>";
}
?>

<section id="relatorioDoacoes" class="container">
    <div class="container">

        <div class='row'>
            <!-- Título do Projeto -->
            <h2><center><?php echo $dadosProjeto['titulo'] ?></center></h2>
            <!-- Nome do Autor -->
            <h4><center><?php echo $dadosAutor['nome'] ?></center></h4>
            <div class='row' align="center">
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="plotFunctions/geradorGrafico.php?id=<?php echo $_GET['id']?>" width="500" height="500" class="img-responsive" alt="Grafico de Valores por Tempo">
                    </div>
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="plotFunctions/geradorGraficoPizza.php?id=<?php echo $_GET['id']?>" width="500" height="500" class="img-responsive" alt="Grafico de Pizza">
                    </div>
                </div>
                <h2 class="sub-header">Usuários Doadores</h2>
                <div class="table-responsive">

                    <!-- CRIAÇÃO DA TABELA DINÂMICA -->

                    <script>$(document).ready(function ()
                        {
                            $('#relatorioProjeto').DataTable();
                        });
                    </script>
                    <!-- FIM DA CRIAÇÃO -->

                    <table id="relatorioProjeto" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do Usuário</th>
                                <th>Tipo do Usuário</th>
                                <th>Valor Doado</th>
                                <th>Data de Doação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryDoacoes = consultaDoacaoPorIdProjeto($dadosProjeto['id']);
                            while ($dadosDoacoes = mysql_fetch_array($queryDoacoes))
                            {
                                $queryAutorDoacao = procuraAutor($dadosDoacoes['idUsr']);
                                $dadosAutorDoacao = mysql_fetch_array($queryAutorDoacao);
                                echo""
                                . "<tr>"
                                    . "<td>" . $dadosDoacoes['idDoacao'] . "</td>"
                                    . "<td>" . $dadosAutorDoacao['nome'] . "</td>"
                                    . "<td>" . traduzTipoAutor($dadosAutorDoacao['tipo']) . "</td>"
                                    . "<td> R$ " . number_format($dadosDoacoes['valor'], 2, ',', '.') . "</td>"
                                    . "<td>" . $dadosDoacoes['data'] . "</td>"
                                . "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php") ?>