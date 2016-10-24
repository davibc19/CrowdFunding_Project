<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();
validateGP();

if (isset($_POST['enviar']))
{
    
    alterarProjeto($_SESSION['id'], $_POST['titulo'], $_POST['categoria'], $_POST['valTotal'], $_POST['resumo'],
            $_POST['descricao'], $_POST['duracao']);
}

$query = consultaProjetoPorId($_SESSION['id']);
$dados = mysql_fetch_array($query);

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
    <form action="alterarProjetoCandidato.php" method="post" name="alterarProjetoCandidato">
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <br/>
            <select class="selectpicker" id="categoria" name="categoria">
                <option value="<?php echo $dados['categoria']?>" selected><?php echo $dados['categoria']?></option>
                <option value="Pesquisa">Pesquisa</option>
                <option value="Competição Tecnológica">Competição Tecnológica</option>
                <option value="Inovação no Ensino">Inovação no Ensino</option>
                <option value="Manutenção e Reforma">Manutenção e Reforma</option>
                <option value="Pequenas Obras">Pequenas Obras</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" class="form-control" id="titulo" value="<?php echo $dados['titulo'] ?>">
        </div>
        <div class="form-group">
            <label for="valTotal">Valor Total:</label>
            <input type="text" name="valTotal" class="form-control" id="valTotal" value="<?php echo $dados['valorTotal'] ?>">
        </div>
        <div class="form-group">
            <label for="resumo">Resumo:</label>
            <textarea name=resumo class="form-control" cols=8 rows=3 maxlength="100"><?php echo $dados['resumo'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição Completa:</label>
            <textarea name=descricao class="form-control" cols=8 rows=3><?php echo $dados['descricao'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="duracao">Duração Prevista(em dias):</label>
            <input type="text" name="duracao" class="form-control" id="duracao"  onkeypress="mascara(this, mnum);" value="<?php echo $dados['duracao'] ?>">
        </div>

        <button type="submit" name="enviar" class="btn btn-success">Alterar</button>
    </form>
</div>

<?php 
include("../template/footer.php") ?>