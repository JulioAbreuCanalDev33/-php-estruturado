<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/AgenteModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class AgenteController {
    
    public function index() {
        requireLogin();
        
        $agentes = AgenteModel::getAll();
        $title = 'Agentes - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/agentes/index.php';
    }
    
    public function create() {
        requireLogin();
        
        $title = 'Novo Agente - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/agentes/create.php';
    }
    
    public function store() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('agentes.php');
        }
        
        $errors = [];
        
        // Validar dados
        $nome = sanitize($_POST['nome'] ?? '');
        $funcao = sanitize($_POST['funcao'] ?? '');
        $status = sanitize($_POST['status'] ?? 'Ativo');
        
        if (empty($nome)) {
            $errors[] = 'Nome é obrigatório';
        }
        
        if (empty($funcao)) {
            $errors[] = 'Função é obrigatória';
        }
        
        if (!in_array($status, ['Ativo', 'Inativo'])) {
            $errors[] = 'Status inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('agentes.php?action=create');
        }
        
        $data = [
            'nome' => $nome,
            'funcao' => $funcao,
            'status' => $status
        ];
        
        if (AgenteModel::create($data)) {
            $_SESSION['success'] = 'Agente criado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar agente';
        }
        
        redirect('agentes.php');
    }
    
    public function show() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $agente = AgenteModel::getById($id);
        
        if (!$agente) {
            $_SESSION['error'] = 'Agente não encontrado';
            redirect('agentes.php');
        }
        
        $title = 'Visualizar Agente - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/agentes/show.php';
    }
    
    public function edit() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $agente = AgenteModel::getById($id);
        
        if (!$agente) {
            $_SESSION['error'] = 'Agente não encontrado';
            redirect('agentes.php');
        }
        
        $title = 'Editar Agente - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/agentes/edit.php';
    }
    
    public function update() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('agentes.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $agente = AgenteModel::getById($id);
        
        if (!$agente) {
            $_SESSION['error'] = 'Agente não encontrado';
            redirect('agentes.php');
        }
        
        $errors = [];
        
        // Validar dados
        $nome = sanitize($_POST['nome'] ?? '');
        $funcao = sanitize($_POST['funcao'] ?? '');
        $status = sanitize($_POST['status'] ?? 'Ativo');
        
        if (empty($nome)) {
            $errors[] = 'Nome é obrigatório';
        }
        
        if (empty($funcao)) {
            $errors[] = 'Função é obrigatória';
        }
        
        if (!in_array($status, ['Ativo', 'Inativo'])) {
            $errors[] = 'Status inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('agentes.php?action=edit&id=' . $id);
        }
        
        $data = [
            'nome' => $nome,
            'funcao' => $funcao,
            'status' => $status
        ];
        
        if (AgenteModel::update($id, $data)) {
            $_SESSION['success'] = 'Agente atualizado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar agente';
        }
        
        redirect('agentes.php');
    }
    
    public function delete() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('agentes.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (AgenteModel::delete($id)) {
            $_SESSION['success'] = 'Agente excluído com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir agente';
        }
        
        redirect('agentes.php');
    }
}

?>

