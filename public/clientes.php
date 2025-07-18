<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../controllers/ClienteController.php';

// Verificar se usuário está logado
if (!isLoggedIn()) {
    redirect('login.php');
}

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'show':
        ClienteController::show($id);
        break;
    case 'create':
        ClienteController::create();
        break;
    case 'edit':
        ClienteController::edit($id);
        break;
    case 'delete':
        ClienteController::delete($id);
        break;
    default:
        ClienteController::index();
        break;
}
?>

