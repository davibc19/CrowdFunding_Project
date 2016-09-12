<?php

require_once './validateSessionFunctions.php';
validateHeader();
?>

<section id="relatorioDoacoes" class="container">
    <div class="container">

        <div class='row'>
            <!-- Título do Projeto -->
            <h2><center>TÍTULO DO PROJETO</center></h2>
            <!-- Nome do Autor -->
            <h4><center>Autor</center></h4>
            <div class='row' align="center">
                <div class="row placeholders">
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="plotFunctions/geradorGrafico.php?id=1" width="500" height="500" class="img-responsive" alt="Grafico de Valores por Tempo">
                    </div>
                    <div class="col-xs-6 col-sm-6 placeholder">
                        <img src="plotFunctions/geradorGraficoPizza.php?id=1" width="500" height="500" class="img-responsive" alt="Grafico de Pizza">
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
                            <tr>
                                <td>1</td>
                                <td>Davi Braga da Cruz</td>
                                <td>Financiador Aluno</td>
                                <td>R$20.000,00</td>
                                <td>22 mar 2016</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Cristopher Pablo Gueroni</td>
                                <td>Financiador Aluno</td>
                                <td>R$30.000,00</td>
                                <td>29 abr 2016</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Adler Diniz de Souza</td>
                                <td>Gerenciador de Projetos</td>
                                <td>R$50.000,00</td>
                                <td>30 jan 2016</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include("footer.php") ?>