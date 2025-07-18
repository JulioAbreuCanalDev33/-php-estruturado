<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Visualizar Agente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="agentes.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="agentes.php?action=edit&id=<?php echo $agente['id_agente']; ?>" class="btn btn-sm btn-warning">
                <i class="fas fa-edit me-1"></i>Editar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados do Agente</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">ID do Agente</label>
                            <p class="form-control-plaintext"><?php echo $agente['id_agente']; ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-plaintext">
                                <?php if ($agente['status'] === 'Ativo'): ?>
                                    <span class="badge bg-success fs-6">Ativo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger fs-6">Inativo</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nome Completo</label>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($agente['nome']); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Função</label>
                            <p class="form-control-plaintext"><?php echo htmlspecialchars($agente['funcao']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Ações</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="agentes.php?action=edit&id=<?php echo $agente['id_agente']; ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Editar Agente
                    </a>
                    
                    <button type="button" class="btn btn-danger" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-2"></i>Excluir Agente
                    </button>
                    
                    <hr>
                    
                    <a href="agentes.php" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>Lista de Agentes
                    </a>
                    
                    <a href="agentes.php?action=create" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Novo Agente
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Informações</h6>
            </div>
            <div class="card-body">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Este agente pode ser associado a atendimentos e outras operações do sistema.
                </small>
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
                <p>Tem certeza que deseja excluir o agente <strong><?php echo htmlspecialchars($agente['nome']); ?></strong>?</p>
                <p class="text-muted">Todos os dados relacionados a este agente serão removidos permanentemente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="agentes.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $agente['id_agente']; ?>">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Excluir Definitivamente
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

