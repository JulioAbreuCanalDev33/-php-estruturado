<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes da Vigilância Veicular</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="vigilancia.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="vigilancia.php?action=edit&id=<?php echo $vigilancia['id_vigilancia_veicular']; ?>" class="btn btn-sm btn-outline-warning">
                <i class="fas fa-edit me-1"></i>Editar
            </a>
            <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                <i class="fas fa-print me-1"></i>Imprimir
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Dados Básicos -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados Básicos da Vigilância</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID da Vigilância:</strong><br>
                        <span class="text-muted"><?php echo $vigilancia['id_vigilancia_veicular']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Cliente:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['cliente']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Serviço:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['servico']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Solicitante:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['solicitante']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Motivo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['motivo']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <?php if ($vigilancia['status_vigilancia'] === 'Ativa'): ?>
                            <span class="badge bg-success fs-6">Ativa</span>
                        <?php elseif ($vigilancia['status_vigilancia'] === 'Finalizada'): ?>
                            <span class="badge bg-secondary fs-6">Finalizada</span>
                        <?php elseif ($vigilancia['status_vigilancia'] === 'Pausada'): ?>
                            <span class="badge bg-warning fs-6">Pausada</span>
                        <?php else: ?>
                            <span class="badge bg-info fs-6"><?php echo htmlspecialchars($vigilancia['status_vigilancia']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Dados do Veículo -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados do Veículo</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Placa do Veículo:</strong><br>
                        <span class="badge bg-dark fs-6"><?php echo htmlspecialchars($vigilancia['placa_do_veiculo']); ?></span>
                    </div>
                    <?php if (!empty($vigilancia['marca_veiculo'])): ?>
                    <div class="col-md-4">
                        <strong>Marca:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['marca_veiculo']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['modelo_veiculo'])): ?>
                    <div class="col-md-4">
                        <strong>Modelo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['modelo_veiculo']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($vigilancia['cor_veiculo']) || !empty($vigilancia['ano_veiculo']) || !empty($vigilancia['chassi_veiculo'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($vigilancia['cor_veiculo'])): ?>
                    <div class="col-md-4">
                        <strong>Cor:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['cor_veiculo']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['ano_veiculo'])): ?>
                    <div class="col-md-4">
                        <strong>Ano:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['ano_veiculo']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['chassi_veiculo'])): ?>
                    <div class="col-md-4">
                        <strong>Chassi:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['chassi_veiculo']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Localização -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Localização da Vigilância</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço:</strong><br>
                        <span class="text-muted">
                            <?php echo htmlspecialchars($vigilancia['endereco_da_vigilancia']); ?>
                            <?php if (!empty($vigilancia['numero'])): ?>
                                , <?php echo htmlspecialchars($vigilancia['numero']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php if (!empty($vigilancia['cidade']) || !empty($vigilancia['estado']) || !empty($vigilancia['cep'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($vigilancia['cidade'])): ?>
                    <div class="col-md-4">
                        <strong>Cidade:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['cidade']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['estado'])): ?>
                    <div class="col-md-4">
                        <strong>Estado:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['estado']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['cep'])): ?>
                    <div class="col-md-4">
                        <strong>CEP:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['cep']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($vigilancia['latitude']) || !empty($vigilancia['longitude'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($vigilancia['latitude'])): ?>
                    <div class="col-md-6">
                        <strong>Latitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['latitude']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['longitude'])): ?>
                    <div class="col-md-6">
                        <strong>Longitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['longitude']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Detalhes da Vigilância -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalhes da Vigilância</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($vigilancia['tempo_no_local'])): ?>
                    <div class="col-md-4">
                        <strong>Tempo no Local:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['tempo_no_local']); ?> minutos</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['quilometragem'])): ?>
                    <div class="col-md-4">
                        <strong>Quilometragem:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($vigilancia['quilometragem']); ?> km</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($vigilancia['valor_vigilancia'])): ?>
                    <div class="col-md-4">
                        <strong>Valor da Vigilância:</strong><br>
                        <span class="text-muted">R$ <?php echo number_format($vigilancia['valor_vigilancia'], 2, ',', '.'); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($vigilancia['descricao_dos_fatos'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Descrição dos Fatos:</strong><br>
                        <div class="text-muted" style="white-space: pre-wrap;"><?php echo htmlspecialchars($vigilancia['descricao_dos_fatos']); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Horários -->
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Horários</h6>
            </div>
            <div class="card-body">
                <?php if (!empty($vigilancia['hora_solicitada'])): ?>
                <div class="mb-3">
                    <strong>Hora Solicitada:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($vigilancia['hora_solicitada'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($vigilancia['hora_local'])): ?>
                <div class="mb-3">
                    <strong>Hora Local:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($vigilancia['hora_local'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($vigilancia['hora_saida'])): ?>
                <div class="mb-3">
                    <strong>Hora Saída:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($vigilancia['hora_saida'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (empty($vigilancia['hora_solicitada']) && empty($vigilancia['hora_local']) && empty($vigilancia['hora_saida'])): ?>
                <div class="text-muted text-center">
                    <i class="fas fa-clock fa-2x mb-2"></i><br>
                    Nenhum horário registrado
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Ações Rápidas -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Ações Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="vigilancia.php?action=edit&id=<?php echo $vigilancia['id_vigilancia_veicular']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Vigilância
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Vigilância
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="modalExclusao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Atenção!</strong> Esta ação não pode ser desfeita.
                </div>
                <p>Tem certeza que deseja excluir esta vigilância veicular?</p>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($vigilancia['cliente']); ?></p>
                <p><strong>Placa:</strong> <?php echo htmlspecialchars($vigilancia['placa_do_veiculo']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="vigilancia.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $vigilancia['id_vigilancia_veicular']; ?>">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarExclusao() {
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

