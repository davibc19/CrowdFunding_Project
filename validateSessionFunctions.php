<?php

session_start();

// Valida o tipo de usuário que iniciou a sessão, ou se é um usuário não-logado
function validateHeader()
{
    // Usuário não está logado no sistema
    if (!isset($_SESSION["tipoUsr"]))
    {
        include("headerOF.php");
    }
    // Usuário Gestor Orçamentário
    else if (strcmp($_SESSION["tipoUsr"], "1") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Avaliador de Pró Reitoria XYZ
    else if (strcmp($_SESSION["tipoUsr"], "2") == 0)
    {
        include("headerAV.php");
    }
    // Usuário Gestor de Projetos
    else if (strcmp($_SESSION["tipoUsr"], "3") == 0)
    {
        include("headerGP.php");
    }
    // Usuário Financiador Técnico
    else if (strcmp($_SESSION["tipoUsr"], "4") == 0)
    {
        include("headerFI.php");
    }
    // Usuário Financiador Aluno
    else if (strcmp($_SESSION["tipoUsr"], "5") == 0)
    {
        include("headerFI.php");
    }
}

// Permite acesso apenas ao Gestor de Projetos e ao Avaliador de Pró Reitoria
function validateGP_AV()
{
    if ((strcmp($_SESSION['tipoUsr'], "3") != 0) && (strcmp($_SESSION['tipoUsr'], "2") != 0) )
    {
        echo "<script>alert('Você não possui permissão para acessar esta página!');"
        . "window.location='projetosAprovados.php';</script>";
    }
}

?>