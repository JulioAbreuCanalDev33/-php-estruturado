<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Agente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="agentes.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="agentes.php?action=show&id=<?php echo $agente['id_agente']; ?>" class="btn btn-sm btn-outline-info">
                <i class="fas fa-eye me-1"></i>Visualizar
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
                <form method="POST" action="agentes.php?action=update">
                    <input type="hidden" name="id" value="<?php echo $agente['id_agente']; ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" required
                                       value="<?php echo isset($_SESSION['old_input']['nome']) ? htmlspecialchars($_SESSION['old_input']['nome']) : htmlspecialchars($agente['nome']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="funcao" class="form-label">Função <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="funcao" name="funcao" required
                                       value="<?php echo isset($_SESSION['old_input']['funcao']) ? htmlspecialchars($_SESSION['old_input']['funcao']) : htmlspecialchars($agente['funcao']); ?>"
                                       placeholder="Ex: Vigilante, Supervisor, Coordenador">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Selecione o status</option>
                                    <?php 
                                    $statusSelecionado = isset($_SESSION['old_input']['status']) ? $_SESSION['old_input']['status'] : $agente['status'];
                                    ?>
                                    <option value="Ativo" <?php echo ($statusSelecionado === 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                                    <option value="Inativo" <?php echo ($statusSelecionado === 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ID do Agente</label>
                                <input type="text" class="form-control" value="<?php echo $agente['id_agente']; ?>" readonly>
                                <div class="form-text">Este campo não pode ser alterado.</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="agentes.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Alterações
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
                    <strong>Campos obrigatórios</strong><br>
                    Os campos marcados com <span class="text-danger">*</span> são obrigatórios.
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Status do Agente</strong><br>
                    Agentes inativos não aparecerão nas listas de seleção para atendimentos.
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Ações Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="agentes.php?action=show&id=<?php echo $agente['id_agente']; ?>" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-eye me-1"></i>Visualizar Agente
                    </a>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Agente
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
                <p>Tem certeza que deseja excluir o agente <strong><?php echo htmlspecialchars($agente['nome']); ?></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="agentes.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $agente['id_agente']; ?>">
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

<?php 
// Limpar dados antigos da sessão
if (isset($_SESSION['old_input'])) {
    unset($_SESSION['old_input']);
}
?>

<?php include __DIR__ . '/../includes/footer.php'; ?>

