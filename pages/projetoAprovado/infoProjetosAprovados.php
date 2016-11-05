<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<!-- CRIAÇÃO DA TABELA DINÂMICA -->
<script>$(document).ready(function ()
    {
        $('#listarCriterios').DataTable();
    });
</script>
<!-- FIM DA CRIAÇÃO -->

<section id="infoProjetosAprovados" class="container">
    <div class="container">

        <div class='row'>
            <!-- Título do Projeto -->
            <?php
            $query = consultaProjetoPorId($_GET['id']);
            $dados = mysql_fetch_array($query);
            $autorQuery = procuraAutor($dados['autor']);
            $autor = mysql_fetch_array($autorQuery);
            echo "<h2><center>" . $dados['titulo'] . "</center></h2>"
            . "<h4><center>" . $autor['nome'] . "</center></h4>"
            ?>
            <div align="center">
                <center>
                    <div align="center">
                        <div class='row'>
                            <div align=center>
                                <center>
                                    <table class="table" border=0 cellpadding=0q cellspacing=0 style='border-collapse: collapse' bordercolor=#F0F0F0 width=100% id="Tabela_InfoProjetosAprovado">
                                        <?php
                                        $query = consultaProjetoPorId($_GET['id']);
                                        if ($dados = mysql_fetch_array(($query)))
                                        {
                                            $progress = ceil(($dados['valArrecadado'] / $dados['valorTotal']) * 100);
                                            $progress = substr($progress, 0, 4);
                                            $queryConsulta = consultaQtdApoiadores($dados['id']);
                                            $pessoasApoio = mysql_result($queryConsulta, 0);

                                            $start = strtotime($dados['dataInicio']);
                                            $end = strtotime($dados['dataFim']);
                                            $days_between = ceil(abs($end - $start) / 86400);

                                            echo ""
                                            . "<tr>"
                                            . "<td align = center width = '15%'>"
                                            . "<div style = 'text-align: center; border-top-width: 100px'>"
                                            . "<img src = '" . $dados['imagem'] . "' class = 'img-thumbnail' height = '200' width = '200'>"
                                            . "<br/><br/>"
                                            . " <div class = 'progress'>
                                                                    <div class = 'progress-bar' role = 'rogressbar' aria-valuemin = '0' 
                                                                         aria-valuemax = '100' style = 'width:" . $progress . "%'>
                                                                         " . $progress . "%
                                                                    </div>"
                                            . "</div>"
                                            . "<big><b>R$ " . number_format($dados['valArrecadado'], 2, ',', '.') . "</big></b>"
                                            . "<br/>"
                                            . "<small>Apoiado por <b>" . $pessoasApoio . " pessoas</b></small>"
                                            . "<br/><br/>"
                                            . "Dias Restantes:"
                                            . "<br> " . $days_between . ""
                                            . "<br> <br>"
                                            . "Meta R$ " . number_format($dados['valorTotal'], 2, ',', '.') . ""
                                            . "<br> <br>"
                                            . "<a href = ../doacao/doacao.php?id=" . $_GET['id'] . "><input type = 'button' class = 'btn btn-primary' value = 'Apoiar Este Projeto'></input></a>"
                                            . "</div>"
                                            . "</td>"
                                            . "<td align = center width = '75%'>"
                                            . "<div style = 'margin-left:30px;'>"
                                            . "<br/><br/>"
                                            . "<label class = 'lbl'><b>DESCRIÇÃO</b></label>"
                                            . "<br/>"
                                            . "<div style = 'text-align: justify;'>" . $dados['descricao'] . "</div>"
                                            . "<br/><br/>"
                                            . "<label class = 'lbl'><b>REPASSE FINANCEIRO</b></label>"
                                            . "<br/>"
                                            . "<div class='table-responsive'>";
                                            ?>
                                            <table id = "listarCriterios" class="table table-striped">
                                                <thead>
                                                    <tr style="text-align: center">
                                                        <th>Repasse</th>
                                                        <th>Valor</th>
                                                        <th>Status</th>
                                                        <th>Data</th>
                                                        <?php 
                                                            if(isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Gestor de Projetos") == 0) && (strcmp($_SESSION['cpf'], $dados['autor'])) == 0)
                                                                echo "<th>Ações</th>";
                                                        ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Aqui entra um LOOP para inserir os valores de repasse financeiro
                                                    $queryRepasse = consultaRepassePorIdProjeto($_GET['id']);
                                                    while ($dadosRepasse = mysql_fetch_array(($queryRepasse)))
                                                    {
                                                        echo "<tr style='text-align: center'>"
                                                            . "<td> " . $dadosRepasse['necessidade'] . "</td>"
                                                            . "<td>R$ " . number_format($dadosRepasse['valor'], 2, ',', '.') . "</td>"
                                                            . "<td>" . $dadosRepasse['status'] . "</td>"
                                                            . "<td>" . $dadosRepasse['date']. "</td>";
                                                            if(isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Gestor de Projetos") == 0) && (strcmp($_SESSION['cpf'], $dados['autor'])) == 0)
                                                                echo "<td><a href='../repasseFinanceiro/alterarRepasse.php?id=" . $dadosRepasse['id'] . "&idProjeto=".$dadosRepasse['idProjeto']."'><input type='button' class='btn-warning' value ='Alterar'></input></a></td>";   
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <?php
                                            $query = consultaProjetoPorId($_GET['id']);
                                            $dados = mysql_fetch_array($query);
                                            if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Gestor de Projetos") == 0) && (strcmp($_SESSION['cpf'], $dados['autor'])) == 0)
                                            {
                                                echo " 
                                                    <tr>
                                                        <td align=center width='50%' colspan='2'>
                                                            <div style='text-align: center; border-top-width: 100px'>
                                                                <div style='margin-left:30px;'>
                                                                    <label class='lbl'><h3>Painel Administrativo</h3></label>
                                                                    <br/>
                                                                    <a href='relatorioDoacoes.php?id=" . $_GET['id'] . "'><input type='button' class='btn-success' value ='Exibir Relatório'></input></a>
                                                                </div>
                                                            </div>
                                                            <br/>
                                                            <div style='text-align: center; border-top-width: 100px'>
                                                                <div style='margin-left:30px;'>
                                                                    <a href='../repasseFinanceiro/cadastrarRepasse.php?id=" . $_GET['id'] . "'><input type='button' class='btn-success' value ='Cadastrar Repasse Financeiro'></input></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ";
                                            }
                                }
                                            ?>
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <?php include("../template/footer.php") ?>