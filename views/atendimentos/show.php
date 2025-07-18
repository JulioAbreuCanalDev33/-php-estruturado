<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes do Atendimento</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="atendimentos.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="atendimentos.php?action=edit&id=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-sm btn-outline-warning">
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
                <h5 class="card-title mb-0">Dados Básicos do Atendimento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID do Atendimento:</strong><br>
                        <span class="text-muted"><?php echo $atendimento['id_atendimento']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Cliente:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['cliente']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Serviço:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['servico']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Solicitante:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['solicitante']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Motivo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['motivo']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong><br>
                        <?php if ($atendimento['status_atendimento'] === 'Concluído'): ?>
                            <span class="badge bg-success fs-6">Concluído</span>
                        <?php elseif ($atendimento['status_atendimento'] === 'Em Andamento'): ?>
                            <span class="badge bg-warning fs-6">Em Andamento</span>
                        <?php elseif ($atendimento['status_atendimento'] === 'Pendente'): ?>
                            <span class="badge bg-secondary fs-6">Pendente</span>
                        <?php else: ?>
                            <span class="badge bg-info fs-6"><?php echo htmlspecialchars($atendimento['status_atendimento']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Localização -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Localização do Atendimento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço:</strong><br>
                        <span class="text-muted">
                            <?php echo htmlspecialchars($atendimento['endereco_do_atendimento']); ?>
                            <?php if (!empty($atendimento['numero'])): ?>
                                , <?php echo htmlspecialchars($atendimento['numero']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php if (!empty($atendimento['cidade']) || !empty($atendimento['estado']) || !empty($atendimento['cep'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($atendimento['cidade'])): ?>
                    <div class="col-md-4">
                        <strong>Cidade:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['cidade']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($atendimento['estado'])): ?>
                    <div class="col-md-4">
                        <strong>Estado:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['estado']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($atendimento['cep'])): ?>
                    <div class="col-md-4">
                        <strong>CEP:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['cep']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($atendimento['latitude']) || !empty($atendimento['longitude'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($atendimento['latitude'])): ?>
                    <div class="col-md-6">
                        <strong>Latitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['latitude']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($atendimento['longitude'])): ?>
                    <div class="col-md-6">
                        <strong>Longitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['longitude']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Detalhes do Atendimento -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalhes do Atendimento</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($atendimento['tempo_no_local'])): ?>
                    <div class="col-md-6">
                        <strong>Tempo no Local:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['tempo_no_local']); ?> minutos</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($atendimento['quilometragem'])): ?>
                    <div class="col-md-6">
                        <strong>Quilometragem:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($atendimento['quilometragem']); ?> km</span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($atendimento['descricao_dos_fatos'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Descrição dos Fatos:</strong><br>
                        <div class="text-muted" style="white-space: pre-wrap;"><?php echo htmlspecialchars($atendimento['descricao_dos_fatos']); ?></div>
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
                <?php if (!empty($atendimento['hora_solicitada'])): ?>
                <div class="mb-3">
                    <strong>Hora Solicitada:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($atendimento['hora_solicitada'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($atendimento['hora_local'])): ?>
                <div class="mb-3">
                    <strong>Hora Local:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($atendimento['hora_local'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($atendimento['hora_saida'])): ?>
                <div class="mb-3">
                    <strong>Hora Saída:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($atendimento['hora_saida'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (empty($atendimento['hora_solicitada']) && empty($atendimento['hora_local']) && empty($atendimento['hora_saida'])): ?>
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
                    <a href="atendimentos.php?action=edit&id=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Atendimento
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Atendimento
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
                <p>Tem certeza que deseja excluir este atendimento?</p>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($atendimento['cliente']); ?></p>
                <p><strong>Serviço:</strong> <?php echo htmlspecialchars($atendimento['servico']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="atendimentos.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $atendimento['id_atendimento']; ?>">
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

