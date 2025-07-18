<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Novo Agente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="agentes.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
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
                <form method="POST" action="agentes.php?action=store">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" name="nome" required
                                       value="<?php echo isset($_SESSION['old_input']['nome']) ? htmlspecialchars($_SESSION['old_input']['nome']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="funcao" class="form-label">Função <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="funcao" name="funcao" required
                                       value="<?php echo isset($_SESSION['old_input']['funcao']) ? htmlspecialchars($_SESSION['old_input']['funcao']) : ''; ?>"
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
                                    <option value="Ativo" <?php echo (isset($_SESSION['old_input']['status']) && $_SESSION['old_input']['status'] === 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                                    <option value="Inativo" <?php echo (isset($_SESSION['old_input']['status']) && $_SESSION['old_input']['status'] === 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="agentes.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Agente
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
    </div>
</div>

<?php 
// Limpar dados antigos da sessão
if (isset($_SESSION['old_input'])) {
    unset($_SESSION['old_input']);
}
?>

<?php include __DIR__ . '/../includes/footer.php'; ?>

