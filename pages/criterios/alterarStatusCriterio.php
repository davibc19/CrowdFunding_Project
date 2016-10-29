<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateAV();

$operacao = $_GET['op'];
if(strcmp($operacao, "desativar") == 0)
    desativaCriterio($_GET['id']);
else if(strcmp($operacao, "ativar") == 0)
    ativaCriterio($_GET['id']);