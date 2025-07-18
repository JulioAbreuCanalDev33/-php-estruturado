<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ocorrências Veiculares</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="ocorrencias.php?action=create" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i>Nova Ocorrência
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Lista de Ocorrências Veiculares</h5>
    </div>
    <div class="card-body">
        <?php if (empty($ocorrencias)): ?>
            <div class="text-center py-4">
                <i class="fas fa-car-crash fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhuma ocorrência cadastrada</h5>
                <p class="text-muted">Clique no botão "Nova Ocorrência" para adicionar a primeira ocorrência.</p>
                <a href="ocorrencias.php?action=create" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nova Ocorrência
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
                            <th>Motivo</th>
                            <th>Endereço</th>
                            <th>Tipo de Ocorrência</th>
                            <th width="200">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ocorrencias as $ocorrencia): ?>
                            <tr>
                                <td><?php echo $ocorrencia['id_ocorrencia_veicular']; ?></td>
                                <td><?php echo htmlspecialchars($ocorrencia['cliente']); ?></td>
                                <td><?php echo htmlspecialchars($ocorrencia['solicitante']); ?></td>
                                <td><?php echo htmlspecialchars($ocorrencia['motivo']); ?></td>
                                <td>
                                    <?php echo htmlspecialchars($ocorrencia['endereco_da_ocorrencia']); ?>
                                    <?php if (!empty($ocorrencia['numero'])): ?>
                                        , <?php echo htmlspecialchars($ocorrencia['numero']); ?>
                                    <?php endif; ?>
                                    <?php if (!empty($ocorrencia['cidade'])): ?>
                                        <br><small class="text-muted"><?php echo htmlspecialchars($ocorrencia['cidade']); ?> - <?php echo htmlspecialchars($ocorrencia['estado']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($ocorrencia['tipo_de_ocorrencia'] === 'Acidente'): ?>
                                        <span class="badge bg-danger">Acidente</span>
                                    <?php elseif ($ocorrencia['tipo_de_ocorrencia'] === 'Roubo'): ?>
                                        <span class="badge bg-warning">Roubo</span>
                                    <?php elseif ($ocorrencia['tipo_de_ocorrencia'] === 'Furto'): ?>
                                        <span class="badge bg-info">Furto</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo htmlspecialchars($ocorrencia['tipo_de_ocorrencia']); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="ocorrencias.php?action=show&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" 
                                           class="btn btn-sm btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="ocorrencias.php?action=edit&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" 
                                           class="btn btn-sm btn-outline-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="confirmarExclusao(<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>)" title="Excluir">
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
                Tem certeza que deseja excluir esta ocorrência? Esta ação não pode ser desfeita.
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
    document.getElementById('formExclusao').action = 'ocorrencias.php?action=delete';
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

