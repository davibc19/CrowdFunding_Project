<?php
session_start();

function validateHeader()
{
    if (!isset($_SESSION["tipoUsr"]))
    {
        include("header.php");
    } else if (strcmp ($_SESSION["tipoUsr"], "1") == 0)
    {
        include("headerGO.php");
    }
}

?>