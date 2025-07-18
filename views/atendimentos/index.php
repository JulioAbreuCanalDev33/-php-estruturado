<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Atendimentos</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="atendimentos.php?action=create" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i>Novo Atendimento
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista de Atendimentos</h5>
    </div>
    <div class="card-body">
        <?php if (empty($atendimentos)): ?>
            <div class="text-center py-4">
                <i class="fas fa-headset fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum atendimento cadastrado</h5>
                <p class="text-muted">Clique no botão "Novo Atendimento" para adicionar o primeiro atendimento.</p>
                <a href="atendimentos.php?action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Novo Atendimento
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Solicitante</th>
                            <th>Cliente</th>
                            <th>Endereço</th>
                            <th>Status</th>
                            <th>Tipo de Serviço</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($atendimentos as $atendimento): ?>
                            <tr>
                                <td><?php echo $atendimento['id_atendimento']; ?></td>
                                <td><?php echo htmlspecialchars($atendimento['solicitante']); ?></td>
                                <td>
                                    <?php if (isset($atendimento['cliente_nome'])): ?>
                                        <?php echo htmlspecialchars($atendimento['cliente_nome']); ?>
                                    <?php else: ?>
                                        <span class="text-muted">Cliente ID: <?php echo $atendimento['id_cliente']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($atendimento['endereco']); ?>
                                    <?php if (!empty($atendimento['numero'])): ?>
                                        , <?php echo htmlspecialchars($atendimento['numero']); ?>
                                    <?php endif; ?>
                                    <?php if (!empty($atendimento['cidade'])): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($atendimento['cidade']); ?> - <?php echo htmlspecialchars($atendimento['estado']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($atendimento['status_atendimento'] === 'Em andamento'): ?>
                                        <span class="badge bg-warning">Em andamento</span>
                                    <?php else: ?>
                                        <span class="badge bg-success">Finalizado</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($atendimento['tipo_de_servico'] === 'Ronda'): ?>
                                        <span class="badge bg-info">Ronda</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Preservação</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="atendimentos.php?action=show&id=<?php echo $atendimento['id_atendimento']; ?>" 
                                           class="btn btn-sm btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="atendimentos.php?action=edit&id=<?php echo $atendimento['id_atendimento']; ?>" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmarExclusao(<?php echo $atendimento['id_atendimento']; ?>)" title="Excluir">
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

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="modalExclusao" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este atendimento? Esta ação não pode ser desfeita.
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
    document.getElementById('formExclusao').action = 'atendimentos.php?action=delete';
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

