<?php
/*
// Conexão com o banco de dados 
require "comum.php";

// Inicia sessões 
session_start();

// Recupera o login 
$login = $_POST["login"];
// Recupera a senha, a criptografando em MD5 
$senha = $_POST["senha"];

// Usuário não forneceu a senha ou o login 
if (!$login || !$senha)
{
    echo "Você deve digitar sua senha e login!";
    exit;
}

/**
 * Executa a consulta no banco de dados. 
 * Caso o número de linhas retornadas seja 1 o login é válido, 
 * caso 0, inválido. 
 
$SQL = "SELECT nome, senha, tipoUsr FROM aut_usuarios WHERE email = ".$login;
$result_id = @mysql_query($SQL) or die("Erro no banco de dados!");
$total = @mysql_num_rows($result_id);

// Caso o usuário tenha digitado um login válido o número de linhas será 1.. 
if ($total)
{
// Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão 
    $dados = @mysql_fetch_array($result_id);

// Agora verifica a senha 
    if (!strcmp($senha, $dados["senha"]))
    {
// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário 
        $_SESSION["tipoUsr"] = $dados["tipoUsr"];
        $_SESSION["nome"] = $dados["nome"];
        header("Location: projetosAprovados.php");
        exit;
    }
// Senha inválida 
    else
    {
        echo "Senha inválida!";
        exit;
    }
}
// Login inválido 
else
{
    echo "O login fornecido por você é inexistente!";
    exit;
}
*/

session_start();
// Atualizar com TIPO DO USUARIO DO BD!!
$_SESSION["tipoUsr"]=2;
// Atualizar com ID DO USUARIO DO BD!!
$_SESSION["id"]=1;

header('Location: projetosAprovados.php');
?> 