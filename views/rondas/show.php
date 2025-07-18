<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes da Ronda Periódica</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="rondas.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="rondas.php?action=edit&id=<?php echo $ronda['id_ronda_periodica']; ?>" class="btn btn-sm btn-outline-warning">
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
                <h5 class="card-title mb-0">Dados Básicos da Ronda</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID da Ronda:</strong><br>
                        <span class="text-muted"><?php echo $ronda['id_ronda_periodica']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Cliente:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['cliente']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Serviço:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['servico']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Solicitante:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['solicitante']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Motivo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['motivo']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <?php if ($ronda['status_ronda'] === 'Ativa'): ?>
                            <span class="badge bg-success fs-6">Ativa</span>
                        <?php elseif ($ronda['status_ronda'] === 'Finalizada'): ?>
                            <span class="badge bg-secondary fs-6">Finalizada</span>
                        <?php elseif ($ronda['status_ronda'] === 'Pausada'): ?>
                            <span class="badge bg-warning fs-6">Pausada</span>
                        <?php else: ?>
                            <span class="badge bg-info fs-6"><?php echo htmlspecialchars($ronda['status_ronda']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Localização -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Localização da Ronda</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço:</strong><br>
                        <span class="text-muted">
                            <?php echo htmlspecialchars($ronda['endereco_da_ronda']); ?>
                            <?php if (!empty($ronda['numero'])): ?>
                                , <?php echo htmlspecialchars($ronda['numero']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php if (!empty($ronda['cidade']) || !empty($ronda['estado']) || !empty($ronda['cep'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($ronda['cidade'])): ?>
                    <div class="col-md-4">
                        <strong>Cidade:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['cidade']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ronda['estado'])): ?>
                    <div class="col-md-4">
                        <strong>Estado:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['estado']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ronda['cep'])): ?>
                    <div class="col-md-4">
                        <strong>CEP:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['cep']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($ronda['latitude']) || !empty($ronda['longitude'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($ronda['latitude'])): ?>
                    <div class="col-md-6">
                        <strong>Latitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['latitude']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ronda['longitude'])): ?>
                    <div class="col-md-6">
                        <strong>Longitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['longitude']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Detalhes da Ronda -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalhes da Ronda</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($ronda['tempo_no_local'])): ?>
                    <div class="col-md-4">
                        <strong>Tempo no Local:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['tempo_no_local']); ?> minutos</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ronda['quilometragem'])): ?>
                    <div class="col-md-4">
                        <strong>Quilometragem:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ronda['quilometragem']); ?> km</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ronda['valor_ronda'])): ?>
                    <div class="col-md-4">
                        <strong>Valor da Ronda:</strong><br>
                        <span class="text-muted">R$ <?php echo number_format($ronda['valor_ronda'], 2, ',', '.'); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($ronda['descricao_dos_fatos'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Descrição dos Fatos:</strong><br>
                        <div class="text-muted" style="white-space: pre-wrap;"><?php echo htmlspecialchars($ronda['descricao_dos_fatos']); ?></div>
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
                <?php if (!empty($ronda['hora_solicitada'])): ?>
                <div class="mb-3">
                    <strong>Hora Solicitada:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ronda['hora_solicitada'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($ronda['hora_local'])): ?>
                <div class="mb-3">
                    <strong>Hora Local:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ronda['hora_local'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($ronda['hora_saida'])): ?>
                <div class="mb-3">
                    <strong>Hora Saída:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ronda['hora_saida'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (empty($ronda['hora_solicitada']) && empty($ronda['hora_local']) && empty($ronda['hora_saida'])): ?>
                <div class="text-muted text-center">
                    <i class="fas fa-clock fa-2x mb-2"></i><br>
                    Nenhum horário registrado
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Status de Pagamento -->
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Status de Pagamento</h6>
            </div>
            <div class="card-body text-center">
                <?php if ($ronda['status_pagamento'] === 'Pago'): ?>
                    <span class="badge bg-success fs-5">Pago</span>
                <?php elseif ($ronda['status_pagamento'] === 'Pendente'): ?>
                    <span class="badge bg-warning fs-5">Pendente</span>
                <?php elseif ($ronda['status_pagamento'] === 'Atrasado'): ?>
                    <span class="badge bg-danger fs-5">Atrasado</span>
                <?php else: ?>
                    <span class="badge bg-info fs-5"><?php echo htmlspecialchars($ronda['status_pagamento']); ?></span>
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
                    <a href="rondas.php?action=edit&id=<?php echo $ronda['id_ronda_periodica']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Ronda
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Ronda
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
                <p>Tem certeza que deseja excluir esta ronda periódica?</p>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($ronda['cliente']); ?></p>
                <p><strong>Serviço:</strong> <?php echo htmlspecialchars($ronda['servico']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="rondas.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $ronda['id_ronda_periodica']; ?>">
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

