<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
?>

<section id="infoProjetosCandidatos" class="container">
    <div class="container">

        <h2 class="sub-header">Usuários</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarUsuarios').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarUsuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo de Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = consultaUsuario();
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        echo "<tr>"
                            . "<td> " . $dados['nome'] . "</td>"
                            . "<td> " . $dados['tipo'] . "</td>"
                            . "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
</section>
<?php include("../template/footer.php") ?>