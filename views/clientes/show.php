<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Detalhes do Cliente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="clientes.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="clientes.php?action=edit&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-outline-warning">
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
        <!-- Dados da Empresa -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Dados da Empresa</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>ID do Cliente:</strong><br>
                        <span class="text-muted"><?php echo $cliente['id_cliente']; ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>Razão Social:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['razao_social']); ?></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nome Fantasia:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['nome_fantasia']); ?></span>
                    </div>
                    <div class="col-md-6">
                        <strong>CNPJ:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['cnpj']); ?></span>
                    </div>
                </div>
                <?php if (!empty($cliente['inscricao_estadual']) || !empty($cliente['inscricao_municipal'])): ?>
                <hr>
                <div class="row">
                    <?php if (!empty($cliente['inscricao_estadual'])): ?>
                    <div class="col-md-6">
                        <strong>Inscrição Estadual:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['inscricao_estadual']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($cliente['inscricao_municipal'])): ?>
                    <div class="col-md-6">
                        <strong>Inscrição Municipal:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['inscricao_municipal']); ?></span>
                    </div>
                    <?php endif; ?>
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
                    <?php if (!empty($cliente['telefone_1'])): ?>
                    <div class="col-md-4">
                        <strong>Telefone Principal:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['telefone_1']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($cliente['telefone_2'])): ?>
                    <div class="col-md-4">
                        <strong>Telefone Secundário:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['telefone_2']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($cliente['email'])): ?>
                    <div class="col-md-4">
                        <strong>Email:</strong><br>
                        <a href="mailto:<?php echo htmlspecialchars($cliente['email']); ?>" class="text-muted">
                            <?php echo htmlspecialchars($cliente['email']); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if (empty($cliente['telefone_1']) && empty($cliente['telefone_2']) && empty($cliente['email'])): ?>
                <div class="text-muted text-center">
                    <i class="fas fa-phone fa-2x mb-2"></i><br>
                    Nenhuma informação de contato cadastrada
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
                <?php if (!empty($cliente['endereco']) || !empty($cliente['cidade'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <strong>Endereço Completo:</strong><br>
                        <span class="text-muted">
                            <?php if (!empty($cliente['endereco'])): ?>
                                <?php echo htmlspecialchars($cliente['endereco']); ?>
                                <?php if (!empty($cliente['numero'])): ?>
                                    , <?php echo htmlspecialchars($cliente['numero']); ?>
                                <?php endif; ?>
                                <?php if (!empty($cliente['complemento'])): ?>
                                    - <?php echo htmlspecialchars($cliente['complemento']); ?>
                                <?php endif; ?>
                                <br>
                            <?php endif; ?>
                            <?php if (!empty($cliente['bairro'])): ?>
                                <?php echo htmlspecialchars($cliente['bairro']); ?> - 
                            <?php endif; ?>
                            <?php if (!empty($cliente['cidade'])): ?>
                                <?php echo htmlspecialchars($cliente['cidade']); ?>
                                <?php if (!empty($cliente['estado'])): ?>
                                    - <?php echo htmlspecialchars($cliente['estado']); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($cliente['cep'])): ?>
                                <br>CEP: <?php echo htmlspecialchars($cliente['cep']); ?>
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
        
        <!-- Pessoa de Contato -->
        <?php if (!empty($cliente['pessoa_contato']) || !empty($cliente['telefone_contato']) || !empty($cliente['email_contato'])): ?>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Pessoa de Contato</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (!empty($cliente['pessoa_contato'])): ?>
                    <div class="col-md-4">
                        <strong>Nome:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['pessoa_contato']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($cliente['telefone_contato'])): ?>
                    <div class="col-md-4">
                        <strong>Telefone:</strong><br>
                        <span class="text-muted"><?php echo htmlspecialchars($cliente['telefone_contato']); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($cliente['email_contato'])): ?>
                    <div class="col-md-4">
                        <strong>Email:</strong><br>
                        <a href="mailto:<?php echo htmlspecialchars($cliente['email_contato']); ?>" class="text-muted">
                            <?php echo htmlspecialchars($cliente['email_contato']); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Observações -->
        <?php if (!empty($cliente['observacoes'])): ?>
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Observações</h5>
            </div>
            <div class="card-body">
                <div style="white-space: pre-wrap;"><?php echo htmlspecialchars($cliente['observacoes']); ?></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <div class="col-md-4">
        <!-- Status -->
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Status do Cliente</h6>
            </div>
            <div class="card-body text-center">
                <?php if ($cliente['status'] === 'Ativo'): ?>
                    <span class="badge bg-success fs-5">Ativo</span>
                <?php elseif ($cliente['status'] === 'Inativo'): ?>
                    <span class="badge bg-secondary fs-5">Inativo</span>
                <?php elseif ($cliente['status'] === 'Suspenso'): ?>
                    <span class="badge bg-warning fs-5">Suspenso</span>
                <?php else: ?>
                    <span class="badge bg-info fs-5"><?php echo htmlspecialchars($cliente['status']); ?></span>
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
                    <a href="clientes.php?action=edit&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Editar Cliente
                    </a>
                    
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="window.print()">
                        <i class="fas fa-print me-1"></i>Imprimir Detalhes
                    </button>
                    
                    <?php if (!empty($cliente['email'])): ?>
                    <a href="mailto:<?php echo htmlspecialchars($cliente['email']); ?>" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-envelope me-1"></i>Enviar Email
                    </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($cliente['email_contato'])): ?>
                    <a href="mailto:<?php echo htmlspecialchars($cliente['email_contato']); ?>" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-envelope me-1"></i>Email Contato
                    </a>
                    <?php endif; ?>
                    
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmarExclusao()">
                        <i class="fas fa-trash me-1"></i>Excluir Cliente
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
                <p>Tem certeza que deseja excluir este cliente?</p>
                <p><strong>Razão Social:</strong> <?php echo htmlspecialchars($cliente['razao_social']); ?></p>
                <p><strong>CNPJ:</strong> <?php echo htmlspecialchars($cliente['cnpj']); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="clientes.php?action=delete" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
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

