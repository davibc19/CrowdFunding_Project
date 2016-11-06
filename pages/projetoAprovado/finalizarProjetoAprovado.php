<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';
validateGP();

    finalizarProjetoAprovado($_SESSION['id']);


