<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateAV();
?>

<section id="infoCriterios" class="container">
    <div class="container">

        <h2 class="sub-header">Critérios</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarCriterios').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarCriterios" class="table table-striped">
                <thead>
                    <tr style="text-align: center">
                        <th>Categoria</th>
                        <th>Critério de Avaliação</th>
                        <th>Descrição</th>
                        <th>Peso</th>
                        <th>Alteração</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = consultaCriterios();
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        echo "<tr style='text-align: center'>"
                        . "<td> " . $dados['categoria'] . "</td>
                            <td> " . $dados['criterio'] . "</td>
                            <td> " . $dados['descricao'] . "</td>
                            <td> " . $dados['peso'] . "</td>
                            <td>
                                <center>
                                    <a href ='alterarCriterio.php?id=" . $dados['id'] . "'>
                                        <input type = 'button' class = 'btn-warning' value = 'Alterar'/>
                                    </a>
                                </center>
                            </td>";
                            if(strcmp($dados['status'], "ativado") == 0)
                                echo " <td><a href ='alterarStatusCriterio.php?id=" . $dados['id'] . "&op=desativar'>
                                    <input type = 'button' class = 'btn-danger' value = 'Desativar'/>
                                </a></td>";
                            else if(strcmp($dados['status'], "desativado") == 0)
                                echo "<td><a href ='alterarStatusCriterio.php?id=" . $dados['id'] . "&op=ativar'>
                                    <input type = 'button' class = 'btn-success' value = 'Ativar'/>
                                </a></td>";
                            "</center>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    echo " 
        <br/><br/>
        <div style='text-align: center; border-top-width: 100px'>
            <div style='margin-left:30px;'>
                <a href='cadastrarCriterio.php'><input type='button' class='btn-primary' value='Cadastrar Novo Criterio'></a>
            </div>
        </div>
    ";
    ?>
</section>
<?php include("../template/footer.php") ?>