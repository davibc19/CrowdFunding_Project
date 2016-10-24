<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateGP();

    excluirProjetoCandidato($_SESSION['id']);


