<?php 
    require_once './validateSessionFunctions.php';
    validateHeader();
?>

<section id="contato" class="container">
    <h2 class="page-header">Contato</h2>
    <div class="row">
        <div class="col-sm-8">
            <?php
            // check for a successful form post  
            if (isset($_GET['s']))
                echo "<div class=\"alert alert-success\">" . $_GET['s'] . "</div>";

            // check for a form error  
            elseif (isset($_GET['e']))
                echo "<div class=\"alert alert-danger\">" . $_GET['e'] . "</div>";
            ?>
            <form role="form" method="POST" action="contact-form-submission.php">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label for="contact_name">* Nome</label>
                        <input type="text" name="contact_name" required class="form-control" id="contact_name">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="contact_email">* Email</label>
                        <input type="email" name="contact_email" required class="form-control" id="contact_email">
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="contact_phone">Telefone</label>
                        <input type="tel" name="contact_phone" class="form-control" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}" id="contact_phone">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="message">* Mensagem</label>
                        <textarea  name="message" required class="form-control" rows="6" id="message"></textarea>
                        <br/> 
                        <span>* Campos obrigat&oacute;rios.</span>
                    </div>
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="save" value="contato">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="col-sm-4">
            <i class="glyphicon glyphicon-envelope"></i>
            <a href="mailto:suporte@nefti.com.br">email@email.com.br</a>
            <br/>
            <address style="margin:0;">
                <i class="glyphicon glyphicon-map-marker"></i>
                903 - Av. BPS, 1303 - Pinheirinho <br/>
                <span style="padding-left:18px">Itajubá; - MG </span> <span style="padding-left:15px">CEP: 37500-903 </span>
            </address>
            <i class="glyphicon glyphicon-earphone"></i> (35) 1234-5678
            <br/><br/>
        </div>


    </div>
</section>

<script type="text/javascript">$("#contact_phone").mask("(00) 0000-00009");</script>

<?php
include("footer.php");
?>