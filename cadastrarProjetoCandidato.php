<?php
require_once './validateSessionFunctions.php';
require_once './functionsBd.php';
validateHeader();
validateGP();

if (isset($_POST['enviar']))
{
    if ( isset($_FILES['imagem']['name']) && ($_FILES['imagem']['error'] == 0) )
    {
        $name = $_FILES['imagem']['name'];
        $tmp_name = $_FILES['imagem']['tmp_name'];
        $location = "Imagens/$name";
    } else
    {
        $tmp_name = "SemImagem";
        $location = "Imagens/NoImage.jpg";
    }
    
    print_r($_FILES['imagem']['error']);
    
    cadastrarProjetoCandidato(
            $_POST['tipoFinanciamento'], $_POST['categoria'], $_POST['titulo'], $location, $_POST['descricao'],
            $_POST['duracao'], $_POST['interVal'], $_POST['dataInicio'], $_POST['status'], $_POST['valorTotal'], 
            $_SESSION['cpf'], $_POST['resumo'], $tmp_name);
}
?>

<script type="text/javascript">
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

    function mostraDiv(valor)
    {
        if (valor == "modular")
        {
            document.getElementById("interVal").style.display = "block";
            document.getElementById("interValTitle").style.display = "block";
        } else
        {
            document.getElementById("interVal").style.display = "none";
            document.getElementById("interValTitle").style.display = "none";
        }
    }

    function mascara(o, f) {
        v_obj = o
        v_fun = f
        setTimeout("execmascara()", 1)
    }

    function execmascara() {
        v_obj.value = v_fun(v_obj.value)
    }

    function mnum(v)
    {
        v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
        return v
    }

    function mmoney(v)
    {
        v = v.replace(/\D/g, "");//Remove tudo o que não é dígito
        /*v = v.replace(/(\d)(\d{11})$/, "$1$2");//coloca o ponto dos trilhões
         v = v.replace(/(\d)(\d{8})$/, "$1.$2");//coloca o ponto dos bilhões
         v = v.replace(/(\d)(\d{5})$/, "$1.$2");//coloca o ponto dos milhões
         */
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }
</script>

<style type="text/css">
    #interVal, #interValTitle
    {
        display:none;
    }
</style>


<div class="container">
    <form name="cadastroEditalCota" enctype="multipart/form-data" onSubmit="Submeter();">
        <div class="form-group">
            <label for="tipoFinanciamento">Tipo de Financiamento</label>
            <br/>
            <select class="selectpicker" id="tipoFinanciamento" name="tipoFinanciamento" onchange="mostraDiv(this.value)">
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
            <label for="valorTotal">Valor Total:</label>
            <input type="text" name="valorTotal" required class="form-control" id="valorTotal" onkeypress="mascara(this, mmoney);">
        </div>

        <div class="form-group">
            <label for="imagem">Arquivo</label>
            <input type="file" name="imagem" id="uploadedfile"/><br />
        </div>

        <div class="form-group">
            <label for="resumo">Resumo:</label>
            <textarea name=resumo required class="form-control" cols=8 rows=3 maxlength="100"></textarea>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição Completa:</label>
            <textarea name=descricao required class="form-control" cols=8 rows=3></textarea>
        </div>

        <div class="form-group">
            <label for="duracao">Duração (em dias):</label>
            <input type="text" name="duracao" required class="form-control" id="duracao"  onkeypress="mascara(this, mnum);">
        </div>

        <!-- Exibida SE for selecionada a opção "Por Módulos -->
        <div class="form-group">
            <label for="interVal" id="interValTitle">Intervalo de Valores:</label>
            <textarea name=interVal class="form-control" cols=8 rows=3 id="interVal" maxlength="100"></textarea>
        </div>

        <!-- Data de Inicio -->
        <div class="form-group">
            <input type="hidden" name="dataInicio" required class="form-control" id="dataInicio" 
                   value="<?php
                   date_default_timezone_set('America/Sao_Paulo');
                   $date = date('Y-m-d');
                   echo $date;
                   ?>">
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
