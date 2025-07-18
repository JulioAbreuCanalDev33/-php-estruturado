<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Prestadores de Serviço</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <?php if (isAdmin()): ?>
                <a href="prestadores.php?action=create" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus me-1"></i>Novo Prestador
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!isAdmin()): ?>
    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Acesso Restrito</strong><br>
        Apenas administradores podem gerenciar prestadores de serviço.
    </div>
<?php else: ?>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista de Prestadores de Serviço</h5>
    </div>
    <div class="card-body">
        <?php if (empty($prestadores)): ?>
            <div class="text-center py-4">
                <i class="fas fa-handshake fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum prestador cadastrado</h5>
                <p class="text-muted">Clique no botão "Novo Prestador" para adicionar o primeiro prestador.</p>
                <a href="prestadores.php?action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Novo Prestador
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Serviço</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Cidade/Estado</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prestadores as $prestador): ?>
                            <tr>
                                <td><?php echo $prestador['id_prestador']; ?></td>
                                <td><?php echo htmlspecialchars($prestador['nome_prestador']); ?></td>
                                <td>
                                    <span class="badge bg-info"><?php echo htmlspecialchars($prestador['servico_prestador']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($prestador['cpf_prestador']); ?></td>
                                <td>
                                    <?php if (!empty($prestador['email_prestador'])): ?>
                                        <a href="mailto:<?php echo htmlspecialchars($prestador['email_prestador']); ?>">
                                            <?php echo htmlspecialchars($prestador['email_prestador']); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($prestador['telefone_1_prestador'])): ?>
                                        <?php echo htmlspecialchars($prestador['telefone_1_prestador']); ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($prestador['cidade_prestador'])): ?>
                                        <?php echo htmlspecialchars($prestador['cidade_prestador']); ?>
                                        <?php if (!empty($prestador['estado_prestador'])): ?>
                                            - <?php echo htmlspecialchars($prestador['estado_prestador']); ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="prestadores.php?action=show&id=<?php echo $prestador['id_prestador']; ?>" 
                                           class="btn btn-sm btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="prestadores.php?action=edit&id=<?php echo $prestador['id_prestador']; ?>" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmarExclusao(<?php echo $prestador['id_prestador']; ?>)" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php endif; ?>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="modalExclusao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este prestador? Esta ação não pode ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formExclusao" method="POST" style="display: inline;">
                    <input type="hidden" name="id" id="idExclusao">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmarExclusao(id) {
    document.getElementById('idExclusao').value = id;
    document.getElementById('formExclusao').action = 'prestadores.php?action=delete';
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

