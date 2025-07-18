<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../controllers/RondaPeriodicaController.php';

// Verificar se o usuário está logado
requireLogin();

$action = $_GET['action'] ?? 'index';
$controller = new RondaPeriodicaController();

try {
    switch ($action) {
        case 'index':
            $controller->index();
            break;
            
        case 'create':
            $controller->create();
            break;
            
        case 'store':
            $controller->store();
            break;
            
        case 'show':
            $controller->show();
            break;
            
        case 'edit':
            $controller->edit();
            break;
            
        case 'update':
            $controller->update();
            break;
            
        case 'delete':
            $controller->delete();
            break;
            
        default:
            $controller->index();
            break;
    }
} catch (Exception $e) {
    $_SESSION['error'] = 'Erro: ' . $e->getMessage();
    redirect('rondas.php');
}

?>

