<!DOCTYPE html>
<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<!-- CRIAÇÃO DA TABELA DINÂMICA -->
<script>$(document).ready(function ()
    {
        $('#listarProjetosAprovados').DataTable();
    });
</script>
<!-- FIM DA CRIAÇÃO -->

<div class="container">
    <div class='row'>
        <div align="center">
            <center>
                <div align="center">
                    <h1>Projetos Recentes</h1>
                    <div class='row'>
                        <br>
                        <div align=center>
                            <center>
                                <table class="table table-bordered" border=1 cellpadding=10 cellspacing=0 style='border-collapse: collapse' bordercolor=#F0F0F0 width=90% id="Tabela_ProjAprovado">
                                    <?php
                                    $i = 0;
                                    $query = consultaProjeto("aprovado");
                                    while ($dados = mysql_fetch_array(($query)))
                                    {
                                        $autorQuery = procuraAutor($dados['autor']);
                                        $autor = mysql_fetch_array($autorQuery);
                                        $progress = ceil(($dados['valArrecadado'] / $dados['valorTotal']) * 100);
                                        $progress = substr($progress, 0, 4);

                                        echo ""
                                        . "<tr>"
                                        . "<td align = center width = '50%'>"
                                        . "<div style = 'margin-left:30px;' >"
                                        . "<h3>" . $dados['titulo'] . "</h3>"
                                        . "<small>" . $autor['nome'] . "</small>"
                                        . "<br/><br/>"
                                        . "<img src = '" . $dados['imagem'] . "' class = 'img-thumbnail' height = '200' width = '200'>"
                                        . "<br/><br/>"
                                        . "<label class='lbl'><b>RESUMO</b></label>"
                                        . "<br/>"
                                        . "<div style = 'margin-left: 50px; margin-right: 50px; height: 100; width: 100; text-align: justify;'>"
                                        . $dados['resumo']
                                        . "<br/><br/>"
                                        . " <div class = 'progress'>
                                                            <div class = 'progress-bar' role = 'rogressbar' aria-valuemin = '0' 
                                                            aria-valuemax = '100' style = 'width:" . $progress . "%'>
                                                                " . $progress . "%
                                                            </div>"
                                        . "</div>"
                                        . "</div>"
                                        . "</div>"
                                        . "<br/><br/>"
                                        . "<a href ='infoProjetosAprovados.php?id=" . $dados['id'] . "'>"
                                        . "<input type = 'button' class = 'btn-primary' value = 'Ver Mais'></a>"
                                        . "</td>";
                                        if ($dados = mysql_fetch_array(($query)))
                                        {
                                            $autorQuery = procuraAutor($dados['autor']);
                                            $autor = mysql_fetch_array($autorQuery);
                                            $progress = ($dados['valArrecadado'] / $dados['valorTotal']) * 100;
                                            echo ""
                                            . "<td align = center width = '50%'>"
                                            . "<div style = 'margin-left:30px;' >"
                                            . "<h3>" . $dados['titulo'] . "</h3>"
                                            . "<small>" . $autor['nome'] . "</small>"
                                            . "<br/><br/>"
                                            . "<img src = '" . $dados['imagem'] . "' class = 'img-thumbnail' height = '200' width = '200'>"
                                            . "<br/><br/>"
                                            . "<label class='lbl'><b>RESUMO</b></label>"
                                            . "<br/>"
                                            . "<div style = 'margin-left: 50px; margin-right: 50px; height: 100; width: 100; text-align: justify;'>"
                                            . $dados['resumo']
                                            . "<br/><br/>"
                                            . " <div class = 'progress'>
                                                                <div class = 'progress-bar' role = 'rogressbar' aria-valuemin = '0' 
                                                                aria-valuemax = '100' style = 'width:" . $progress . "%'>
                                                                    " . $progress . "%
                                                                </div>"
                                            . "</div>"
                                            . "</div>"
                                            . "</div>"
                                            . "<br/><br/>"
                                            . "<a href ='infoProjetosAprovados.php?id=" . $dados['id'] . "'>"
                                            . "<input type = 'button' class = 'btn-primary' value = 'Ver Mais'></a>"
                                            . "</td>";
                                        }
                                        echo "</tr>";
                                        $i = $i + 2;
                                    }
                                    ?>
                                    </tr>
                                </table>
                            </center>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <hr/>
    <div class='row'>
        <div align="center">
            <table id="listarProjetosAprovados" class="table table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Valor</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = consultaTodosProjetos("aprovado");

                    while ($dados = mysql_fetch_array(($query)))
                    {
                            $autorQuery = procuraAutor($dados['autor']);
                            $autor = mysql_fetch_array($autorQuery);
                            echo "<tr>"
                                . "<td> " . $dados['titulo'] . "</td>"
                                . "<td> " . $dados['categoria'] . "</td>"
                                . "<td> " . $autor['nome'] . "</td>"
                                . "<td> R$ " . number_format($dados['valorTotal'], 2, ',', '.') . "</td>"
                                . "<td><a href ='infoProjetosAprovados.php?id=" . $dados['id'] . "'><input type = 'button' class = 'btn-primary' value = 'Ver Mais'></a></td>";
                            echo "</tr>";
                        }
                    ?>

                    <?php
                    if (isset($_SESSION['tipoUsr']) && $_SESSION['tipoUsr'] == 'Gestor de Projetos')
                    {
                        $query = consultaProjetoPorAutor("aprovado", $_SESSION['cpf']);
                        while ($dados = mysql_fetch_array(($query)))
                        {
                            $autorQuery = procuraAutor($dados['autor']);
                            $autor = mysql_fetch_array($autorQuery);
                            echo "<tr>"
                            . "<td> " . $dados['id'] . "</td>"
                            . "<td> " . $dados['titulo'] . "</td>"
                            . "<td> " . $dados['categoria'] . "</td>"
                            . "<td> " . $autor['nome'] . "</td>"
                            . "<td> R$ " . number_format($dados['valorTotal'], 2, ',', '.') . "</td>"
                            . "<td> " . $dados['duracao'] . "</td>"
                            . "<td style='text-align: center'><a href='../projetoAprovado/infoProjetosAprovados.php?id=" . $dados['id'] . "'>"
                            . "<input type='button' value='Consultar' class='btn-success'></a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../template/footer.php") ?>