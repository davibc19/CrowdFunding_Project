<?php include("header.php");
?>

<section id="infoProjetosAprovados" class="container">
    <div class="container">

        <div class='row'>
            <!-- Título do Projeto -->
            <h2><center>TÍTULO DO PROJETO</center></h2>
            <!-- Nome do Autor -->
            <h4><center>Autor</center></h4>
            <div align="center">
                <center>
                    <div align="center">
                        <div class='row'>
                            <div align=center>
                                <center>
                                    <table class="table table-bordered" border=1 cellpadding=10 cellspacing=0 style='border-collapse: collapse' bordercolor=#F0F0F0 width=90% id="Tabela_InfoProjetosAprovado">
                                        <th align=center width='50%' >
                                        <div style='margin-left:30px;'>
                                            <br/> <br/>
                                            <!-- Nome do Usuário -->
                                            <div style="text-align: center;">
                                                <b>TOTAL DE DOADORES</b>
                                                <br/><br/>
                                            </div>
                                        </div>
                                        </th>
                                        <th align=center width='50%'>
                                        <div style='margin-left:30px;'>
                                            <br/> <br/>
                                            <!-- Quantidade Doada por ele -->
                                            <div style="text-align: center;">
                                                $100.000,00
                                                <br/><br/>
                                            </div>
                                        </div>
                                        </th>
                                        <!-- Esta estrutura estará em LOOP, permitindo com que 
                                             haja repetições para listar todos os usuários -->
                                        <tr>
                                            <td align=center width='50%'>
                                                <div style='margin-left:30px;'>
                                                    <br/> <br/>
                                                    <!-- Nome do Usuário -->
                                                    <div style="text-align: center;">
                                                        USUÁRIO 1
                                                        <br/><br/>
                                                    </div>
                                                </div>
                                            </td>
                                            <td align=center width='50%'>
                                                <div style='margin-left:30px;'>
                                                    <br/> <br/>
                                                    <!-- Quantidade Doada por ele -->
                                                    <div style="text-align: center;">
                                                        $30.000,00
                                                        <br/><br/>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" width="100%" colspan="2">
                                                <br/>
                                                <!-- Chama a página que exibe o gráfico. Será passado, como parâmetro
                                                     o identificador do projeto em questão. -->
                                                <img src="plotFunctions/geradorGrafico.php?id=1">
                                                <br/>
                                            </td>
                                        </tr>
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
<?php include("footer.php") ?>