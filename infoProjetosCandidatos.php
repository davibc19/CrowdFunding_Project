<?php
require_once './validateSessionFunctions.php';
validateHeader();
validateGP_AV();
?>

<section id="infoProjetosCandidatos" class="container">
    <div class="container">

        <h2 class="sub-header">Projetos Candidatos</h2>
        <div class="table-responsive">

            <!-- CRIAÇÃO DA TABELA DINÂMICA -->
            <script>$(document).ready(function ()
                {
                    $('#listarProjetosCandidatos').DataTable();
                });
            </script>
            <!-- FIM DA CRIAÇÃO -->

            <table id="listarProjetosCandidatos" class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Valor</th>
                        <th>Duração (em dias)</th>
                        <?php if($_SESSION['tipoUsr'] == 2) echo "<th></th>" ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- LISTAR APENAS PROJETOS DO PRÓPRIO USUÁRIO (pega da sessão para fazer pesquisa no BD) -->
                        <td>Integral</td>
                        <td>Titulo 1</td>
                        <td>Autor 1</td>
                        <td>R$ 20.000,00</td>
                        <td>50 dias</td>
                        <?php if($_SESSION['tipoUsr'] == "avaliadorPR") echo "<td style='text-align: center'><a href='avaliarProjetoCandidato.php'><input type='button' value='Avaliar' class='btn-success'></a></td>";?>
                    </tr>
                    <tr>
                        <td>Modular</td>
                        <td>Titulo 2</td>
                        <td>Autor 2</td>
                        <td>R$ 30.000,00</td>
                        <td>70 dias</td>
                        <?php if($_SESSION['tipoUsr'] == "avaliadorPR") echo "<td style='text-align: center'><a href='avaliarProjetoCandidato.php'><input type='button' value='Avaliar' class='btn-success'></a></td>";?>
                    </tr>
                    <tr>
                        <td>Integral</td>
                        <td>Titulo 3</td>
                        <td>Autor 3</td>
                        <td>R$ 60.000,00</td>
                        <td>100 dias</td>
                        <?php if($_SESSION['tipoUsr'] == "avaliadorPR") echo "<td style='text-align: center'><a href='avaliarProjetoCandidato.php'><input type='button' value='Avaliar' class='btn-success'></a></td>";?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <?php
    if (strcmp($_SESSION["tipoUsr"], "gestorProjeto") == 0)
    {
        echo " 
        <br/><br/>
        <div style='text-align: center; border-top-width: 100px'>
            <div style='margin-left:30px;'>
                <!-- Caso exista, o sistema de recompensas será demonstrado aqui -->
                <a href='cadastrarProjetoCandidato.php'><input type='button' class='btn-primary' value='Cadastrar Novo Projeto Candidato'></a>
            </div>
        </div>
    ";
    }
    ?>

</section>
<?php include("footer.php") ?>