<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Vigilância Veicular</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="vigilancia.php?action=create" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i>Nova Vigilância
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista de Vigilância Veicular</h5>
    </div>
    <div class="card-body">
        <?php if (empty($vigilancias)): ?>
            <div class="text-center py-4">
                <i class="fas fa-shield-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhuma vigilância cadastrada</h5>
                <p class="text-muted">Clique no botão "Nova Vigilância" para adicionar a primeira vigilância veicular.</p>
                <a href="vigilancia.php?action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nova Vigilância
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Solicitante</th>
                            <th>Placa do Veículo</th>
                            <th>Endereço</th>
                            <th>Status</th>
                            <th>Valor</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vigilancias as $vigilancia): ?>
                            <tr>
                                <td><?php echo $vigilancia['id_vigilancia_veicular']; ?></td>
                                <td><?php echo htmlspecialchars($vigilancia['cliente']); ?></td>
                                <td><?php echo htmlspecialchars($vigilancia['solicitante']); ?></td>
                                <td>
                                    <span class="badge bg-dark"><?php echo htmlspecialchars($vigilancia['placa_do_veiculo']); ?></span>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($vigilancia['endereco_da_vigilancia']); ?>
                                    <?php if (!empty($vigilancia['numero'])): ?>
                                        , <?php echo htmlspecialchars($vigilancia['numero']); ?>
                                    <?php endif; ?>
                                    <?php if (!empty($vigilancia['cidade'])): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($vigilancia['cidade']); ?> - <?php echo htmlspecialchars($vigilancia['estado']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($vigilancia['status_vigilancia'] === 'Ativa'): ?>
                                        <span class="badge bg-success">Ativa</span>
                                    <?php elseif ($vigilancia['status_vigilancia'] === 'Finalizada'): ?>
                                        <span class="badge bg-secondary">Finalizada</span>
                                    <?php elseif ($vigilancia['status_vigilancia'] === 'Pausada'): ?>
                                        <span class="badge bg-warning">Pausada</span>
                                    <?php else: ?>
                                        <span class="badge bg-info"><?php echo htmlspecialchars($vigilancia['status_vigilancia']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($vigilancia['valor_vigilancia'])): ?>
                                        R$ <?php echo number_format($vigilancia['valor_vigilancia'], 2, ',', '.'); ?>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="vigilancia.php?action=show&id=<?php echo $vigilancia['id_vigilancia_veicular']; ?>" 
                                           class="btn btn-sm btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="vigilancia.php?action=edit&id=<?php echo $vigilancia['id_vigilancia_veicular']; ?>" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmarExclusao(<?php echo $vigilancia['id_vigilancia_veicular']; ?>)" title="Excluir">
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
                Tem certeza que deseja excluir esta vigilância veicular? Esta ação não pode ser desfeita.
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
    document.getElementById('formExclusao').action = 'vigilancia.php?action=delete';
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

