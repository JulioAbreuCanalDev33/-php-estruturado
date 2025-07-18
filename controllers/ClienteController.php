<?php

require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../includes/config.php';

class ClienteController {
    
    public static function index() {
        $clientes = ClienteModel::getAll();
        include __DIR__ . '/../views/clientes/index.php';
    }
    
    public static function show($id_cliente) {
        $cliente = ClienteModel::getById($id_cliente);
        if (!$cliente) {
            $_SESSION['error'] = 'Cliente não encontrado.';
            redirect('clientes.php');
        }
        include __DIR__ . '/../views/clientes/show.php';
    }
    
    public static function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome_empresa' => sanitize($_POST['nome_empresa']),
                'cnpj' => sanitize($_POST['cnpj']),
                'contato' => sanitize($_POST['contato']),
                'endereco' => sanitize($_POST['endereco']),
                'telefone' => sanitize($_POST['telefone'])
            ];
            
            // Validações
            $errors = [];
            if (empty($data['nome_empresa'])) {
                $errors[] = 'Nome da empresa é obrigatório.';
            }
            if (empty($data['cnpj'])) {
                $errors[] = 'CNPJ é obrigatório.';
            }
            if (empty($data['contato'])) {
                $errors[] = 'Contato é obrigatório.';
            }
            
            if (empty($errors)) {
                $id = ClienteModel::create($data);
                if ($id) {
                    $_SESSION['success'] = 'Cliente criado com sucesso!';
                    redirect('clientes.php');
                } else {
                    $_SESSION['error'] = 'Erro ao criar cliente.';
                }
            } else {
                $_SESSION['errors'] = $errors;
            }
        }
        
        include __DIR__ . '/../views/clientes/create.php';
    }
    
    public static function edit($id_cliente) {
        $cliente = ClienteModel::getById($id_cliente);
        if (!$cliente) {
            $_SESSION['error'] = 'Cliente não encontrado.';
            redirect('clientes.php');
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome_empresa' => sanitize($_POST['nome_empresa']),
                'cnpj' => sanitize($_POST['cnpj']),
                'contato' => sanitize($_POST['contato']),
                'endereco' => sanitize($_POST['endereco']),
                'telefone' => sanitize($_POST['telefone'])
            ];
            
            // Validações
            $errors = [];
            if (empty($data['nome_empresa'])) {
                $errors[] = 'Nome da empresa é obrigatório.';
            }
            if (empty($data['cnpj'])) {
                $errors[] = 'CNPJ é obrigatório.';
            }
            if (empty($data['contato'])) {
                $errors[] = 'Contato é obrigatório.';
            }
            
            if (empty($errors)) {
                $success = ClienteModel::update($id_cliente, $data);
                if ($success) {
                    $_SESSION['success'] = 'Cliente atualizado com sucesso!';
                    redirect('clientes.php');
                } else {
                    $_SESSION['error'] = 'Erro ao atualizar cliente.';
                }
            } else {
                $_SESSION['errors'] = $errors;
            }
        }
        
        include __DIR__ . '/../views/clientes/edit.php';
    }
    
    public static function delete($id_cliente) {
        $cliente = ClienteModel::getById($id_cliente);
        if (!$cliente) {
            $_SESSION['error'] = 'Cliente não encontrado.';
            redirect('clientes.php');
        }
        
        $success = ClienteModel::delete($id_cliente);
        if ($success) {
            $_SESSION['success'] = 'Cliente excluído com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir cliente.';
        }
        
        redirect('clientes.php');
    }
}
?>

