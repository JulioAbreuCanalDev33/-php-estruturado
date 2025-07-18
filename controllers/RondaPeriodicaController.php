<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/RondaPeriodicaModel.php';
require_once __DIR__ . '/../models/AtendimentoModel.php';
// require_once __DIR__ . '/../includes/validation.php';

class RondaPeriodicaController {
    
    public function index() {
        requireLogin();
        
        $rondas = RondaPeriodicaModel::getAll();
        $title = 'Rondas Periódicas - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/rondas/index.php';
    }
    
    public function create() {
        requireLogin();
        
        $atendimentos = AtendimentoModel::getAll();
        $title = 'Nova Ronda Periódica - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/rondas/create.php';
    }
    
    public function store() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('rondas.php');
        }
        
        $errors = [];
        
        // Validar dados
        $id_atendimento = sanitize($_POST['id_atendimento'] ?? '');
        $quantidade_rondas = sanitize($_POST['quantidade_rondas'] ?? '');
        $data_final = sanitize($_POST['data_final'] ?? '');
        $pagamento = sanitize($_POST['pagamento'] ?? 'Pendente');
        $contato_no_local = sanitize($_POST['contato_no_local'] ?? 'Não');
        $nome_local = sanitize($_POST['nome_local'] ?? '');
        $funcao_local = sanitize($_POST['funcao_local'] ?? '');
        $verificado_fiacao = sanitize($_POST['verificado_fiacao'] ?? 'Não');
        $quadro_eletrico = sanitize($_POST['quadro_eletrico'] ?? 'Não');
        $verificado_portas_entradas = sanitize($_POST['verificado_portas_entradas'] ?? 'Não');
        $local_energizado = sanitize($_POST['local_energizado'] ?? 'Não');
        $sirene_disparada = sanitize($_POST['sirene_disparada'] ?? 'Não');
        $local_violado = sanitize($_POST['local_violado'] ?? 'Não');
        $observacao = sanitize($_POST['observacao'] ?? '');
        
        if (empty($id_atendimento)) {
            $errors[] = 'Atendimento é obrigatório';
        }
        
        if (empty($quantidade_rondas) || !is_numeric($quantidade_rondas)) {
            $errors[] = 'Quantidade de rondas deve ser um número válido';
        }
        
        if (empty($data_final)) {
            $errors[] = 'Data final é obrigatória';
        }
        
        if (!in_array($pagamento, ['Pago', 'Pendente'])) {
            $errors[] = 'Status de pagamento inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('rondas.php?action=create');
        }
        
        $data = [
            'id_atendimento' => $id_atendimento,
            'quantidade_rondas' => $quantidade_rondas,
            'data_final' => $data_final,
            'pagamento' => $pagamento,
            'contato_no_local' => $contato_no_local,
            'nome_local' => $nome_local,
            'funcao_local' => $funcao_local,
            'verificado_fiacao' => $verificado_fiacao,
            'quadro_eletrico' => $quadro_eletrico,
            'verificado_portas_entradas' => $verificado_portas_entradas,
            'local_energizado' => $local_energizado,
            'sirene_disparada' => $sirene_disparada,
            'local_violado' => $local_violado,
            'observacao' => $observacao
        ];
        
        if (RondaPeriodicaModel::create($data)) {
            $_SESSION['success'] = 'Ronda periódica criada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar ronda periódica';
        }
        
        redirect('rondas.php');
    }
    
    public function show() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $ronda = RondaPeriodicaModel::getById($id);
        
        if (!$ronda) {
            $_SESSION['error'] = 'Ronda periódica não encontrada';
            redirect('rondas.php');
        }
        
        $title = 'Visualizar Ronda Periódica - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/rondas/show.php';
    }
    
    public function edit() {
        requireLogin();
        
        $id = $_GET['id'] ?? 0;
        $ronda = RondaPeriodicaModel::getById($id);
        
        if (!$ronda) {
            $_SESSION['error'] = 'Ronda periódica não encontrada';
            redirect('rondas.php');
        }
        
        $atendimentos = AtendimentoModel::getAll();
        $title = 'Editar Ronda Periódica - Sistema de Ocorrências';
        
        include __DIR__ . '/../views/rondas/edit.php';
    }
    
    public function update() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('rondas.php');
        }
        
        $id = $_POST['id'] ?? 0;
        $ronda = RondaPeriodicaModel::getById($id);
        
        if (!$ronda) {
            $_SESSION['error'] = 'Ronda periódica não encontrada';
            redirect('rondas.php');
        }
        
        $errors = [];
        
        // Validar dados (mesmo processo do store)
        $id_atendimento = sanitize($_POST['id_atendimento'] ?? '');
        $quantidade_rondas = sanitize($_POST['quantidade_rondas'] ?? '');
        $data_final = sanitize($_POST['data_final'] ?? '');
        $pagamento = sanitize($_POST['pagamento'] ?? 'Pendente');
        $contato_no_local = sanitize($_POST['contato_no_local'] ?? 'Não');
        $nome_local = sanitize($_POST['nome_local'] ?? '');
        $funcao_local = sanitize($_POST['funcao_local'] ?? '');
        $verificado_fiacao = sanitize($_POST['verificado_fiacao'] ?? 'Não');
        $quadro_eletrico = sanitize($_POST['quadro_eletrico'] ?? 'Não');
        $verificado_portas_entradas = sanitize($_POST['verificado_portas_entradas'] ?? 'Não');
        $local_energizado = sanitize($_POST['local_energizado'] ?? 'Não');
        $sirene_disparada = sanitize($_POST['sirene_disparada'] ?? 'Não');
        $local_violado = sanitize($_POST['local_violado'] ?? 'Não');
        $observacao = sanitize($_POST['observacao'] ?? '');
        
        if (empty($id_atendimento)) {
            $errors[] = 'Atendimento é obrigatório';
        }
        
        if (empty($quantidade_rondas) || !is_numeric($quantidade_rondas)) {
            $errors[] = 'Quantidade de rondas deve ser um número válido';
        }
        
        if (empty($data_final)) {
            $errors[] = 'Data final é obrigatória';
        }
        
        if (!in_array($pagamento, ['Pago', 'Pendente'])) {
            $errors[] = 'Status de pagamento inválido';
        }
        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = $_POST;
            redirect('rondas.php?action=edit&id=' . $id);
        }
        
        $data = [
            'id_atendimento' => $id_atendimento,
            'quantidade_rondas' => $quantidade_rondas,
            'data_final' => $data_final,
            'pagamento' => $pagamento,
            'contato_no_local' => $contato_no_local,
            'nome_local' => $nome_local,
            'funcao_local' => $funcao_local,
            'verificado_fiacao' => $verificado_fiacao,
            'quadro_eletrico' => $quadro_eletrico,
            'verificado_portas_entradas' => $verificado_portas_entradas,
            'local_energizado' => $local_energizado,
            'sirene_disparada' => $sirene_disparada,
            'local_violado' => $local_violado,
            'observacao' => $observacao
        ];
        
        if (RondaPeriodicaModel::update($id, $data)) {
            $_SESSION['success'] = 'Ronda periódica atualizada com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar ronda periódica';
        }
        
        redirect('rondas.php');
    }
    
    public function delete() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('rondas.php');
        }
        
        $id = $_POST['id'] ?? 0;
        
        if (RondaPeriodicaModel::delete($id)) {
            $_SESSION['success'] = 'Ronda periódica excluída com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao excluir ronda periódica';
        }
        
        redirect('rondas.php');
    }
}

?>

