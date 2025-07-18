<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Rondas Periódicas</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="rondas.php?action=create" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i>Nova Ronda
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista de Rondas Periódicas</h5>
    </div>
    <div class="card-body">
        <?php if (empty($rondas)): ?>
            <div class="text-center py-4">
                <i class="fas fa-route fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhuma ronda cadastrada</h5>
                <p class="text-muted">Clique no botão "Nova Ronda" para adicionar a primeira ronda periódica.</p>
                <a href="rondas.php?action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nova Ronda
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Atendimento</th>
                            <th>Quantidade de Rondas</th>
                            <th>Data Final</th>
                            <th>Pagamento</th>
                            <th>Contato no Local</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rondas as $ronda): ?>
                            <tr>
                                <td><?php echo $ronda['id_ronda_periodica']; ?></td>
                                <td>
                                    <?php if (isset($ronda['atendimento_id'])): ?>
                                        <span class="badge bg-info">ID: <?php echo $ronda['id_atendimento']; ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">Atendimento ID: <?php echo $ronda['id_atendimento']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-primary"><?php echo $ronda['quantidade_rondas']; ?> rondas</span>
                                </td>
                                <td>
                                    <?php if (!empty($ronda['data_final'])): ?>
                                        <?php echo date('d/m/Y', strtotime($ronda['data_final'])); ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($ronda['pagamento'] === 'Pago'): ?>
                                        <span class="badge bg-success">Pago</span>
                                    <?php elseif ($ronda['pagamento'] === 'Pendente'): ?>
                                        <span class="badge bg-warning">Pendente</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($ronda['pagamento']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($ronda['contato_no_local'])): ?>
                                        <?php echo htmlspecialchars($ronda['contato_no_local']); ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="rondas.php?action=show&id=<?php echo $ronda['id_ronda_periodica']; ?>" 
                                           class="btn btn-sm btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="rondas.php?action=edit&id=<?php echo $ronda['id_ronda_periodica']; ?>" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmarExclusao(<?php echo $ronda['id_ronda_periodica']; ?>)" title="Excluir">
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
                Tem certeza que deseja excluir esta ronda periódica? Esta ação não pode ser desfeita.
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
    document.getElementById('formExclusao').action = 'rondas.php?action=delete';
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

