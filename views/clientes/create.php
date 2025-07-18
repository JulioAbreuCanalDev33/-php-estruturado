<?php $title = 'Novo Cliente - Sistema de Ocorrências'; ?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Novo Cliente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="clientes.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome_empresa" class="form-label">Nome da Empresa *</label>
                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" 
                               value="<?php echo $_POST['nome_empresa'] ?? ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ *</label>
                        <input type="text" class="form-control cnpj-mask" id="cnpj" name="cnpj" 
                               value="<?php echo $_POST['cnpj'] ?? ''; ?>" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="contato" class="form-label">Contato *</label>
                        <input type="text" class="form-control" id="contato" name="contato" 
                               value="<?php echo $_POST['contato'] ?? ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control phone-mask" id="telefone" name="telefone" 
                               value="<?php echo $_POST['telefone'] ?? ''; ?>">
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <textarea class="form-control" id="endereco" name="endereco" rows="3"><?php echo $_POST['endereco'] ?? ''; ?></textarea>
            </div>
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Salvar
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>

