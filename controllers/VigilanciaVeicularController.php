<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/VigilanciaVeicularModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class VigilanciaVeicularController {
    
    public function index() {
        requireLogin();
        
        $vigilancias = VigilanciaVeicularModel::getAll();
        $title = 'Vigilância Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/vigilancia/index.php';
    }
    
    public function create() {
        requireLogin();
        
        $title = 'Nova Vigilância Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/vigilancia/create.php';
    }
    
    public function store() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('vigilancia.php');
        }
        
        $errors = [];
        
        // Validar dados obrigatórios
        $veiculo_foi_recuperado = sanitize($_POST['veiculo_foi_recuperado'] ?? '');
        $condutor_e_proprietario = sanitize($_POST['condutor_e_proprietario'] ?? '');
        $tipo_de_equipamento_embarcado = sanitize($_POST['tipo_de_equipamento_embarcado'] ?? '');
        $placa = sanitize($_POST['placa'] ?? '');
        $renavam = sanitize($_POST['renavam'] ?? '');
        $cor = sanitize($_POST['cor'] ?? '');
        $marca = sanitize($_POST['marca'] ?? '');
        $modelo = sanitize($_POST['modelo'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $dados_adicionais_veiculo = sanitize($_POST['dados_adicionais_veiculo'] ?? '');
        $placa_carreta = sanitize($_POST['placa_carreta'] ?? '');
        $renavam_carreta = sanitize($_POST['renavam_carreta'] ?? '');
        $cor_carreta = sanitize($_POST['cor_carreta'] ?? '');
        $marca_carreta = sanitize($_POST['marca_carreta'] ?? '');
        $modelo_carreta = sanitize($_POST['modelo_carreta'] ?? '');
        $cidade_carreta = sanitize($_POST['cidade_carreta'] ?? '');
        $dados_adicionais_carreta = sanitize($_POST['dados_adicionais_carreta'] ?? '');
        $nome_do_condutor = sanitize($_POST['nome_do_condutor'] ?? '');
        $cpf_condutor = sanitize($_POST['cpf_condutor'] ?? '');
        $cnh_condutor = sanitize($_POST['cnh_condutor'] ?? '');
        $telefone_condutor = sanitize($_POST['telefone_condutor'] ?? '');
        $status_do_atendimento = sanitize($_POST['status_do_atendimento'] ?? 'Em andamento');
        
        // Validações básicas
        if (empty($veiculo_foi_recuperado) || !in_array($veiculo_foi_recuperado, ['Sim', 'Não'])) {
            $errors[] = 'Informação sobre recuperação do veículo é obrigatória';
        }
        
        if (empty($condutor_e_proprietario) || !in_array($condutor_e_proprietario, ['Sim', 'Não'])) {
            $errors[] = 'Informação sobre condutor/proprietário é obrigatória';
        }
        
        if (empty($placa)) {
            $errors[] = 'Placa do veículo é obrigatória';
        }
        
        if (empty($nome_do_condutor)) {
            $errors[] = 'Nome do condutor é obrigatório';
        }
        
        if (!empty($cpf_condutor) && !validarCPF($cpf_condutor)) {
            $errors[] = 'CPF do condutor inválido';
        }
        
        if (!in_array($status_do_atendimento, ['Em andamento', 'Finalizado'])) {
            $errors[] = 'Status do atendimento inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('vigilancia.php?action=create');
        }
        
        $data = [
            'veiculo_foi_recuperado' => $veiculo_foi_recuperado,
            'condutor_e_proprietario' => $condutor_e_proprietario,
            'tipo_de_equipamento_embarcado' => $tipo_de_equipamento_embarcado,
            'placa' => $placa,
            'renavam' => $renavam,
            'cor' => $cor,
            'marca' => $marca,
            'modelo' => $modelo,
            'cidade' => $cidade,
            'dados_adicionais_veiculo' => $dados_adicionais_veiculo,
            'placa_carreta' => $placa_carreta,
            'renavam_carreta' => $renavam_carreta,
            'cor_carreta' => $cor_carreta,
            'marca_carreta' => $marca_carreta,
            'modelo_carreta' => $modelo_carreta,
            'cidade_carreta' => $cidade_carreta,
            'dados_adicionais_carreta' => $dados_adicionais_carreta,
            'nome_do_condutor' => $nome_do_condutor,
            'cpf_condutor' => $cpf_condutor,
            'cnh_condutor' => $cnh_condutor,
            'telefone_condutor' => $telefone_condutor,
            'status_do_atendimento' => $status_do_atendimento
        ];
        
        if (VigilanciaVeicularModel::create($data)) {
            $_SESSION['success'] = 'Vigilância veicular criada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar vigilância veicular';
        }
        
        redirect('vigilancia.php');
    }
    
    public function show() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $vigilancia = VigilanciaVeicularModel::getById($id);
        
        if (!$vigilancia) {
            $_SESSION['error'] = 'Vigilância veicular não encontrada';
            redirect('vigilancia.php');
        }
        
        $title = 'Visualizar Vigilância Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/vigilancia/show.php';
    }
    
    public function edit() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $vigilancia = VigilanciaVeicularModel::getById($id);
        
        if (!$vigilancia) {
            $_SESSION['error'] = 'Vigilância veicular não encontrada';
            redirect('vigilancia.php');
        }
        
        $title = 'Editar Vigilância Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/vigilancia/edit.php';
    }
    
    public function update() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('vigilancia.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $vigilancia = VigilanciaVeicularModel::getById($id);
        
        if (!$vigilancia) {
            $_SESSION['error'] = 'Vigilância veicular não encontrada';
            redirect('vigilancia.php');
        }
        
        $errors = [];
        
        // Validar dados (mesmo processo do store)
        $veiculo_foi_recuperado = sanitize($_POST['veiculo_foi_recuperado'] ?? '');
        $condutor_e_proprietario = sanitize($_POST['condutor_e_proprietario'] ?? '');
        $tipo_de_equipamento_embarcado = sanitize($_POST['tipo_de_equipamento_embarcado'] ?? '');
        $placa = sanitize($_POST['placa'] ?? '');
        $renavam = sanitize($_POST['renavam'] ?? '');
        $cor = sanitize($_POST['cor'] ?? '');
        $marca = sanitize($_POST['marca'] ?? '');
        $modelo = sanitize($_POST['modelo'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $dados_adicionais_veiculo = sanitize($_POST['dados_adicionais_veiculo'] ?? '');
        $placa_carreta = sanitize($_POST['placa_carreta'] ?? '');
        $renavam_carreta = sanitize($_POST['renavam_carreta'] ?? '');
        $cor_carreta = sanitize($_POST['cor_carreta'] ?? '');
        $marca_carreta = sanitize($_POST['marca_carreta'] ?? '');
        $modelo_carreta = sanitize($_POST['modelo_carreta'] ?? '');
        $cidade_carreta = sanitize($_POST['cidade_carreta'] ?? '');
        $dados_adicionais_carreta = sanitize($_POST['dados_adicionais_carreta'] ?? '');
        $nome_do_condutor = sanitize($_POST['nome_do_condutor'] ?? '');
        $cpf_condutor = sanitize($_POST['cpf_condutor'] ?? '');
        $cnh_condutor = sanitize($_POST['cnh_condutor'] ?? '');
        $telefone_condutor = sanitize($_POST['telefone_condutor'] ?? '');
        $status_do_atendimento = sanitize($_POST['status_do_atendimento'] ?? 'Em andamento');
        
        // Validações básicas
        if (empty($veiculo_foi_recuperado) || !in_array($veiculo_foi_recuperado, ['Sim', 'Não'])) {
            $errors[] = 'Informação sobre recuperação do veículo é obrigatória';
        }
        
        if (empty($condutor_e_proprietario) || !in_array($condutor_e_proprietario, ['Sim', 'Não'])) {
            $errors[] = 'Informação sobre condutor/proprietário é obrigatória';
        }
        
        if (empty($placa)) {
            $errors[] = 'Placa do veículo é obrigatória';
        }
        
        if (empty($nome_do_condutor)) {
            $errors[] = 'Nome do condutor é obrigatório';
        }
        
        if (!empty($cpf_condutor) && !validarCPF($cpf_condutor)) {
            $errors[] = 'CPF do condutor inválido';
        }
        
        if (!in_array($status_do_atendimento, ['Em andamento', 'Finalizado'])) {
            $errors[] = 'Status do atendimento inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('vigilancia.php?action=edit&id=' . $id);
        }
        
        $data = [
            'veiculo_foi_recuperado' => $veiculo_foi_recuperado,
            'condutor_e_proprietario' => $condutor_e_proprietario,
            'tipo_de_equipamento_embarcado' => $tipo_de_equipamento_embarcado,
            'placa' => $placa,
            'renavam' => $renavam,
            'cor' => $cor,
            'marca' => $marca,
            'modelo' => $modelo,
            'cidade' => $cidade,
            'dados_adicionais_veiculo' => $dados_adicionais_veiculo,
            'placa_carreta' => $placa_carreta,
            'renavam_carreta' => $renavam_carreta,
            'cor_carreta' => $cor_carreta,
            'marca_carreta' => $marca_carreta,
            'modelo_carreta' => $modelo_carreta,
            'cidade_carreta' => $cidade_carreta,
            'dados_adicionais_carreta' => $dados_adicionais_carreta,
            'nome_do_condutor' => $nome_do_condutor,
            'cpf_condutor' => $cpf_condutor,
            'cnh_condutor' => $cnh_condutor,
            'telefone_condutor' => $telefone_condutor,
            'status_do_atendimento' => $status_do_atendimento
        ];
        
        if (VigilanciaVeicularModel::update($id, $data)) {
            $_SESSION['success'] = 'Vigilância veicular atualizada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar vigilância veicular';
        }
        
        redirect('vigilancia.php');
    }
    
    public function delete() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('vigilancia.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (VigilanciaVeicularModel::delete($id)) {
            $_SESSION['success'] = 'Vigilância veicular excluída com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir vigilância veicular';
        }
        
        redirect('vigilancia.php');
    }
}

?>

