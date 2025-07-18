<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Relatórios</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Imprimir
            </button>
        </div>
    </div>
</div>

<!-- Estatísticas Gerais -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_clientes']; ?></h4>
                        <p class="card-text">Clientes</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-building fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_agentes']; ?></h4>
                        <p class="card-text">Agentes</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_atendimentos']; ?></h4>
                        <p class="card-text">Atendimentos</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-headset fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_rondas']; ?></h4>
                        <p class="card-text">Rondas</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-route fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_ocorrencias']; ?></h4>
                        <p class="card-text">Ocorrências Veiculares</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-car-crash fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_vigilancia']; ?></h4>
                        <p class="card-text">Vigilância Veicular</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-eye fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title"><?php echo $stats['total_prestadores']; ?></h4>
                        <p class="card-text">Prestadores</p>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-handshake fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Geração de Relatórios -->
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Gerar Relatórios</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="relatorios.php?action=export" id="formRelatorio">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo de Relatório <span class="text-danger">*</span></label>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="clientes">Relatório de Clientes</option>
                                    <option value="agentes">Relatório de Agentes</option>
                                    <option value="atendimentos">Relatório de Atendimentos</option>
                                    <option value="rondas">Relatório de Rondas Periódicas</option>
                                    <option value="ocorrencias">Relatório de Ocorrências Veiculares</option>
                                    <option value="vigilancia">Relatório de Vigilância Veicular</option>
                                    <?php if (isAdmin()): ?>
                                        <option value="prestadores">Relatório de Prestadores</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formato" class="form-label">Formato <span class="text-danger">*</span></label>
                                <select class="form-select" id="formato" name="formato" required>
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="data_inicio" class="form-label">Data Início</label>
                                <input type="date" class="form-control" id="data_inicio" name="data_inicio">
                                <div class="form-text">Deixe em branco para incluir todos os registros</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="data_fim" class="form-label">Data Fim</label>
                                <input type="date" class="form-control" id="data_fim" name="data_fim">
                                <div class="form-text">Deixe em branco para incluir todos os registros</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" onclick="limparFormulario()">
                            <i class="fas fa-eraser me-1"></i>Limpar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-download me-1"></i>Gerar Relatório
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Informações</h6>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Formatos Disponíveis</strong><br>
                    <strong>PDF:</strong> Ideal para visualização e impressão<br>
                    <strong>Excel:</strong> Ideal para análise de dados
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-clock me-2"></i>
                    <strong>Filtro por Data</strong><br>
                    Os filtros de data são opcionais. Deixe em branco para incluir todos os registros.
                </div>
                
                <?php if (isAdmin()): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-shield-alt me-2"></i>
                        <strong>Acesso Administrativo</strong><br>
                        Você tem acesso a todos os relatórios, incluindo prestadores.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Relatórios Rápidos</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="gerarRelatorioRapido('clientes', 'pdf')">
                        <i class="fas fa-building me-1"></i>Clientes (PDF)
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="gerarRelatorioRapido('agentes', 'pdf')">
                        <i class="fas fa-users me-1"></i>Agentes (PDF)
                    </button>
                    <button type="button" class="btn btn-outline-warning btn-sm" onclick="gerarRelatorioRapido('atendimentos', 'excel')">
                        <i class="fas fa-headset me-1"></i>Atendimentos (Excel)
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function limparFormulario() {
    document.getElementById('formRelatorio').reset();
}

function gerarRelatorioRapido(tipo, formato) {
    document.getElementById('tipo').value = tipo;
    document.getElementById('formato').value = formato;
    document.getElementById('formRelatorio').submit();
}

// Validação do formulário
document.getElementById('formRelatorio').addEventListener('submit', function(e) {
    const dataInicio = document.getElementById('data_inicio').value;
    const dataFim = document.getElementById('data_fim').value;
    
    if (dataInicio && dataFim && dataInicio > dataFim) {
        e.preventDefault();
        alert('A data de início não pode ser maior que a data de fim.');
        return false;
    }
    
    // Mostrar loading
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Gerando...';
    submitBtn.disabled = true;
    
    // Restaurar botão após 5 segundos (tempo estimado para download)
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 5000);
});

// Definir data máxima como hoje
document.getElementById('data_inicio').max = new Date().toISOString().split('T')[0];
document.getElementById('data_fim').max = new Date().toISOString().split('T')[0];
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

