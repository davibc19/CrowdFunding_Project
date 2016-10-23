<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();

if (isset($_POST['enviar']))
{
    $cep = $_POST['cep'];

    $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

    $dados['rua'] = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
    $dados['bairro'] = (string) $reg->bairro;
    $dados['cidade'] = (string) $reg->cidade;
    $dados['estado'] = (string) $reg->uf;
    
    alterarUsuario($_SESSION['cpf'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['cep'], $dados['rua'], 
            $dados['bairro'], $dados['cidade'], $dados['estado']);
}

$query = procuraAutor($_SESSION['cpf']);
$dados = mysql_fetch_array($query);
?>


<div class="container">
    <form action="alterarUsuario.php" method="post" name="AlterarUsuario">
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" class="form-control" id="nome" value="<?php echo $dados['nome'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $dados['email'] ?>">
        </div>
        <div class="form-group">
            <label for="pwd">Senha:</label>
            <input type="password" name="senha" class="form-control" id="pwd" value="<?php echo $dados['senha'] ?>">
        </div>
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" name="cep" class="form-control" id="cep" maxlength="8" value="<?php echo $dados['cep'] ?>">
        </div>
        <div class="form-group">
            <label for="rua">Rua:</label>
            <input type="text" class="form-control" name="rua" id="rua" size="45" value="<?php echo $dados['rua'] ?>" />
        </div>
        <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" required class="form-control" name="numero" id="numero" size="5" value="<?php echo $dados['numero'] ?>"/>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" class="form-control" name="bairro" id="bairro" size="25" value="<?php echo $dados['bairro'] ?>" />
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" class="form-control" name="cidade" id="cidade" size="25" value="<?php echo $dados['cidade'] ?>" />
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" class="form-control" name="estado" id="estado" size="2" value="<?php echo $dados['estado'] ?>" />
        </div>

        <button type="submit" name="enviar" class="btn btn-success">Alterar</button>
        <button type="reset" class="btn btn-warning">Limpar</button>
    </form>
</div>

<?php include("../template/footer.php") ?>