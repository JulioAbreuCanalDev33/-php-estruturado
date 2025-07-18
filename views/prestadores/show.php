<?php include __DIR__ . '/../includes/header.php'; ?>

<?php if (!isAdmin()): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Acesso Negado</strong><br>
        Apenas administradores podem visualizar prestadores de serviço.
    </div>
    <a href="dashboard.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Voltar ao Dashboard
    </a>
<?php else: ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes do Prestador</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="prestadores.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="prestadores.php?action=edit&id=<?php echo $prestador['id_prestador']; ?>" class="btn btn-sm btn-outline-warning">
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
        <!-- Dados Pessoais -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados Pessoais</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID do Prestador:</strong><br>
                        <span class="text-muted"><?php echo $prestador['id_prestador']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Nome Completo:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['nome_prestador']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>CPF:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['cpf_prestador']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Serviço Prestado:</strong><br>
                        <span class="badge bg-info fs-6"><?php echo htmlspecialchars($prestador['servico_prestador']); ?></span>
                    </div>
                </div>
                <?php if (!empty($prestador['email_prestador'])): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Email:</strong><br>
                        <a href="mailto:<?php echo htmlspecialchars($prestador['email_prestador']); ?>" class="text-muted">
                            <?php echo htmlspecialchars($prestador['email_prestador']); ?>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Informações de Contato -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Informações de Contato</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($prestador['telefone_1_prestador'])): ?>
                    <div class="col-md-6">
                        <strong>Telefone Principal:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['telefone_1_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($prestador['telefone_2_prestador'])): ?>
                    <div class="col-md-6">
                        <strong>Telefone Secundário:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['telefone_2_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (empty($prestador['telefone_1_prestador']) && empty($prestador['telefone_2_prestador'])): ?>
                <div class="text-muted text-center">
                    <i class="fas fa-phone fa-2x mb-2"></i><br>
                    Nenhum telefone cadastrado
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Endereço -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Endereço</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($prestador['endereco_prestador']) || !empty($prestador['cidade_prestador'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço Completo:</strong><br>
                        <span class="text-muted">
                            <?php if (!empty($prestador['endereco_prestador'])): ?>
                                <?php echo htmlspecialchars($prestador['endereco_prestador']); ?>
                                <?php if (!empty($prestador['numero_prestador'])): ?>
                                    , <?php echo htmlspecialchars($prestador['numero_prestador']); ?>
                                <?php endif; ?>
                                <?php if (!empty($prestador['complemento_prestador'])): ?>
                                    - <?php echo htmlspecialchars($prestador['complemento_prestador']); ?>
                                <?php endif; ?>
                                <br>
                            <?php endif; ?>
                            <?php if (!empty($prestador['bairro_prestador'])): ?>
                                <?php echo htmlspecialchars($prestador['bairro_prestador']); ?> - 
                            <?php endif; ?>
                            <?php if (!empty($prestador['cidade_prestador'])): ?>
                                <?php echo htmlspecialchars($prestador['cidade_prestador']); ?>
                                <?php if (!empty($prestador['estado_prestador'])): ?>
                                    - <?php echo htmlspecialchars($prestador['estado_prestador']); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($prestador['cep_prestador'])): ?>
                                <br>CEP: <?php echo htmlspecialchars($prestador['cep_prestador']); ?>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
                <?php else: ?>
                <div class="text-muted text-center">
                    <i class="fas fa-map-marker-alt fa-2x mb-2"></i><br>
                    Nenhum endereço cadastrado
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Dados Bancários -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados Bancários</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($prestador['banco_prestador']) || !empty($prestador['pix_prestador'])): ?>
                <div class="row">
                    <?php if (!empty($prestador['banco_prestador'])): ?>
                    <div class="col-md-4">
                        <strong>Banco:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['banco_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($prestador['agencia_prestador'])): ?>
                    <div class="col-md-4">
                        <strong>Agência:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['agencia_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($prestador['conta_prestador'])): ?>
                    <div class="col-md-4">
                        <strong>Conta:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['conta_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($prestador['tipo_conta_prestador']) || !empty($prestador['pix_prestador'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($prestador['tipo_conta_prestador'])): ?>
                    <div class="col-md-6">
                        <strong>Tipo de Conta:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['tipo_conta_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($prestador['pix_prestador'])): ?>
                    <div class="col-md-6">
                        <strong>Chave PIX:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($prestador['pix_prestador']); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <div class="text-muted text-center">
                    <i class="fas fa-university fa-2x mb-2"></i><br>
                    Nenhum dado bancário cadastrado
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Ações Rápidas -->
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Ações Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="prestadores.php?action=edit&id=<?php echo $prestador['id_prestador']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Prestador
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <?php if (!empty($prestador['email_prestador'])): ?>
                    <a href="mailto:<?php echo htmlspecialchars($prestador['email_prestador']); ?>" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-envelope me-1"></i>Enviar Email
                    </a>
                    <?php endif; ?>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Prestador
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
                <p>Tem certeza que deseja excluir este prestador de serviço?</p>
                <p><strong>Nome:</strong> <?php echo htmlspecialchars($prestador['nome_prestador']); ?></p>
                <p><strong>Serviço:</strong> <?php echo htmlspecialchars($prestador['servico_prestador']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="prestadores.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $prestador['id_prestador']; ?>">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<script>
function confirmarExclusao() {
    new bootstrap.Modal(document.getElementById('modalExclusao')).show();
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

