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
    else if (strcmp ($_SESSION["tipoUsr"], "1") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Avaliador de Pró Reitoria XYZ
    else if (strcmp ($_SESSION["tipoUsr"], "2") == 0)
    {
        include("headerPR.php");
    }
    // Usuário Gestor de Projetos
    else if (strcmp ($_SESSION["tipoUsr"], "3") == 0)
    {
        include("headerGP.php");
    }
    // Usuário Financiador Técnico
    else if (strcmp ($_SESSION["tipoUsr"], "4") == 0)
    {
        include("headerFI.php");
    }
    // Usuário Financiador Aluno
    else if (strcmp ($_SESSION["tipoUsr"], "5") == 0)
    {
        include("headerFI.php");
    }
}

?>