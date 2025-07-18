<?php $title = 'Clientes - Sistema de Ocorrências'; ?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Clientes</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="clientes.php?action=create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Novo Cliente
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Empresa</th>
                        <th>CNPJ</th>
                        <th>Contato</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Nenhum cliente encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?php echo $cliente['id_cliente']; ?></td>
                                <td><?php echo htmlspecialchars($cliente['nome_empresa']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['cnpj']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['contato']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="clientes.php?action=show&id=<?php echo $cliente['id_cliente']; ?>" 
                                           class="btn btn-sm btn-outline-primary" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="clientes.php?action=edit&id=<?php echo $cliente['id_cliente']; ?>" 
                                           class="btn btn-sm btn-outline-secondary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="clientes.php?action=delete&id=<?php echo $cliente['id_cliente']; ?>" 
                                           class="btn btn-sm btn-outline-danger" title="Excluir"
                                           onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>

