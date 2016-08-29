<?php include("header.php");?>

<section id="infoProjetosConcluidos" class="container">
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
                                        <tr>
                                            <td align=center width='75%'>
                                                <div style='margin-left:30px;'>
                                                    <br/> <br/>
                                                    <label class="lbl"><b>DESCRIÇÃO</b></label>
                                                    <br>
                                                    <!-- Descrição Completa do Projeto -->
                                                    <div style="text-align: justify;">
                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi gravida libero nec velit. Morbi scelerisque luctus velit. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Proin mattis lacinia justo. Vestibulum facilisis auctor urna. Aliquam in lorem sit amet leo accumsan lacinia. Integer rutrum, orci vestibulum ullamcorper ultricies, lacus quam ultricies odio, vitae placerat pede sem sit amet enim. Phasellus et lorem id felis nonummy placerat. Fusce dui leo, imperdiet in, aliquam sit amet, feugiat eu, orci. Aenean vel massa quis mauris vehicula lacinia. Quisque tincidunt scelerisque libero. Maecenas libero. Etiam dictum tincidunt diam. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Suspendisse nisl. Sed convallis magna eu sem. Cras pede libero, dapibus nec, pretium sit amet, tempor quis, urna.

                                                        Etiam posuere quam ac quam. Maecenas aliquet accumsan leo. Nullam dapibus fermentum ipsum. Etiam quis quam. Integer lacinia. Nulla est. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Integer vulputate sem a nibh rutrum consequat. Maecenas lorem. Pellentesque pretium lectus id turpis. Etiam sapien elit, consequat eget, tristique non, venenatis quis, ante. Fusce wisi. Phasellus faucibus molestie nisl. Fusce eget urna. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut tempus purus at lorem.

                                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nullam feugiat, turpis at pulvinar vulputate, erat libero tristique tellus, nec bibendum odio risus sit amet ante. Aliquam erat volutpat. Nunc auctor. Mauris pretium quam et urna. Fusce nibh. Duis risus. Curabitur sagittis hendrerit ante. Aliquam erat volutpat. Vestibulum erat nulla, ullamcorper nec, rutrum non, nonummy ac, erat. Duis condimentum augue id magna semper rutrum. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Fusce consectetuer risus a nunc. Aliquam ornare wisi eu metus. Integer pellentesque quam vel velit. Duis pulvinar.
                                                        <br/><br/>
                                                    </div>
                                                </div>
                                            </td>
                                            <td align=center width='30%'>
                                                <div style="text-align: center; border-top-width: 100px">
                                                    <!-- Resumão dos dados do crowdfunding -->
                                                    <img src='imagens/img0<?php echo $_GET['id']?>.jpg' class="img-thumbnail" height="200" width="200">
                                                    <br> <br>
                                                    Total Arrecadado: 
                                                    <br> 100.000,00 de 200.000,00
                                                    <br> <br>
                                                    Total Cumprido: 
                                                    <br> 50% 
                                                    <br> <br>
                                                    Apoiado por:
                                                    <br> 25.000 pessoas
                                                    <br> <br>
                                                    Duração: 
                                                    <br> 25 dias
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align=center width='100%' colspan="2">
                                                <div style="text-align: center; border-top-width: 100px">
                                                    <div style='margin-left:30px;'>
                                                        <!-- Caso exista, o sistema de recompensas será demonstrado aqui -->
                                                        <label class="lbl"><b>RELATÓRIO</b></label>
                                                        <br>
                                                        << ESTE BLOCO SÓ ESTARÁ DISPONÍVEL PARA O DONO DO PROJETO >>
                                                        <br>
                                                        <a href="relatorioDoacoes.php">Exibir Relatório</a>
                                                    </div>
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
</section>
<?php include("footer.php") ?>