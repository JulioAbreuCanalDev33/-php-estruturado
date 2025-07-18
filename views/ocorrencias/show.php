<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes da Ocorrência Veicular</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="ocorrencias.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="ocorrencias.php?action=edit&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" class="btn btn-sm btn-outline-warning">
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
                <h5 class="card-title mb-0">Dados Básicos da Ocorrência</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID da Ocorrência:</strong><br>
                        <span class="text-muted"><?php echo $ocorrencia['id_ocorrencia_veicular']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Cliente:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['cliente']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Serviço:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['servico']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Solicitante:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['solicitante']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Motivo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['motivo']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo de Ocorrência:</strong><br>
                        <?php if ($ocorrencia['tipo_de_ocorrencia'] === 'Acidente'): ?>
                            <span class="badge bg-danger fs-6">Acidente</span>
                        <?php elseif ($ocorrencia['tipo_de_ocorrencia'] === 'Roubo'): ?>
                            <span class="badge bg-warning fs-6">Roubo</span>
                        <?php elseif ($ocorrencia['tipo_de_ocorrencia'] === 'Furto'): ?>
                            <span class="badge bg-info fs-6">Furto</span>
                        <?php else: ?>
                            <span class="badge bg-secondary fs-6"><?php echo htmlspecialchars($ocorrencia['tipo_de_ocorrencia']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($ocorrencia['numero_bo'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Número do B.O.:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['numero_bo']); ?></span>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Localização -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Localização da Ocorrência</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço:</strong><br>
                        <span class="text-muted">
                            <?php echo htmlspecialchars($ocorrencia['endereco_da_ocorrencia']); ?>
                            <?php if (!empty($ocorrencia['numero'])): ?>
                                , <?php echo htmlspecialchars($ocorrencia['numero']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php if (!empty($ocorrencia['cidade']) || !empty($ocorrencia['estado']) || !empty($ocorrencia['cep'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($ocorrencia['cidade'])): ?>
                    <div class="col-md-4">
                        <strong>Cidade:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['cidade']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ocorrencia['estado'])): ?>
                    <div class="col-md-4">
                        <strong>Estado:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['estado']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ocorrencia['cep'])): ?>
                    <div class="col-md-4">
                        <strong>CEP:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['cep']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($ocorrencia['latitude']) || !empty($ocorrencia['longitude'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($ocorrencia['latitude'])): ?>
                    <div class="col-md-6">
                        <strong>Latitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['latitude']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ocorrencia['longitude'])): ?>
                    <div class="col-md-6">
                        <strong>Longitude:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['longitude']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Detalhes da Ocorrência -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalhes da Ocorrência</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($ocorrencia['tempo_no_local'])): ?>
                    <div class="col-md-6">
                        <strong>Tempo no Local:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['tempo_no_local']); ?> minutos</span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($ocorrencia['quilometragem'])): ?>
                    <div class="col-md-6">
                        <strong>Quilometragem:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($ocorrencia['quilometragem']); ?> km</span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($ocorrencia['descricao_dos_fatos'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Descrição dos Fatos:</strong><br>
                        <div class="text-muted" style="white-space: pre-wrap;"><?php echo htmlspecialchars($ocorrencia['descricao_dos_fatos']); ?></div>
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
                <?php if (!empty($ocorrencia['hora_solicitada'])): ?>
                <div class="mb-3">
                    <strong>Hora Solicitada:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ocorrencia['hora_solicitada'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($ocorrencia['hora_local'])): ?>
                <div class="mb-3">
                    <strong>Hora Local:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ocorrencia['hora_local'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (!empty($ocorrencia['hora_saida'])): ?>
                <div class="mb-3">
                    <strong>Hora Saída:</strong><br>
                    <span class="text-muted"><?php echo date('d/m/Y H:i', strtotime($ocorrencia['hora_saida'])); ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (empty($ocorrencia['hora_solicitada']) && empty($ocorrencia['hora_local']) && empty($ocorrencia['hora_saida'])): ?>
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
                    <a href="ocorrencias.php?action=edit&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Ocorrência
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Ocorrência
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
                <p>Tem certeza que deseja excluir esta ocorrência veicular?</p>
                <p><strong>Cliente:</strong> <?php echo htmlspecialchars($ocorrencia['cliente']); ?></p>
                <p><strong>Tipo:</strong> <?php echo htmlspecialchars($ocorrencia['tipo_de_ocorrencia']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="ocorrencias.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>">
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

