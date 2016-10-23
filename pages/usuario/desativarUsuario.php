<?php
require_once '../../functions/validateSessionFunctions.php';
require_once '../../functions/functionsBd.php';

desativaUsuario($_SESSION['cpf']);
