<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateHeader();

if (isset($_POST['enviar']))
{
    cadastrarUsuario($_POST['tipoUsr'], $_POST['cpf'], $_POST['nome'], $_POST['email'], $_POST['senha'], 
            $_POST['cep'], $_POST['rua'], $_POST['numero'], $_POST['bairro'], $_POST['cidade'], $_POST['estado'], 
            $_POST['categoria']);
    
} else if (!isset($_POST['enviarCep']))
{
    ?>
    <div class="container">
        <form action="cadastrarUsuario.php" method="post" name="CadastrarUsuario">
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" required class="form-control" id="cep" maxlength="8">
            </div>

            <button type="submit" name="enviarCep" class="btn btn-success">Confirmar CEP</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
        </form>
    </div>
    <?php
} else if (isset($_POST['enviarCep']))
{
    $cep = $_POST['cep'];

    $reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);

    $dados['rua'] = (string) $reg->tipo_logradouro . ' ' . $reg->logradouro;
    $dados['bairro'] = (string) $reg->bairro;
    $dados['cidade'] = (string) $reg->cidade;
    $dados['estado'] = (string) $reg->uf;
    ?>


    <script type="text/javascript">
        function mascara(o, f) {
            v_obj = o
            v_fun = f
            setTimeout("execmascara()", 1)
        }
        function execmascara() {
            v_obj.value = v_fun(v_obj.value)
        }
        function mcpf(v)
        {
            v = v.replace(/\D/g, "")                    //Remove tudo o que não é dígito
            v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{3})(\d)/, "$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
            //de novo (para o segundo bloco de números)
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
            return v
        }
    </script>

    <div class="container">
        <form action="cadastrarUsuario.php" method="post" name="CadastrarUsuario">
            <div class="form-group">
                <label for="tipoUsr">Tipo de Usuário</label>
                <br/>
                <select class="selectpicker" id="tipoUsr" name="tipoUsr">
                    <option value="Gestor de Projetos">Gestor de Projetos</option>
                    <option value="Avaliador de Projetos">Avaliador de Projetos</option>
                    <option value="Financiador Academico" >Financiador Acadêmico</option>
                    <option value="Financiador Publico" selected>Financiador Público</option>
                </select>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <br/>
                <select class="selectpicker" id="categoria" name="categoria">
                    <option value="Pesquisa">Pesquisa</option>
                    <option value="Competição Tecnológica">Competição Tecnológica</option>
                    <option value="Inovação no Ensino">Inovação no Ensino</option>
                    <option value="Manutenção e Reforma">Manutenção e Reforma</option>
                    <option value="Pequenas Obras">Pequenas Obras</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" required class="form-control" id="cpf" onkeypress="mascara(this, mcpf);" maxlength="14">
            </div>
            <div class="form-group">
                <label for="pwd">Senha:</label>
                <input type="password" name="senha" required class="form-control" id="pwd">
            </div>
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" name="nome" required class="form-control" id="nome">
                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento:</label>
                    <input type="date" name="dataNasc" required class="form-control" id="dataNasc">
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" required class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" disabled class="form-control" id="cep" maxlength="8" value="<?php echo $cep ?>">
            </div>
            <div class="form-group">
                <label for="rua">Rua:</label>
                <input type="text" disabled class="form-control" name="rua" id="rua" size="45" value="<?php echo $dados['rua'] ?>" />
            </div>
            <div class="form-group">
                <label for="numero">Número:</label><br />
                <input type="text" required class="form-control" name="numero" id="numero" size="5" />
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label><br />
                <input type="text" disabled class="form-control" name="bairro" id="bairro" size="25" value="<?php echo $dados['bairro'] ?>" />
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label><br />
                <input type="text" disabled class="form-control" name="cidade" id="cidade" size="25" value="<?php echo $dados['cidade'] ?>" />
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label><br />
                <input type="text" disabled class="form-control" name="estado" id="estado" size="2" value="<?php echo $dados['estado'] ?>" />
            </div>

            <button type="submit" name="enviar" class="btn btn-success">Cadastrar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
        </form>
    </div>

<?php } include("../template/footer.php") ?>
