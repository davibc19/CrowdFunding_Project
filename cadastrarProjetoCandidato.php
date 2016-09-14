<?php

require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();
validateGP_AV();

if (isset($_POST['enviar']))
{
    cadastrarProjetoCandidato(
            $_POST['tipoFinanciamento'],
            $_POST['categoria'],
            $_POST['titulo'],
            $_POST['imagem'],
            $_POST['descricao'],
            $_POST['duracao'],
            $_POST['interVal'],
            $_POST['dataInicio'],
            $_POST['status']);
}
?>

<script>
    function Submeter()
    {
        with (document.cadastroEditalCota)
        {
            var option = confirm("Deseja realmente realizar o cadastro do Projeto Candidato?");
            if (option == true) 
            {
                method = "POST";
                action = "cadastrarProjetoCandidato.php";
                x = "Projeto Submetido com Sucesso. Assim que possível, seu projeto será avaliado!";
                submit();
            }
        }
    }
</script>


<div class="container">
    <form name="cadastroEditalCota" onSubmit="Submeter();">
        <div class="form-group">
            <label for="tipoFinanciamento">Tipo de Financiamento</label>
            <br/>
            <select class="selectpicker" id="tipoFinanciamento" name="tipoFinanciamento">
                <option value="integral" selected>Integral</option>
                <option value="modular">Modular</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <br/>
            <select class="selectpicker" id="categoria" name="categoria">
                <option value="extensao" selected>Extensão</option>
                <option value="pesquisa">Pesquisa</option>
                <option value="ensino">Ensino</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required class="form-control" id="titulo">
        </div>
        
         <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" class="form-control" id="imagem">
        </div>
        
         <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name=descricao required class="form-control" cols=8 rows=3></textarea>
        </div>
        
         <div class="form-group">
            <label for="duracao">Duração (em dias):</label>
            <input type="text" name="duracao" required class="form-control" id="duracao">
        </div>
        
        <!-- Exibida SE for selecionada a opção "Por Módulos -->
        <div class="form-group">
            <label for="interVal">Intervalo de Valores:</label>
            <textarea name=interVal required class="form-control" cols=8 rows=3 id="interVal"></textarea>
        </div>
        
        <!-- Data de Inicio -->
        <div class="form-group">
            <input type="hidden" name="dataInicio" required class="form-control" id="dataInicio" 
                   value="<?php date_default_timezone_set('America/Sao_Paulo');
                            $date = date('Y-m-d H:i');
                            echo $date; ?>  ">
        </div>
        
        <!-- Status -->
         <div class="form-group">
             <input type="hidden" id="status" name="status" value="candidato">
        </div>
        
        <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("footer.php"); ?>
