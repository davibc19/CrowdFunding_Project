<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP_AV();
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
                        <th>id</th>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Valor</th>
                        <th>Duração (em dias)</th>
                        <?php if ($_SESSION['tipoUsr'] == 'Avaliador de Projetos') echo "<th></th>" ?>
                        <?php if ($_SESSION['tipoUsr'] == 'Gestor de Projetos') echo "<th></th>" ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['tipoUsr'] == 'Avaliador de Projetos')
                        $query = consultaProjetoPorCategoria($_SESSION['cpf']);
                    else
                        $query = consultaProjetoPorAutor($_SESSION['cpf']);

                    while ($dados = mysql_fetch_array(($query)))
                    {
                        if($_SESSION['tipoUsr'] == 'Avaliador de Projetos' && ($dados['status'] != "reprovado" && $dados['status'] != "aprovado") || $_SESSION['tipoUsr'] == 'Gestor de Projetos')
                        {
                            $autorQuery = procuraAutor($dados['autor']);
                            $autor = mysql_fetch_array($autorQuery);
                            echo "<tr>"
                            . "<td> " . $dados['id'] . "</td>"
                            . "<td> " . $dados['titulo'] . "</td>"
                            . "<td> " . $dados['categoria'] . "</td>"
                            . "<td> " . $autor['nome'] . "</td>"
                            . "<td> R$ " . number_format($dados['valorTotal'], 2, ',', '.') . "</td>"
                            . "<td> " . $dados['duracao'] . "</td>";
                            if ($_SESSION['tipoUsr'] == "Avaliador de Projetos" && $dados['status'] == 'candidato')
                                echo "<td style='text-align: center'><a href='avaliarProjetoCandidato.php'>"
                                . "<input type='button' value='Avaliar' class='btn-success' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>";
                            else if ($_SESSION['tipoUsr'] == "Avaliador de Projetos" && $dados['status'] == 'revisar')
                            {
                                echo "<td style='text-align: center'><a href='alterarProjetoAvaliado.php'>"
                                . "<input type='button' value='Iniciar Revisão' class='btn-warning' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>";
                            } 
                            else if($_SESSION['tipoUsr'] == "Gestor de Projetos" && $dados['status'] == 'candidato')
                            {
                                echo "<td style='text-align: center'>"
                                . "<a href='alterarProjetoCandidato.php'>"
                                . "<input type='button' value='Editar' class='btn-warning' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>";
                                echo "<br/><br/>";
                                echo "<a href='excluirProjetoCandidato.php'>"
                                . "<input type='button' value='Excluir' class='btn-danger' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>"
                                . "</td>";
                            }
                            else if($_SESSION['tipoUsr'] == "Gestor de Projetos" && $dados['status'] == 'aprovado')
                            {
                                echo "<td style='text-align: center'>"
                                . "<a href='../projetoAprovado/infoProjetosAprovados.php?id=".$dados['id']."'>"
                                . "<input type='button' value='Ver Detalhes' class='btn-warning')></a>";
                                echo "<br/><br/>";
                                echo "<a href='infoAvaliacao.php'>"
                                . "<input type='button' value='Ver Avaliação' class='btn-primary' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>"
                                . "</td>";
                            }
                            else if($_SESSION['tipoUsr'] == "Gestor de Projetos" && $dados['status'] == 'reprovado')
                            {
                                echo "<td style='text-align: center'>"
                                ."<a href='infoAvaliacao.php'>"
                                . "<input type='button' value='Ver Avaliação' class='btn-primary' onclick=(" . $_SESSION['id'] = $dados['id'] . ")></a>"
                                . "</td>";
                            }
                            else if($_SESSION['tipoUsr'] == "Gestor de Projetos" && $dados['status'] == 'revisar')
                                echo "<td>Aguardando Revisão</td>";
                            echo "</tr>";
                        }
                    }
                    ?>

                    <?php
                    if ($_SESSION['tipoUsr'] == 'Gestor de Projetos')
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