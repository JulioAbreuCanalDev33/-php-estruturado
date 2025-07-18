<?php
require_once __DIR__ . '/../includes/config.php';

// Se usuário não estiver logado, redirecionar para login
if (!isLoggedIn()) {
    redirect('login.php');
}

// Redirecionar para dashboard
redirect('dashboard.php');
?>

