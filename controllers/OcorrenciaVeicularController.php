<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/OcorrenciaVeicularModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class OcorrenciaVeicularController {
    
    public function index() {
        requireLogin();
        
        $ocorrencias = OcorrenciaVeicularModel::getAll();
        $title = 'Ocorrências Veiculares - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/ocorrencias/index.php';
    }
    
    public function create() {
        requireLogin();
        
        $title = 'Nova Ocorrência Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/ocorrencias/create.php';
    }
    
    public function store() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('ocorrencias.php');
        }
        
        $errors = [];
        
        // Validar dados obrigatórios
        $cliente = sanitize($_POST['cliente'] ?? '');
        $servico = sanitize($_POST['servico'] ?? '');
        $id_validacao = sanitize($_POST['id_validacao'] ?? '');
        $valor_veicular = sanitize($_POST['valor_veicular'] ?? '');
        $cep = sanitize($_POST['cep'] ?? '');
        $estado = sanitize($_POST['estado'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $solicitante = sanitize($_POST['solicitante'] ?? '');
        $motivo = sanitize($_POST['motivo'] ?? '');
        $endereco_da_ocorrencia = sanitize($_POST['endereco_da_ocorrencia'] ?? '');
        $numero = sanitize($_POST['número'] ?? '');
        $latitude = sanitize($_POST['latitude'] ?? '');
        $longitude = sanitize($_POST['longitude'] ?? '');
        $agentes_aptos = sanitize($_POST['agentes_aptos'] ?? '');
        $prestador = sanitize($_POST['prestador'] ?? '');
        $equipe = sanitize($_POST['equipe'] ?? '');
        $tipo_de_ocorrencia = sanitize($_POST['tipo_de_ocorrencia'] ?? '');
        $data_hora_evento = sanitize($_POST['data_hora_evento'] ?? '');
        $data_hora_deslocamento = sanitize($_POST['data_hora_deslocamento'] ?? '');
        $data_hora_transmissao = sanitize($_POST['data_hora_transmissao'] ?? '');
        $data_hora_local = sanitize($_POST['data_hora_local'] ?? '');
        $data_hora_inicio_atendimento = sanitize($_POST['data_hora_inicio_atendimento'] ?? '');
        $data_hora_fim_atendimento = sanitize($_POST['data_hora_fim_atendimento'] ?? '');
        $franquia_hora = sanitize($_POST['franquia_hora'] ?? '');
        $franquia_km = sanitize($_POST['franquia_km'] ?? '');
        $km_inicial_atendimento = sanitize($_POST['km_inicial_atendimento'] ?? '');
        $km_final_atendimento = sanitize($_POST['km_final_atendimento'] ?? '');
        $total_horas_atendimento = sanitize($_POST['total_horas_atendimento'] ?? '');
        $total_km_percorrido = sanitize($_POST['total_km_percorrido'] ?? '');
        $descricao_fatos = sanitize($_POST['descricao_fatos'] ?? '');
        $gastos_adicionais = sanitize($_POST['gastos_adicionais'] ?? '');
        
        // Validações básicas
        if (empty($cliente)) {
            $errors[] = 'Cliente é obrigatório';
        }
        
        if (empty($servico)) {
            $errors[] = 'Serviço é obrigatório';
        }
        
        if (empty($solicitante)) {
            $errors[] = 'Solicitante é obrigatório';
        }
        
        if (empty($motivo)) {
            $errors[] = 'Motivo é obrigatório';
        }
        
        if (empty($endereco_da_ocorrencia)) {
            $errors[] = 'Endereço da ocorrência é obrigatório';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('ocorrencias.php?action=create');
        }
        
        $data = [
            'cliente' => $cliente,
            'servico' => $servico,
            'id_validacao' => $id_validacao,
            'valor_veicular' => $valor_veicular,
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'solicitante' => $solicitante,
            'motivo' => $motivo,
            'endereco_da_ocorrencia' => $endereco_da_ocorrencia,
            'número' => $numero,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'agentes_aptos' => $agentes_aptos,
            'prestador' => $prestador,
            'equipe' => $equipe,
            'tipo_de_ocorrencia' => $tipo_de_ocorrencia,
            'data_hora_evento' => $data_hora_evento,
            'data_hora_deslocamento' => $data_hora_deslocamento,
            'data_hora_transmissao' => $data_hora_transmissao,
            'data_hora_local' => $data_hora_local,
            'data_hora_inicio_atendimento' => $data_hora_inicio_atendimento,
            'data_hora_fim_atendimento' => $data_hora_fim_atendimento,
            'franquia_hora' => $franquia_hora,
            'franquia_km' => $franquia_km,
            'km_inicial_atendimento' => $km_inicial_atendimento,
            'km_final_atendimento' => $km_final_atendimento,
            'total_horas_atendimento' => $total_horas_atendimento,
            'total_km_percorrido' => $total_km_percorrido,
            'descricao_fatos' => $descricao_fatos,
            'gastos_adicionais' => $gastos_adicionais
        ];
        
        if (OcorrenciaVeicularModel::create($data)) {
            $_SESSION['success'] = 'Ocorrência veicular criada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar ocorrência veicular';
        }
        
        redirect('ocorrencias.php');
    }
    
    public function show() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $ocorrencia = OcorrenciaVeicularModel::getById($id);
        
        if (!$ocorrencia) {
            $_SESSION['error'] = 'Ocorrência veicular não encontrada';
            redirect('ocorrencias.php');
        }
        
        $title = 'Visualizar Ocorrência Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/ocorrencias/show.php';
    }
    
    public function edit() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $ocorrencia = OcorrenciaVeicularModel::getById($id);
        
        if (!$ocorrencia) {
            $_SESSION['error'] = 'Ocorrência veicular não encontrada';
            redirect('ocorrencias.php');
        }
        
        $title = 'Editar Ocorrência Veicular - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/ocorrencias/edit.php';
    }
    
    public function update() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('ocorrencias.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $ocorrencia = OcorrenciaVeicularModel::getById($id);
        
        if (!$ocorrencia) {
            $_SESSION['error'] = 'Ocorrência veicular não encontrada';
            redirect('ocorrencias.php');
        }
        
        $errors = [];
        
        // Validar dados (mesmo processo do store)
        $cliente = sanitize($_POST['cliente'] ?? '');
        $servico = sanitize($_POST['servico'] ?? '');
        $id_validacao = sanitize($_POST['id_validacao'] ?? '');
        $valor_veicular = sanitize($_POST['valor_veicular'] ?? '');
        $cep = sanitize($_POST['cep'] ?? '');
        $estado = sanitize($_POST['estado'] ?? '');
        $cidade = sanitize($_POST['cidade'] ?? '');
        $solicitante = sanitize($_POST['solicitante'] ?? '');
        $motivo = sanitize($_POST['motivo'] ?? '');
        $endereco_da_ocorrencia = sanitize($_POST['endereco_da_ocorrencia'] ?? '');
        $numero = sanitize($_POST['número'] ?? '');
        $latitude = sanitize($_POST['latitude'] ?? '');
        $longitude = sanitize($_POST['longitude'] ?? '');
        $agentes_aptos = sanitize($_POST['agentes_aptos'] ?? '');
        $prestador = sanitize($_POST['prestador'] ?? '');
        $equipe = sanitize($_POST['equipe'] ?? '');
        $tipo_de_ocorrencia = sanitize($_POST['tipo_de_ocorrencia'] ?? '');
        $data_hora_evento = sanitize($_POST['data_hora_evento'] ?? '');
        $data_hora_deslocamento = sanitize($_POST['data_hora_deslocamento'] ?? '');
        $data_hora_transmissao = sanitize($_POST['data_hora_transmissao'] ?? '');
        $data_hora_local = sanitize($_POST['data_hora_local'] ?? '');
        $data_hora_inicio_atendimento = sanitize($_POST['data_hora_inicio_atendimento'] ?? '');
        $data_hora_fim_atendimento = sanitize($_POST['data_hora_fim_atendimento'] ?? '');
        $franquia_hora = sanitize($_POST['franquia_hora'] ?? '');
        $franquia_km = sanitize($_POST['franquia_km'] ?? '');
        $km_inicial_atendimento = sanitize($_POST['km_inicial_atendimento'] ?? '');
        $km_final_atendimento = sanitize($_POST['km_final_atendimento'] ?? '');
        $total_horas_atendimento = sanitize($_POST['total_horas_atendimento'] ?? '');
        $total_km_percorrido = sanitize($_POST['total_km_percorrido'] ?? '');
        $descricao_fatos = sanitize($_POST['descricao_fatos'] ?? '');
        $gastos_adicionais = sanitize($_POST['gastos_adicionais'] ?? '');
        
        // Validações básicas
        if (empty($cliente)) {
            $errors[] = 'Cliente é obrigatório';
        }
        
        if (empty($servico)) {
            $errors[] = 'Serviço é obrigatório';
        }
        
        if (empty($solicitante)) {
            $errors[] = 'Solicitante é obrigatório';
        }
        
        if (empty($motivo)) {
            $errors[] = 'Motivo é obrigatório';
        }
        
        if (empty($endereco_da_ocorrencia)) {
            $errors[] = 'Endereço da ocorrência é obrigatório';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('ocorrencias.php?action=edit&id=' . $id);
        }
        
        $data = [
            'cliente' => $cliente,
            'servico' => $servico,
            'id_validacao' => $id_validacao,
            'valor_veicular' => $valor_veicular,
            'cep' => $cep,
            'estado' => $estado,
            'cidade' => $cidade,
            'solicitante' => $solicitante,
            'motivo' => $motivo,
            'endereco_da_ocorrencia' => $endereco_da_ocorrencia,
            'número' => $numero,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'agentes_aptos' => $agentes_aptos,
            'prestador' => $prestador,
            'equipe' => $equipe,
            'tipo_de_ocorrencia' => $tipo_de_ocorrencia,
            'data_hora_evento' => $data_hora_evento,
            'data_hora_deslocamento' => $data_hora_deslocamento,
            'data_hora_transmissao' => $data_hora_transmissao,
            'data_hora_local' => $data_hora_local,
            'data_hora_inicio_atendimento' => $data_hora_inicio_atendimento,
            'data_hora_fim_atendimento' => $data_hora_fim_atendimento,
            'franquia_hora' => $franquia_hora,
            'franquia_km' => $franquia_km,
            'km_inicial_atendimento' => $km_inicial_atendimento,
            'km_final_atendimento' => $km_final_atendimento,
            'total_horas_atendimento' => $total_horas_atendimento,
            'total_km_percorrido' => $total_km_percorrido,
            'descricao_fatos' => $descricao_fatos,
            'gastos_adicionais' => $gastos_adicionais
        ];
        
        if (OcorrenciaVeicularModel::update($id, $data)) {
            $_SESSION['success'] = 'Ocorrência veicular atualizada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar ocorrência veicular';
        }
        
        redirect('ocorrencias.php');
    }
    
    public function delete() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('ocorrencias.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (OcorrenciaVeicularModel::delete($id)) {
            $_SESSION['success'] = 'Ocorrência veicular excluída com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir ocorrência veicular';
        }
        
        redirect('ocorrencias.php');
    }
}

?>

