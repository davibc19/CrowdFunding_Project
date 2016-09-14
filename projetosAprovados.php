<!DOCTYPE html>
<?php 
    require_once './validateSessionFunctions.php';
    validateHeader();
?>

<div class="container">
    <div class='row'>
        <div align="center">
            <center>
                <div align="center">
                    <h1>Projetos Atuais</h1>
                    <div class='row'>
                        <br>
                        <div align=center>
                            <center>
                                <table class="table table-bordered" border=1 cellpadding=10 cellspacing=0 style='border-collapse: collapse' bordercolor=#F0F0F0 width=90% id="Tabela_ProjAprovado">
                                    <tr>
                                        <td align=center width='50%'>
                                            <div style='margin-left:30px;'>
                                                <!-- Nome do Projeto -->
                                                <h3>Projeto A</h3>
                                                <!-- Nome do Autor -->
                                                <small>Por Autor</small>
                                                <br/> <br/>
                                                <img src='imagens/img01.jpg' class="img-thumbnail" height="200" width="200">
                                                <br/> <br/>
                                                <label class="lbl"><b>RESUMO</b></label>
                                                <br>
                                                <!-- Breve Resumo do Projeto -->
                                                <div style="margin-left: 50px; margin-right: 50px; height: 100; width: 100; text-align: justify;">
                                                    Assim mesmo, a revolução dos costumes acarreta um processo de reformulação
                                                    e modernização dos relacionamentos verticais entre as hierarquias. Todavia,
                                                    o consenso sobre a necessidade de qualificação representa uma abertura para 
                                                    a melhoria do remanejamento dos quadros funcionais. Caros amigos, o novo modelo
                                                    estrutural aqui preconizado nos obriga à análise do investimento em reciclagem técnica.

                                                    <br/> <br/>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             aria-valuemin="0" aria-valuemax="100"  style="width:20%">
                                                            <span class="sr-only">20% Complete</span>
                                                            20%
                                                        </div>
                                                    </div>
                                                </div>

                                                <br/> <br/>
                                                <!-- Aqui o usuário será redirecionado para uma página onde 
                                                    será mostrado mais informações do projeto -->
                                                <a href="infoProjetosAprovados.php?id=1"><input type="button" class="btn-primary" value="Ver Mais"></a>
                                                <br/> <br/> 
                                            </div>
                                        </td>
                                        <td align=center width='50%'>
                                            <div style='margin-left:30px;'>
                                               <!-- Nome do Projeto -->
                                                <h3>Projeto B</h3>
                                                <!-- Nome do Autor -->
                                                <small>Por Autor</small>
                                                <br/> <br/>
                                                <img src='imagens/img02.jpg' class="img-thumbnail" height="200" width="200">
                                                <br/> <br/>
                                                <label class="lbl"><b>RESUMO</b></label>
                                                <br>
                                                <!-- Breve Resumo do Projeto -->
                                                <div style="margin-left: 50px; margin-right: 50px; height: 100; width: 100; text-align: justify;">
                                                    Assim mesmo, a revolução dos costumes acarreta um processo de reformulação
                                                    e modernização dos relacionamentos verticais entre as hierarquias. Todavia,
                                                    o consenso sobre a necessidade de qualificação representa uma abertura para 
                                                    a melhoria do remanejamento dos quadros funcionais. Caros amigos, o novo modelo
                                                    estrutural aqui preconizado nos obriga à análise do investimento em reciclagem técnica.
                                                    <br/> <br/>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                             aria-valuemin="0" aria-valuemax="100" style="width:70%;">
                                                            <span class="sr-only">70% Complete</span>
                                                            70%
                                                        </div>
                                                    </div>
                                                </div>
                                                <br/> <br/>
                                                <!-- Aqui o usuário será redirecionado para uma página onde 
                                                    será mostrado mais informações do projeto -->
                                                <a href="infoProjetosAprovados.php?id=2"><input type="button" class="btn-primary" value="Ver Mais"></a>
                                                <br/> <br/> 
                                            </div>
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
<?php include ("footer.php"); ?>