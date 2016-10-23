<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP();

if (isset($_POST['enviar']))
{
    if (isset($_FILES['imagem']['name']) && ($_FILES['imagem']['error'] == 0))
    {
        $name = $_FILES['imagem']['name'];
        $tmp_name = $_FILES['imagem']['tmp_name'];
        $location = "../../Imagens/$name";
    } else
    {
        $tmp_name = "SemImagem";
        $location = "../../Imagens/NoImage.jpg";
    }

    cadastrarProjetoCandidato(
            $_POST['categoria'], $_POST['titulo'], $location, $_POST['descricao'], $_POST['duracao'], $_POST['dataInicio'], $_POST['status'], $_POST['valorTotal'], $_SESSION['cpf'], $_POST['resumo'], $tmp_name);
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
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");//coloca a virgula antes dos 2 últimos dígitos
        return v;
    }
</script>

<div class="container">
    <form name="cadastroEditalCota" enctype="multipart/form-data" onSubmit="Submeter();">
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <br/>
            <select class="selectpicker" id="categoria" name="categoria">
                <option value="Pesquisa" selected>Pesquisa</option>
                <option value="Competição Tecnológica">Competição Tecnológica</option>
                <option value="Inovação no Ensino">Inovação no Ensino</option>
                <option value="Manutenção e Reforma">Manutenção e Reforma</option>
                <option value="Pequenas Obras">Pequenas Obras</option>
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
            <label for="duracao">Duração Prevista(em dias):</label>
            <input type="text" name="duracao" required class="form-control" id="duracao"  onkeypress="mascara(this, mnum);">
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

<?php include("../template/footer.php") ?>
