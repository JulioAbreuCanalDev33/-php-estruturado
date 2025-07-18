<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/TabelaPrestadorModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class PrestadorController {
    
    public function index() {
        requireLogin();
        requireAdmin(); // Apenas admin pode acessar prestadores
        
        $prestadores = TabelaPrestadorModel::getAll();
        $title = 'Prestadores - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/prestadores/index.php';
    }
    
    public function create() {
        requireLogin();
        requireAdmin();
        
        $title = 'Novo Prestador - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/prestadores/create.php';
    }
    
    public function store() {
        requireLogin();
        requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('prestadores.php');
        }
        
        $errors = [];
        
        // Validar dados obrigatórios
        $nome_prestador = sanitize($_POST['nome_prestador'] ?? '');
        $equipes = sanitize($_POST['equipes'] ?? '');
        $servico_prestador = sanitize($_POST['servico_prestador'] ?? '');
        $cpf_prestador = sanitize($_POST['cpf_prestador'] ?? '');
        $rg_prestador = sanitize($_POST['rg_prestador'] ?? '');
        $email_prestador = sanitize($_POST['email_prestador'] ?? '');
        $telefone_1_prestador = sanitize($_POST['telefone_1_prestador'] ?? '');
        $telefone_2_prestador = sanitize($_POST['telefone_2_prestador'] ?? '');
        $cep_prestador = sanitize($_POST['cep_prestador'] ?? '');
        $endereco_prestador = sanitize($_POST['endereco_prestador'] ?? '');
        $numero_prestador = sanitize($_POST['numero_prestador'] ?? '');
        $bairro_prestador = sanitize($_POST['bairro_prestador'] ?? '');
        $cidade_prestador = sanitize($_POST['cidade_prestador'] ?? '');
        $estado_prestador = sanitize($_POST['estado_prestador'] ?? '');
        $observacao = sanitize($_POST['observacao'] ?? '');
        $documento_prestador = sanitize($_POST['documento_prestador'] ?? '');
        $foto_prestador = sanitize($_POST['foto_prestador'] ?? '');
        $codigo_do_banco = sanitize($_POST['codigo_do_banco'] ?? '');
        $pix_banco_prestadores = sanitize($_POST['pix_banco_prestadores'] ?? '');
        $titular_conta = sanitize($_POST['titular_conta'] ?? '');
        $tipo_de_conta = sanitize($_POST['tipo_de_conta'] ?? '');
        $agencia_prestadores = sanitize($_POST['agencia_prestadores'] ?? '');
        $digito_agencia_prestadores = sanitize($_POST['digito_agencia_prestadores'] ?? '');
        $conta_prestadores = sanitize($_POST['conta_prestadores'] ?? '');
        $digito_conta_prestadores = sanitize($_POST['digito_conta_prestadores'] ?? '');
        
        // Validações básicas
        if (empty($nome_prestador)) {
            $errors[] = 'Nome do prestador é obrigatório';
        }
        
        if (empty($servico_prestador)) {
            $errors[] = 'Serviço do prestador é obrigatório';
        }
        
        if (empty($cpf_prestador)) {
            $errors[] = 'CPF é obrigatório';
        } elseif (!validarCPF($cpf_prestador)) {
            $errors[] = 'CPF inválido';
        }
        
        if (empty($email_prestador)) {
            $errors[] = 'Email é obrigatório';
        } elseif (!filter_var($email_prestador, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email inválido';
        }
        
        if (empty($telefone_1_prestador)) {
            $errors[] = 'Telefone principal é obrigatório';
        }
        
        if (empty($endereco_prestador)) {
            $errors[] = 'Endereço é obrigatório';
        }
        
        if (empty($cidade_prestador)) {
            $errors[] = 'Cidade é obrigatória';
        }
        
        if (empty($estado_prestador)) {
            $errors[] = 'Estado é obrigatório';
        }
        
        // Validações bancárias
        if (empty($codigo_do_banco)) {
            $errors[] = 'Código do banco é obrigatório';
        }
        
        if (empty($titular_conta)) {
            $errors[] = 'Titular da conta é obrigatório';
        }
        
        if (empty($tipo_de_conta)) {
            $errors[] = 'Tipo de conta é obrigatório';
        }
        
        if (empty($agencia_prestadores)) {
            $errors[] = 'Agência é obrigatória';
        }
        
        if (empty($conta_prestadores)) {
            $errors[] = 'Conta é obrigatória';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('prestadores.php?action=create');
        }
        
        $data = [
            'nome_prestador' => $nome_prestador,
            'equipes' => $equipes,
            'servico_prestador' => $servico_prestador,
            'cpf_prestador' => $cpf_prestador,
            'rg_prestador' => $rg_prestador,
            'email_prestador' => $email_prestador,
            'telefone_1_prestador' => $telefone_1_prestador,
            'telefone_2_prestador' => $telefone_2_prestador,
            'cep_prestador' => $cep_prestador,
            'endereco_prestador' => $endereco_prestador,
            'numero_prestador' => $numero_prestador,
            'bairro_prestador' => $bairro_prestador,
            'cidade_prestador' => $cidade_prestador,
            'estado_prestador' => $estado_prestador,
            'observacao' => $observacao,
            'documento_prestador' => $documento_prestador,
            'foto_prestador' => $foto_prestador,
            'codigo_do_banco' => $codigo_do_banco,
            'pix_banco_prestadores' => $pix_banco_prestadores,
            'titular_conta' => $titular_conta,
            'tipo_de_conta' => $tipo_de_conta,
            'agencia_prestadores' => $agencia_prestadores,
            'digito_agencia_prestadores' => $digito_agencia_prestadores,
            'conta_prestadores' => $conta_prestadores,
            'digito_conta_prestadores' => $digito_conta_prestadores
        ];
        
        if (TabelaPrestadorModel::create($data)) {
            $_SESSION['success'] = 'Prestador criado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar prestador';
        }
        
        redirect('prestadores.php');
    }
    
    public function show() {
        requireLogin();
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        $prestador = TabelaPrestadorModel::getById($id);
        
        if (!$prestador) {
            $_SESSION['error'] = 'Prestador não encontrado';
            redirect('prestadores.php');
        }
        
        $title = 'Visualizar Prestador - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/prestadores/show.php';
    }
    
    public function edit() {
        requireLogin();
        requireAdmin();
        
        $id = $_GET['id'] ?? 0;
        $prestador = TabelaPrestadorModel::getById($id);
        
        if (!$prestador) {
            $_SESSION['error'] = 'Prestador não encontrado';
            redirect('prestadores.php');
        }
        
        $title = 'Editar Prestador - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/prestadores/edit.php';
    }
    
    public function update() {
        requireLogin();
        requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('prestadores.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $prestador = TabelaPrestadorModel::getById($id);
        
        if (!$prestador) {
            $_SESSION['error'] = 'Prestador não encontrado';
            redirect('prestadores.php');
        }
        
        $errors = [];
        
        // Validar dados (mesmo processo do store)
        $nome_prestador = sanitize($_POST['nome_prestador'] ?? '');
        $equipes = sanitize($_POST['equipes'] ?? '');
        $servico_prestador = sanitize($_POST['servico_prestador'] ?? '');
        $cpf_prestador = sanitize($_POST['cpf_prestador'] ?? '');
        $rg_prestador = sanitize($_POST['rg_prestador'] ?? '');
        $email_prestador = sanitize($_POST['email_prestador'] ?? '');
        $telefone_1_prestador = sanitize($_POST['telefone_1_prestador'] ?? '');
        $telefone_2_prestador = sanitize($_POST['telefone_2_prestador'] ?? '');
        $cep_prestador = sanitize($_POST['cep_prestador'] ?? '');
        $endereco_prestador = sanitize($_POST['endereco_prestador'] ?? '');
        $numero_prestador = sanitize($_POST['numero_prestador'] ?? '');
        $bairro_prestador = sanitize($_POST['bairro_prestador'] ?? '');
        $cidade_prestador = sanitize($_POST['cidade_prestador'] ?? '');
        $estado_prestador = sanitize($_POST['estado_prestador'] ?? '');
        $observacao = sanitize($_POST['observacao'] ?? '');
        $documento_prestador = sanitize($_POST['documento_prestador'] ?? '');
        $foto_prestador = sanitize($_POST['foto_prestador'] ?? '');
        $codigo_do_banco = sanitize($_POST['codigo_do_banco'] ?? '');
        $pix_banco_prestadores = sanitize($_POST['pix_banco_prestadores'] ?? '');
        $titular_conta = sanitize($_POST['titular_conta'] ?? '');
        $tipo_de_conta = sanitize($_POST['tipo_de_conta'] ?? '');
        $agencia_prestadores = sanitize($_POST['agencia_prestadores'] ?? '');
        $digito_agencia_prestadores = sanitize($_POST['digito_agencia_prestadores'] ?? '');
        $conta_prestadores = sanitize($_POST['conta_prestadores'] ?? '');
        $digito_conta_prestadores = sanitize($_POST['digito_conta_prestadores'] ?? '');
        
        // Validações básicas (mesmas do store)
        if (empty($nome_prestador)) {
            $errors[] = 'Nome do prestador é obrigatório';
        }
        
        if (empty($servico_prestador)) {
            $errors[] = 'Serviço do prestador é obrigatório';
        }
        
        if (empty($cpf_prestador)) {
            $errors[] = 'CPF é obrigatório';
        } elseif (!validarCPF($cpf_prestador)) {
            $errors[] = 'CPF inválido';
        }
        
        if (empty($email_prestador)) {
            $errors[] = 'Email é obrigatório';
        } elseif (!filter_var($email_prestador, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('prestadores.php?action=edit&id=' . $id);
        }
        
        $data = [
            'nome_prestador' => $nome_prestador,
            'equipes' => $equipes,
            'servico_prestador' => $servico_prestador,
            'cpf_prestador' => $cpf_prestador,
            'rg_prestador' => $rg_prestador,
            'email_prestador' => $email_prestador,
            'telefone_1_prestador' => $telefone_1_prestador,
            'telefone_2_prestador' => $telefone_2_prestador,
            'cep_prestador' => $cep_prestador,
            'endereco_prestador' => $endereco_prestador,
            'numero_prestador' => $numero_prestador,
            'bairro_prestador' => $bairro_prestador,
            'cidade_prestador' => $cidade_prestador,
            'estado_prestador' => $estado_prestador,
            'observacao' => $observacao,
            'documento_prestador' => $documento_prestador,
            'foto_prestador' => $foto_prestador,
            'codigo_do_banco' => $codigo_do_banco,
            'pix_banco_prestadores' => $pix_banco_prestadores,
            'titular_conta' => $titular_conta,
            'tipo_de_conta' => $tipo_de_conta,
            'agencia_prestadores' => $agencia_prestadores,
            'digito_agencia_prestadores' => $digito_agencia_prestadores,
            'conta_prestadores' => $conta_prestadores,
            'digito_conta_prestadores' => $digito_conta_prestadores
        ];
        
        if (TabelaPrestadorModel::update($id, $data)) {
            $_SESSION['success'] = 'Prestador atualizado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar prestador';
        }
        
        redirect('prestadores.php');
    }
    
    public function delete() {
        requireLogin();
        requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('prestadores.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (TabelaPrestadorModel::delete($id)) {
            $_SESSION['success'] = 'Prestador excluído com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir prestador';
        }
        
        redirect('prestadores.php');
    }
}

?>

