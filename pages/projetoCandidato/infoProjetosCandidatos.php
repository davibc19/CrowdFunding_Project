<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP();
?>

<section id="infoProjetosCandidatos" class="container">
    <div class="container">

        <h2 class="sub-header">Projetos</h2>
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
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Valor</th>
                        <th>Duração (em dias)</th>
                        <?php if($_SESSION['tipoUsr'] == 'Avaliador de Projetos') echo "<th></th>" ?>
                        <?php if($_SESSION['tipoUsr'] == 'Gestor de Projetos') echo "<th></th>" ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if($_SESSION['tipoUsr'] == 'Avaliador de Projetos')
                        $query = consultaProjeto("candidato");
                    else
                        $query = consultaProjetoPorAutor("candidato", $_SESSION['cpf']);
                    while ($dados = mysql_fetch_array(($query)))
                    {
                        $autorQuery = procuraAutor($dados['autor']);
                        $autor = mysql_fetch_array($autorQuery);
                        echo "<tr>"
                            . "<td> " . $dados['titulo'] . "</td>"
                            . "<td> " . $autor['nome'] . "</td>"
                            . "<td> R$ " . number_format($dados['valorTotal'], 2, ',', '.') . "</td>"
                            . "<td> " . $dados['duracao'] . "</td>";
                             if($_SESSION['tipoUsr'] == "Avaliador de Projetos") 
                                 echo "<td style='text-align: center'><a href='avaliarProjetoCandidato.php'>"
                                 . "<input type='button' value='Avaliar' class='btn-success' onclick=(".$_SESSION['id'] = $dados['id'].")></a></td>";
                             else
                                 echo "<td>";
                        echo "</tr>";
                    }
                    ?>
                    
                    <?php
                    if($_SESSION['tipoUsr'] == 'Gestor de Projetos')
                    {
                        $query = consultaProjetoPorAutor("aprovado", $_SESSION['cpf']);
                        while ($dados = mysql_fetch_array(($query)))
                        {
                            $autorQuery = procuraAutor($dados['autor']);
                            $autor = mysql_fetch_array($autorQuery);
                            echo "<tr>"
                                . "<td> " . $dados['titulo'] . "</td>"
                                . "<td> " . $autor['nome'] . "</td>"
                                . "<td> R$ " . number_format($dados['valorTotal'], 2, ',', '.') . "</td>"
                                . "<td> " . $dados['duracao'] . "</td>"
                                . "<td style='text-align: center'><a href='../projetoAprovado/infoProjetosAprovados.php?id=".$dados['id']."'>"
                                 . "<input type='button' value='Consultar' class='btn-success'></a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <hr/>
    <?php
    if (strcmp($_SESSION["tipoUsr"], "Gestor de Projetos") == 0)
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
<?php include("../template/footer.php") ?>