<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/AtendimentoModel.php';
require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../models/AgenteModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class AtendimentoController {
    
    public function index() {
        requireLogin();
        
        $atendimentos = AtendimentoModel::getAll();
        $title = 'Atendimentos - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/atendimentos/index.php';
    }
    
    public function create() {
        requireLogin();
        
        $clientes = ClienteModel::getAll();
        $agentes = AgenteModel::getAll();
        $title = 'Novo Atendimento - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/atendimentos/create.php';
    }
    
    public function store() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('atendimentos.php');
        }
        
        $errors = [];
        
        // Validar dados obrigatórios
        $solicitante = sanitize($_POST['solicitante'] ?? '');
        $motivo = sanitize($_POST['motivo'] ?? '');
        $valor_patrimonial = sanitize($_POST['valor_patrimonial'] ?? '');
        $id_cliente = sanitize($_POST['id_cliente'] ?? '');
        $conta = sanitize($_POST['conta'] ?? '');
        $id_validacao = sanitize($_POST['id_validacao'] ?? '');
        $filial = sanitize($_POST['filial'] ?? '');
        $ordem_servico = sanitize($_POST['ordem_servico'] ?? '');
        $cep = sanitize($_POST['cep'] ?? '');
        $estado = sanitize($_POST['estado'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $endereco = sanitize($_POST['endereco'] ?? '');
        $numero = sanitize($_POST['numero'] ?? '');
        $latitude = sanitize($_POST['latitude'] ?? '');
        $longitude = sanitize($_POST['longitude'] ?? '');
        $agentes_aptos = sanitize($_POST['agentes_aptos'] ?? '');
        $id_agente = sanitize($_POST['id_agente'] ?? '');
        $equipe = sanitize($_POST['equipe'] ?? '');
        $responsavel = sanitize($_POST['responsavel'] ?? '');
        $estabelecimento = sanitize($_POST['estabelecimento'] ?? '');
        $hora_solicitada = sanitize($_POST['hora_solicitada'] ?? '');
        $hora_local = sanitize($_POST['hora_local'] ?? '');
        $hora_saida = sanitize($_POST['hora_saida'] ?? '');
        $status_atendimento = sanitize($_POST['status_atendimento'] ?? 'Em andamento');
        $tipo_de_servico = sanitize($_POST['tipo_de_servico'] ?? 'Ronda');
        $tipos_de_dados = sanitize($_POST['tipos_de_dados'] ?? '');
        $estabelecida_inicio = sanitize($_POST['estabelecida_inicio'] ?? '');
        $estabelecida_fim = sanitize($_POST['estabelecida_fim'] ?? '');
        $indeterminado = isset($_POST['indeterminado']) ? 1 : 0;
        
        // Validações básicas
        if (empty($solicitante)) {
            $errors[] = 'Solicitante é obrigatório';
        }
        
        if (empty($motivo)) {
            $errors[] = 'Motivo é obrigatório';
        }
        
        if (empty($id_cliente)) {
            $errors[] = 'Cliente é obrigatório';
        }
        
        if (empty($endereco)) {
            $errors[] = 'Endereço é obrigatório';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('atendimentos.php?action=create');
        }
        
        $data = [
            'solicitante' => $solicitante,
            'motivo' => $motivo,
            'valor_patrimonial' => $valor_patrimonial,
            'id_cliente' => $id_cliente,
            'conta' => $conta,
            'id_validacao' => $id_validacao,
            'filial' => $filial,
            'ordem_servico' => $ordem_servico,
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'endereco' => $endereco,
            'numero' => $numero,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'agentes_aptos' => $agentes_aptos,
            'id_agente' => $id_agente,
            'equipe' => $equipe,
            'responsavel' => $responsavel,
            'estabelecimento' => $estabelecimento,
            'hora_solicitada' => $hora_solicitada,
            'hora_local' => $hora_local,
            'hora_saida' => $hora_saida,
            'status_atendimento' => $status_atendimento,
            'tipo_de_servico' => $tipo_de_servico,
            'tipos_de_dados' => $tipos_de_dados,
            'estabelecida_inicio' => $estabelecida_inicio,
            'estabelecida_fim' => $estabelecida_fim,
            'indeterminado' => $indeterminado
        ];
        
        if (AtendimentoModel::create($data)) {
            $_SESSION['success'] = 'Atendimento criado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar atendimento';
        }
        
        redirect('atendimentos.php');
    }
    
    public function show() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $atendimento = AtendimentoModel::getById($id);
        
        if (!$atendimento) {
            $_SESSION['error'] = 'Atendimento não encontrado';
            redirect('atendimentos.php');
        }
        
        $title = 'Visualizar Atendimento - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/atendimentos/show.php';
    }
    
    public function edit() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $atendimento = AtendimentoModel::getById($id);
        
        if (!$atendimento) {
            $_SESSION['error'] = 'Atendimento não encontrado';
            redirect('atendimentos.php');
        }
        
        $clientes = ClienteModel::getAll();
        $agentes = AgenteModel::getAll();
        $title = 'Editar Atendimento - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/atendimentos/edit.php';
    }
    
    public function update() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('atendimentos.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $atendimento = AtendimentoModel::getById($id);
        
        if (!$atendimento) {
            $_SESSION['error'] = 'Atendimento não encontrado';
            redirect('atendimentos.php');
        }
        
        $errors = [];
        
        // Validar dados (mesmo processo do store)
        $solicitante = sanitize($_POST['solicitante'] ?? '');
        $motivo = sanitize($_POST['motivo'] ?? '');
        $valor_patrimonial = sanitize($_POST['valor_patrimonial'] ?? '');
        $id_cliente = sanitize($_POST['id_cliente'] ?? '');
        $conta = sanitize($_POST['conta'] ?? '');
        $id_validacao = sanitize($_POST['id_validacao'] ?? '');
        $filial = sanitize($_POST['filial'] ?? '');
        $ordem_servico = sanitize($_POST['ordem_servico'] ?? '');
        $cep = sanitize($_POST['cep'] ?? '');
        $estado = sanitize($_POST['estado'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $endereco = sanitize($_POST['endereco'] ?? '');
        $numero = sanitize($_POST['numero'] ?? '');
        $latitude = sanitize($_POST['latitude'] ?? '');
        $longitude = sanitize($_POST['longitude'] ?? '');
        $agentes_aptos = sanitize($_POST['agentes_aptos'] ?? '');
        $id_agente = sanitize($_POST['id_agente'] ?? '');
        $equipe = sanitize($_POST['equipe'] ?? '');
        $responsavel = sanitize($_POST['responsavel'] ?? '');
        $estabelecimento = sanitize($_POST['estabelecimento'] ?? '');
        $hora_solicitada = sanitize($_POST['hora_solicitada'] ?? '');
        $hora_local = sanitize($_POST['hora_local'] ?? '');
        $hora_saida = sanitize($_POST['hora_saida'] ?? '');
        $status_atendimento = sanitize($_POST['status_atendimento'] ?? 'Em andamento');
        $tipo_de_servico = sanitize($_POST['tipo_de_servico'] ?? 'Ronda');
        $tipos_de_dados = sanitize($_POST['tipos_de_dados'] ?? '');
        $estabelecida_inicio = sanitize($_POST['estabelecida_inicio'] ?? '');
        $estabelecida_fim = sanitize($_POST['estabelecida_fim'] ?? '');
        $indeterminado = isset($_POST['indeterminado']) ? 1 : 0;
        
        // Validações básicas
        if (empty($solicitante)) {
            $errors[] = 'Solicitante é obrigatório';
        }
        
        if (empty($motivo)) {
            $errors[] = 'Motivo é obrigatório';
        }
        
        if (empty($id_cliente)) {
            $errors[] = 'Cliente é obrigatório';
        }
        
        if (empty($endereco)) {
            $errors[] = 'Endereço é obrigatório';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('atendimentos.php?action=edit&id=' . $id);
        }
        
        $data = [
            'solicitante' => $solicitante,
            'motivo' => $motivo,
            'valor_patrimonial' => $valor_patrimonial,
            'id_cliente' => $id_cliente,
            'conta' => $conta,
            'id_validacao' => $id_validacao,
            'filial' => $filial,
            'ordem_servico' => $ordem_servico,
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'endereco' => $endereco,
            'numero' => $numero,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'agentes_aptos' => $agentes_aptos,
            'id_agente' => $id_agente,
            'equipe' => $equipe,
            'responsavel' => $responsavel,
            'estabelecimento' => $estabelecimento,
            'hora_solicitada' => $hora_solicitada,
            'hora_local' => $hora_local,
            'hora_saida' => $hora_saida,
            'status_atendimento' => $status_atendimento,
            'tipo_de_servico' => $tipo_de_servico,
            'tipos_de_dados' => $tipos_de_dados,
            'estabelecida_inicio' => $estabelecida_inicio,
            'estabelecida_fim' => $estabelecida_fim,
            'indeterminado' => $indeterminado
        ];
        
        if (AtendimentoModel::update($id, $data)) {
            $_SESSION['success'] = 'Atendimento atualizado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar atendimento';
        }
        
        redirect('atendimentos.php');
    }
    
    public function delete() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('atendimentos.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (AtendimentoModel::delete($id)) {
            $_SESSION['success'] = 'Atendimento excluído com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir atendimento';
        }
        
        redirect('atendimentos.php');
    }
}

?>

