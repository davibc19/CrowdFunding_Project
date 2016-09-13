<?php

require_once './validateSessionFunctions.php';
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
                        <th>Cota do Aluno (%)</th>
                        <th>Cota do Professor (%)</th>
                        <th>Cota do Servidor Técnico (%)</th>
                        <th>Valor do Orçamento para Aluno</th>
                        <th>Valor do Orçamento para Professor</th>
                        <th>Valor do Orçamento para Servidor Técnico</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2014</td>
                        <td>R$20.000,00</td>
                        <td>20%</td>
                        <td>50%</td>
                        <td>30%</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                    </tr>
                    <tr>
                        <td>2015</td>
                        <td>R$30.000,00</td>
                        <td>30%</td>
                        <td>60%</td>
                        <td>10%</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                    </tr>
                    <tr>
                        <td>2016</td>
                        <td>R$50.000,00</td>
                        <td>5%</td>
                        <td>35%</td>
                        <td>60%</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                        <td>R$20.000,00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include("footer.php") ?>