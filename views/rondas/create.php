<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nova Ronda Periódica</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="rondas.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="rondas.php?action=store">
    <div class="row">
        <div class="col-md-8">
            <!-- Dados Básicos -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Básicos da Ronda</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_atendimento" class="form-label">Atendimento <span class="text-danger">*</span></label>
                                <select class="form-select" id="id_atendimento" name="id_atendimento" required>
                                    <option value="">Selecione o atendimento</option>
                                    <?php foreach ($atendimentos as $atendimento): ?>
                                        <option value="<?php echo $atendimento['id_atendimento']; ?>" 
                                                <?php echo (isset($_SESSION['old_input']['id_atendimento']) && $_SESSION['old_input']['id_atendimento'] == $atendimento['id_atendimento']) ? 'selected' : ''; ?>>
                                            ID: <?php echo $atendimento['id_atendimento']; ?> - <?php echo htmlspecialchars($atendimento['solicitante']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantidade_rondas" class="form-label">Quantidade de Rondas <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="quantidade_rondas" name="quantidade_rondas" required min="1"
                                       value="<?php echo isset($_SESSION['old_input']['quantidade_rondas']) ? htmlspecialchars($_SESSION['old_input']['quantidade_rondas']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="data_final" class="form-label">Data Final</label>
                                <input type="date" class="form-control" id="data_final" name="data_final"
                                       value="<?php echo isset($_SESSION['old_input']['data_final']) ? $_SESSION['old_input']['data_final'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pagamento" class="form-label">Status do Pagamento</label>
                                <select class="form-select" id="pagamento" name="pagamento">
                                    <option value="">Selecione o status</option>
                                    <?php 
                                    $pagamentoSelecionado = isset($_SESSION['old_input']['pagamento']) ? $_SESSION['old_input']['pagamento'] : '';
                                    ?>
                                    <option value="Pendente" <?php echo ($pagamentoSelecionado === 'Pendente') ? 'selected' : 'selected'; ?>>Pendente</option>
                                    <option value="Pago" <?php echo ($pagamentoSelecionado === 'Pago') ? 'selected' : ''; ?>>Pago</option>
                                    <option value="Cancelado" <?php echo ($pagamentoSelecionado === 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informações de Contato -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informações de Contato</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contato_no_local" class="form-label">Contato no Local</label>
                                <input type="text" class="form-control" id="contato_no_local" name="contato_no_local"
                                       value="<?php echo isset($_SESSION['old_input']['contato_no_local']) ? htmlspecialchars($_SESSION['old_input']['contato_no_local']) : ''; ?>"
                                       placeholder="Nome da pessoa de contato">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefone_contato" class="form-label">Telefone do Contato</label>
                                <input type="text" class="form-control" id="telefone_contato" name="telefone_contato"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_contato']) ? htmlspecialchars($_SESSION['old_input']['telefone_contato']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Observações -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Observações e Detalhes</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"
                                  placeholder="Observações sobre a ronda periódica..."><?php echo isset($_SESSION['old_input']['observacoes']) ? htmlspecialchars($_SESSION['old_input']['observacoes']) : ''; ?></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="horario_inicio" class="form-label">Horário de Início</label>
                                <input type="time" class="form-control" id="horario_inicio" name="horario_inicio"
                                       value="<?php echo isset($_SESSION['old_input']['horario_inicio']) ? $_SESSION['old_input']['horario_inicio'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="horario_fim" class="form-label">Horário de Fim</label>
                                <input type="time" class="form-control" id="horario_fim" name="horario_fim"
                                       value="<?php echo isset($_SESSION['old_input']['horario_fim']) ? $_SESSION['old_input']['horario_fim'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="frequencia" class="form-label">Frequência</label>
                                <select class="form-select" id="frequencia" name="frequencia">
                                    <option value="">Selecione a frequência</option>
                                    <?php 
                                    $frequenciaSelecionada = isset($_SESSION['old_input']['frequencia']) ? $_SESSION['old_input']['frequencia'] : '';
                                    ?>
                                    <option value="Diária" <?php echo ($frequenciaSelecionada === 'Diária') ? 'selected' : ''; ?>>Diária</option>
                                    <option value="Semanal" <?php echo ($frequenciaSelecionada === 'Semanal') ? 'selected' : ''; ?>>Semanal</option>
                                    <option value="Quinzenal" <?php echo ($frequenciaSelecionada === 'Quinzenal') ? 'selected' : ''; ?>>Quinzenal</option>
                                    <option value="Mensal" <?php echo ($frequenciaSelecionada === 'Mensal') ? 'selected' : ''; ?>>Mensal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="valor_total" class="form-label">Valor Total (R$)</label>
                                <input type="number" class="form-control" id="valor_total" name="valor_total" min="0" step="0.01"
                                       value="<?php echo isset($_SESSION['old_input']['valor_total']) ? htmlspecialchars($_SESSION['old_input']['valor_total']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Status e Configurações -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Status e Configurações</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status_ronda" class="form-label">Status da Ronda</label>
                        <select class="form-select" id="status_ronda" name="status_ronda">
                            <option value="Ativa" <?php echo (isset($_SESSION['old_input']['status_ronda']) && $_SESSION['old_input']['status_ronda'] === 'Ativa') ? 'selected' : 'selected'; ?>>Ativa</option>
                            <option value="Pausada" <?php echo (isset($_SESSION['old_input']['status_ronda']) && $_SESSION['old_input']['status_ronda'] === 'Pausada') ? 'selected' : ''; ?>>Pausada</option>
                            <option value="Finalizada" <?php echo (isset($_SESSION['old_input']['status_ronda']) && $_SESSION['old_input']['status_ronda'] === 'Finalizada') ? 'selected' : ''; ?>>Finalizada</option>
                            <option value="Cancelada" <?php echo (isset($_SESSION['old_input']['status_ronda']) && $_SESSION['old_input']['status_ronda'] === 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notificar_cliente" name="notificar_cliente" value="1"
                                   <?php echo (isset($_SESSION['old_input']['notificar_cliente']) && $_SESSION['old_input']['notificar_cliente']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="notificar_cliente">
                                Notificar Cliente
                            </label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gerar_relatorio" name="gerar_relatorio" value="1"
                                   <?php echo (isset($_SESSION['old_input']['gerar_relatorio']) && $_SESSION['old_input']['gerar_relatorio']) ? 'checked' : 'checked'; ?>>
                            <label class="form-check-label" for="gerar_relatorio">
                                Gerar Relatório Automático
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Informações -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Informações</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Campos obrigatórios</strong><br>
                        Os campos marcados com <span class="text-danger">*</span> são obrigatórios.
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-route me-2"></i>
                        <strong>Ronda Periódica</strong><br>
                        Defina a quantidade de rondas e a frequência para um controle eficiente.
                    </div>
                </div>
            </div>
            
            <!-- Ações -->
            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Ronda
                        </button>
                        <a href="rondas.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
// Limpar dados antigos da sessão
if (isset($_SESSION['old_input'])) {
    unset($_SESSION['old_input']);
}
?>

<script>
// Máscara para telefone
document.getElementById('telefone_contato').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
        if (value.length <= 10) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        } else {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }
        e.target.value = value;
    }
});

// Validação de horários
document.getElementById('horario_fim').addEventListener('change', function() {
    const inicio = document.getElementById('horario_inicio').value;
    const fim = this.value;
    
    if (inicio && fim && inicio >= fim) {
        alert('O horário de fim deve ser posterior ao horário de início.');
        this.value = '';
    }
});

// Calcular valor por ronda
document.getElementById('quantidade_rondas').addEventListener('input', function() {
    const quantidade = parseInt(this.value) || 0;
    const valorTotal = parseFloat(document.getElementById('valor_total').value) || 0;
    
    if (quantidade > 0 && valorTotal > 0) {
        const valorPorRonda = (valorTotal / quantidade).toFixed(2);
        console.log(`Valor por ronda: R$ ${valorPorRonda}`);
    }
});

// Definir data mínima como hoje
document.getElementById('data_final').min = new Date().toISOString().split('T')[0];
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

