<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<section id="infoEditalOrcamento" class="container">
    <div class="container">

        <h2 class="sub-header">Editais de Orçamento</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarEditalOrcamento').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarEditalOrcamento" class="table table-striped">
                <thead>
                    <tr>
                        <th>Data de Publicação</th>
                        <th>Nome</th>
                        <th>Valor Total</th>
                        <?php if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Avaliador de Projetos") == 0))
                                echo "<th>Ação</th>";?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = consultaEditalOrcamento();
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        echo "<tr>"
                        . "<td> " . $dados['dataPublicacao'] . "</td>"
                        . "<td> " . $dados['nome'] . "</td>
                                       <td> R$ " . number_format($dados['valTotal'], 2, ',', '.') . "</td>";
                        if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Avaliador de Projetos") == 0))
                                echo "<td><a href='../editalCota/alterarEditalCota.php?id=".$dados['id']."'><input type='button' class='btn-warning' value='Alterar Edital de Orçamento'></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <?php
    if (isset($_SESSION["tipoUsr"]) && (strcmp($_SESSION["tipoUsr"], "Avaliador de Projetos") == 0))
    {
        echo " 
        <br/><br/>
        <div style='text-align: center; border-top-width: 100px'>
            <div style='margin-left:30px;'>
                <!-- Caso exista, o sistema de recompensas será demonstrado aqui -->
                <a href='../editalCota/cadastrarEditalCota.php'><input type='button' class='btn-primary' value='Cadastrar Novo Edital de Orçamento'></a>
            </div>
        </div>
    ";
    }
    ?>

</section>
<?php include("../template/footer.php") ?>