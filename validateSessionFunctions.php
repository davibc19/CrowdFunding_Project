<?php
session_start();

function validateHeader()
{
    // Usuário Deslogado
    if (!isset($_SESSION["tipoUsr"]))
    {
        include("header.php");
    }
    // Usuário Gestor Orçamentário
    else if (strcmp ($_SESSION["tipoUsr"], "1") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Avaliador de Pró Reitoria XYZ
    else if (strcmp ($_SESSION["tipoUsr"], "2") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Gestor de Projetos
    else if (strcmp ($_SESSION["tipoUsr"], "3") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Financiador Técnico
    else if (strcmp ($_SESSION["tipoUsr"], "4") == 0)
    {
        include("headerGO.php");
    }
    // Usuário Financiador Aluno
    else if (strcmp ($_SESSION["tipoUsr"], "5") == 0)
    {
        include("headerGO.php");
    }
}

?>