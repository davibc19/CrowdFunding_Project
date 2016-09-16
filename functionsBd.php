<?php

include '/conexaoBd.php';

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE INSERÇÃO
 * ---------------------------------------------------------------------- */

function cadastrarUsuario($tipo, $cpf, $nome, $email, $senha)
{
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

function cadastrarEditalOrcamento($ano, $valTotal, $cotaAluno, $cotaProf, $cotaServ)
{

    if (($cotaAluno + $cotaProf + $cotaServ) != 1)
    {
        echo "<script> alert('Erro no cadastro das cotas do Edital de Orçamento!');"
        . " window.location='cadastrarEditalCota.php';</script>";
    } else
    {
        // Pega QTD de usuários
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'aluno'");
        $qtdAluno = mysql_result($SQL, 0);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'professor'");
        $qtdProfessor = mysql_fetch_array($SQL);
        $SQL = mysql_query("SELECT COUNT(*) FROM usuario WHERE tipo = 'tecnico'");
        $qtdServ = mysql_fetch_array($SQL);

        // Realiza contas
        $valTotalAluno = $valTotal * $cotaAluno;
        $valTotalProfessor = $valTotal * $cotaProf;
        $valTotalServ = $valTotal * $cotaServ;

        if ($qtdAluno[0] != 0)
            $valIndAluno = $valTotalAluno / $qtdAluno[0];
        else
            $valIndAluno = 0;

        if ($qtdProfessor[0] != 0)
            $valIndProfessor = $valTotalProfessor / $qtdProfessor[0];
        else
            $valIndAluno = 0;

        if ($qtdServ[0] != 0)
            $valIndServ = $valTotalServ / $qtdServ[0];
        else
            $valIndAluno = 0;

        // ATUALIZAR FUNÇÃO
        $res = "INSERT INTO editalorcamento (ano, valTotal, cotaAluno, cotaProfessor, cotaServ, "
                . "qtdAluno, qtdProfessor, qtdServ, "
                . "valTotalAluno, valTotalProfessor, valTotalServ,"
                . "valIndAluno, valIndProfessor, valIndServ) VALUES "
                . "('$ano', '$valTotal', '$cotaAluno', '$cotaProf', '$cotaServ', "
                . "'[$qtdAluno[0]', '$qtdProfessor[0]', '$qtdServ[0]', "
                . "'$valTotalAluno', '$valTotalProfessor', '$valTotalServ',"
                . "'$valIndAluno', '$valIndProfessor', '$valIndServ')";

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

function alterarUsuario($cpf, $nome, $email, $senha)
{
    $res = null;

    if ($nome != null && $email != null && $senha != null)
    // ATUALIZAR FUNÇÃO
        $res = "UPDATE usuario SET nome = '" . $nome . "', email = '" . $email . "', senha = '" . $senha . "' "
                . "WHERE cpf = '" . $cpf . "'";

    else if ($nome != null && $senha != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "', senha = '" . $senha . "' "
                . "WHERE cpf = '" . $cpf . "'";

    else if ($email != null && $senha != null)
        $res = "UPDATE usuario SET email = '" . $email . "', senha = '" . $senha . "' "
                . "WHERE cpf = '" . $cpf . "'";

    else if ($nome != null && $email != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "', email = '" . $email . "'"
                . "WHERE cpf = '" . $cpf . "'";

    else if ($nome != null)
        $res = "UPDATE usuario SET nome = '" . $nome . "'"
                . "WHERE cpf = '" . $cpf . "'";

    else if ($email != null)
        $res = "UPDATE usuario SET email = '" . $email . "'"
                . "WHERE cpf = '" . $cpf . "'";

    else if ($senha != null)
        $res = "UPDATE usuario SET senha = '" . $senha . "' "
                . "WHERE cpf = '" . $cpf . "'";

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

/* ----------------------------------------------------------------------
 *                    FUNÇÕES DE CONSULTA
 * ---------------------------------------------------------------------- */

function consultaEditalOrcamento()
{
    RETURN mysql_query("SELECT ano, valTotal FROM editalorcamento");
}

function consultaCotaFinanciameno()
{
    RETURN mysql_query("SELECT * FROM editalorcamento");
}

?>