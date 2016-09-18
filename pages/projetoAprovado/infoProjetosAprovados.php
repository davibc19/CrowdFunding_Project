<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<section id="infoProjetosAprovados" class="container">
    <div class="container">

        <div class='row'>
            <!-- Título do Projeto -->
            <?php 
                $query = consultaProjetoPorId($_GET['id']);
                $dados = mysql_fetch_array($query);
                $autorQuery = procuraAutor($dados['autor']);
                $autor = mysql_fetch_array($autorQuery);
                echo "<h2><center>".$dados['titulo']."</center></h2>"
                   . "<h4><center>".$autor['nome']."</center></h4>"
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
                                                            . "<img src = '".$dados['imagem']."' class = 'img-thumbnail' height = '200' width = '200'>"
                                                            . "<br/><br/>"
                                                            . " <div class = 'progress'>
                                                                    <div class = 'progress-bar' role = 'rogressbar' aria-valuemin = '0' 
                                                                         aria-valuemax = '100' style = 'width:" . $progress . "%'>
                                                                         " . $progress . "%
                                                                    </div>"
                                                            . "</div>"
                                                        . "<big><b>R$ ".number_format($dados['valArrecadado'], 2, ',', '.')."</big></b>"
                                                        . "<br/>"
                                                        . "<small>Apoiado por <b>".$pessoasApoio." pessoas</b></small>"
                                                        . "<br/><br/>"
                                                        . "Dias Restantes:"
                                                        ."<br> ".$days_between.""
                                                        ."<br> <br>"
                                                        ."Meta R$ ".number_format($dados['valorTotal'], 2, ',', '.').""
                                                        ."<br> <br>"
                                                        . "<a href = doacao.php?id=".$_GET['id']."><input type = 'button' class = 'btn btn-primary' value = 'Apoiar Este Projeto'></input></a>"
                                                    . "</div>"
                                                . "</td>"
                                                . "<td align = center width = '75%'>"
                                                    . "<div style = 'margin-left:30px;'>"
                                                        . "<br/><br/>"
                                                        . "<label class = 'lbl'><b>DESCRIÇÃO</b></label>"
                                                        . "<br/>"
                                                        . "<div style = 'text-align: justify;'>".$dados['descricao']."</div>"
                                                            . "<br/><br/>";
                                                            if($dados['interValores'] != null)
                                                            {
                                                                echo "<label class = 'lbl'><b>VALORES PARA DOAÇÃO</b></label>"
                                                                . "<br/>"
                                                                . $dados['interValores'].""
                                                                . " <br/><br/>";
                                                            }
                                                        echo "</div>"
                                                    ."</div>"
                                                . "</td>"
                                            . "</tr>";
                                        }
                                        ?>
                                                   
                                        <?php
                                        $query = consultaProjetoPorId($_GET['id']);
                                        $dados = mysql_fetch_array($query);
                                        if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "gestorProjeto") == 0)
                                                && (strcmp($_SESSION['cpf'], $dados['autor'])) ==0 )
                                        {
                                            echo " 
                                                    <tr>
                                                        <td align=center width='70%' colspan='2'>
                                                            <div style='text-align: center; border-top-width: 100px'>
                                                                <div style='margin-left:30px;'>
                                                                    <!-- Caso exista, o sistema de recompensas será demonstrado aqui -->
                                                                    <label class='lbl'><b>RELATÓRIO</b></label>
                                                                    <br>
                                                                    <a href='relatorioDoacoes.php?id=".$_GET['id']."'><input type='button' class='btn-success' value ='Exibir Relatório'></input></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                ";
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