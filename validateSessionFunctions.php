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
}

?>