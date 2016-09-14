<?php

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE INSERÇÃO
 * ---------------------------------------------------------------------- */

function cadastrarUsuario($tipo, $cpf, $nome, $email, $senha)
{
    // ATUALIZAR FUNÇÃO
    $res = "INSERT INTO usuario (tipo, cpf, nome, email, senha) VALUES ('$tipo', '$cpf', '$nome', '$email', '$senha')";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuário cadastrado com sucesso!'); "
        . "window.location='projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro do usuario!');"
        . " window.location='cadastrarUsuario.php';</script>";
    }
}

function cadastrarEditalOrcamento($ano, $valTotal)
{
    // ATUALIZAR FUNÇÃO
    $res = "INSERT INTO editalorcamento (ano, valTotal) VALUES ('$ano', '$valTotal)";

    if (mysql_query($res))
    {
        echo "<script> alert('Edital de Orçamento cadastrado com sucesso!'); "
        . "window.location='projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro do Edital de Orçamento!');"
        . " window.location='cadastrarEditalCota.php';</script>";
    }
}

function cadastrarProjetoCandidato($tipoFinanciamento, $categoria, $titulo, $imagem, $descricao, $duracao, $interVal, $dataInicio, $status)
{
    $res = null;

    // ATUALIZAR FUNÇÕES
    // Há Imagem, e há interVal!
    if ($imagem != null && $tipoFinanciamento == "modular")
    {
        $res = "INSERT INTO projetocandidato (tipo, categoria, titulo, imagem, descricao, duracao, interVal, dataInicio, status)"
                . " VALUES ('$tipoFinanciamento', '$categoria', '$titulo', '$imagem', '$descricao',"
                . "'$duracao', '$interVal', '$dataInicio', '$status')";
    }
    // Há Imagem, e NÃO há interVal!
    else if ($imagem != null && $tipoFinanciamento == "integral")
    {
        $res = "INSERT INTO projetocandidato (tipo, categoria, titulo, imagem, descricao, duracao, dataInicio, status)"
                . " VALUES ('$tipoFinanciamento', '$categoria', '$titulo', '$imagem', '$descricao',"
                . "'$duracao', '$dataInicio', '$status')";
    }
    // NÃO há Imagem, e há interVal!
    else if ($imagem == null && $tipoFinanciamento == "modular")
    {
        $res = "INSERT INTO projetocandidato (tipo, categoria, titulo, descricao, duracao, interVal, dataInicio, status)"
                . " VALUES ('$tipoFinanciamento', '$categoria', '$titulo', '$descricao',"
                . "'$duracao', '$interVal', '$dataInicio', '$status')";
    }
    // NÃO há Imagem, e NÃO há interVal!
    else if ($imagem == null && $tipoFinanciamento == "integral")
    {
        $res = "INSERT INTO projetocandidato (tipo, categoria, titulo, descricao, duracao, dataInicio, status)"
                . " VALUES ('$tipoFinanciamento', '$categoria', '$titulo', '$descricao',"
                . "'$duracao', '$dataInicio', '$status')";
    }

    if (mysql_query($res))
    {
        echo "<script> alert('Projeto Candidato cadastrado com sucesso!'); "
        . "window.location='projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro no cadastro da Cota de Financiamento!');"
        . " window.location='cadastrarProjetoCandidato.php';</script>";
    }
}

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE ATUALIZAÇÃO
 * ---------------------------------------------------------------------- */

function alterarUsuario($id, $nome, $email, $senha)
{
    $res = null;

    if ($nome != null && $email != null && $senha != null)
    // ATUALIZAR FUNÇÃO
        $res = "UPDATE usuario SET nome = '" . $nome . "', email = '" . $email . "', senha = '" . $senha . "' "
                . "WHERE id = '" . $id . "'";

    else if ($nome != null && $senha != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "', senha = '" . $senha . "' "
                . "WHERE id = '" . $id . "'";

    else if ($email != null && $senha != null)
        $res = "UPDATE usuario SET email = '" . $email . "', senha = '" . $senha . "' "
                . "WHERE id = '" . $id . "'";

    else if ($nome != null && $email != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "', email = '" . $email . "'"
                . "WHERE id = '" . $id . "'";

    else if ($nome != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "'"
                . "WHERE id = '" . $id . "'";

    else if ($email != null)
        $res = "UPDATE usuario SET email = '" . $email . "'"
                . "WHERE id = '" . $id . "'";

    else if ($senha != null)
        $res = "UPDATE usuario SET senha = '" . $senha . "' "
                . "WHERE id = '" . $id . "'";

    if (mysql_query($res))
    {
        echo "<script> alert('Usuario atualizada com sucesso!'); "
        . "window.location='projetosAprovados.php';</script>";
    } else
    {
        echo "<script> alert('Erro na atualização!'); "
        . "window.location='alterarUsuario.php';</script>";
    }
}

?>