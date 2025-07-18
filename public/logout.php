<?php
require_once __DIR__ . '/../includes/config.php';

// Fazer logout
logoutUser();

// Redirecionar para login
redirect('login.php');
?>

