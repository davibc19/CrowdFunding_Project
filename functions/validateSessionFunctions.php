<?php

session_start();

// Valida o tipo de usuário que iniciou a sessão, ou se é um usuário não-logado
function validateHeader()
{
    // Usuário não está logado no sistema
    if (!isset($_SESSION["tipoUsr"]))
    {
        include("../template/headerOF.php");
    }
    // Usuário Avaliador de Pró Reitoria XYZ
    else if (strcmp($_SESSION["tipoUsr"], "Avaliador de Projetos") == 0)
    {
        include("../template/headerAV.php");
    }
    // Usuário Gestor de Projetos
    else if (strcmp($_SESSION["tipoUsr"], "Gestor de Projetos") == 0)
    {
        include("../template/headerGP.php");
    }
    // Usuário Financiador Acadêmico/Público
    else if (strcmp($_SESSION["tipoUsr"], "Financiador Academico") == 0 || strcmp($_SESSION["tipoUsr"], "Financiador Público") == 0)
    {
        include("../template/headerFI.php");
    }
}

// Permite acesso apenas ao Gestor de Projetos e ao Avaliador de Pró Reitoria
function validateGP_AV()
{
    if ((isset($_SESSION['tipoUsr'])) && (strcmp($_SESSION['tipoUsr'], "gestorProjeto") != 0) && (strcmp($_SESSION['tipoUsr'], "avaliadorPR") != 0))
    {
        echo "<script>alert('Você não possui permissão para acessar esta página!');"
        . "window.location='../projetoAprovado/projetosAprovados.php';</script>";
    }
}

function validateGP()
{
     if ((isset($_SESSION['tipoUsr'])) && (strcmp($_SESSION['tipoUsr'], "gestorProjeto") != 0))
    {
        echo "<script>alert('Você não possui permissão para acessar esta página!');"
        . "window.location='../projetoAprovado/projetosAprovados.php';</script>";
    }
}

function validateGO()
{
    if ((isset($_SESSION['tipoUsr'])) && (strcmp($_SESSION['tipoUsr'], "gestorOrcamentario") != 0))
    {
        echo "<script>alert('Você não possui permissão para acessar esta página!');"
        . "window.location='../projetoAprovado/projetosAprovados.php';</script>";
    }
}

function validateDonation()
{
    if ((!isset($_SESSION['tipoUsr'])) || (strcmp($_SESSION['tipoUsr'], "gestorProjeto") != 0) 
            || (strcmp($_SESSION['tipoUsr'], "tecnico") != 0) || (strcmp($_SESSION['tipoUsr'], "aluno") != 0))
    {
        echo "<script>alert('Você não possui permissão para acessar esta página!');"
        . "window.location='../projetoAprovado/projetosAprovados.php';</script>";
    }
}

?>