<?php include __DIR__ . '/../includes/header.php'; ?>

<?php if (!isAdmin()): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>Acesso Negado</strong><br>
        Apenas administradores podem editar prestadores de serviço.
    </div>
    <a href="dashboard.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Voltar ao Dashboard
    </a>
<?php else: ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Prestador de Serviço</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="prestadores.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="prestadores.php?action=show&id=<?php echo $prestador['id_prestador']; ?>" class="btn btn-sm btn-outline-info">
                <i class="fas fa-eye me-1"></i>Visualizar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="prestadores.php?action=update">
    <input type="hidden" name="id" value="<?php echo $prestador['id_prestador']; ?>">
    
    <div class="row">
        <div class="col-md-8">
            <!-- Dados Pessoais -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Pessoais</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nome_prestador" class="form-label">Nome Completo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome_prestador" name="nome_prestador" required
                                       value="<?php echo isset($_SESSION['old_input']['nome_prestador']) ? htmlspecialchars($_SESSION['old_input']['nome_prestador']) : htmlspecialchars($prestador['nome_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cpf_prestador" class="form-label">CPF <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cpf_prestador" name="cpf_prestador" required maxlength="14"
                                       value="<?php echo isset($_SESSION['old_input']['cpf_prestador']) ? htmlspecialchars($_SESSION['old_input']['cpf_prestador']) : htmlspecialchars($prestador['cpf_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="servico_prestador" class="form-label">Serviço Prestado <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="servico_prestador" name="servico_prestador" required
                                       value="<?php echo isset($_SESSION['old_input']['servico_prestador']) ? htmlspecialchars($_SESSION['old_input']['servico_prestador']) : htmlspecialchars($prestador['servico_prestador']); ?>"
                                       placeholder="Ex: Vigilância, Segurança, Monitoramento">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email_prestador" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_prestador" name="email_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['email_prestador']) ? htmlspecialchars($_SESSION['old_input']['email_prestador']) : htmlspecialchars($prestador['email_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contato -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informações de Contato</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefone_1_prestador" class="form-label">Telefone Principal</label>
                                <input type="text" class="form-control" id="telefone_1_prestador" name="telefone_1_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_1_prestador']) ? htmlspecialchars($_SESSION['old_input']['telefone_1_prestador']) : htmlspecialchars($prestador['telefone_1_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefone_2_prestador" class="form-label">Telefone Secundário</label>
                                <input type="text" class="form-control" id="telefone_2_prestador" name="telefone_2_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_2_prestador']) ? htmlspecialchars($_SESSION['old_input']['telefone_2_prestador']) : htmlspecialchars($prestador['telefone_2_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Endereço -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Endereço</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cep_prestador" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep_prestador" name="cep_prestador" maxlength="9"
                                       value="<?php echo isset($_SESSION['old_input']['cep_prestador']) ? htmlspecialchars($_SESSION['old_input']['cep_prestador']) : htmlspecialchars($prestador['cep_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado_prestador" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado_prestador" name="estado_prestador" maxlength="2"
                                       value="<?php echo isset($_SESSION['old_input']['estado_prestador']) ? htmlspecialchars($_SESSION['old_input']['estado_prestador']) : htmlspecialchars($prestador['estado_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cidade_prestador" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade_prestador" name="cidade_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['cidade_prestador']) ? htmlspecialchars($_SESSION['old_input']['cidade_prestador']) : htmlspecialchars($prestador['cidade_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="endereco_prestador" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco_prestador" name="endereco_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['endereco_prestador']) ? htmlspecialchars($_SESSION['old_input']['endereco_prestador']) : htmlspecialchars($prestador['endereco_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="numero_prestador" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero_prestador" name="numero_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['numero_prestador']) ? htmlspecialchars($_SESSION['old_input']['numero_prestador']) : htmlspecialchars($prestador['numero_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bairro_prestador" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro_prestador" name="bairro_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['bairro_prestador']) ? htmlspecialchars($_SESSION['old_input']['bairro_prestador']) : htmlspecialchars($prestador['bairro_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="complemento_prestador" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complemento_prestador" name="complemento_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['complemento_prestador']) ? htmlspecialchars($_SESSION['old_input']['complemento_prestador']) : htmlspecialchars($prestador['complemento_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dados Bancários -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Bancários</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="banco_prestador" class="form-label">Banco</label>
                                <input type="text" class="form-control" id="banco_prestador" name="banco_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['banco_prestador']) ? htmlspecialchars($_SESSION['old_input']['banco_prestador']) : htmlspecialchars($prestador['banco_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="agencia_prestador" class="form-label">Agência</label>
                                <input type="text" class="form-control" id="agencia_prestador" name="agencia_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['agencia_prestador']) ? htmlspecialchars($_SESSION['old_input']['agencia_prestador']) : htmlspecialchars($prestador['agencia_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="conta_prestador" class="form-label">Conta</label>
                                <input type="text" class="form-control" id="conta_prestador" name="conta_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['conta_prestador']) ? htmlspecialchars($_SESSION['old_input']['conta_prestador']) : htmlspecialchars($prestador['conta_prestador']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pix_prestador" class="form-label">Chave PIX</label>
                                <input type="text" class="form-control" id="pix_prestador" name="pix_prestador"
                                       value="<?php echo isset($_SESSION['old_input']['pix_prestador']) ? htmlspecialchars($_SESSION['old_input']['pix_prestador']) : htmlspecialchars($prestador['pix_prestador']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipo_conta_prestador" class="form-label">Tipo de Conta</label>
                                <select class="form-select" id="tipo_conta_prestador" name="tipo_conta_prestador">
                                    <option value="">Selecione o tipo</option>
                                    <?php 
                                    $tipoSelecionado = isset($_SESSION['old_input']['tipo_conta_prestador']) ? $_SESSION['old_input']['tipo_conta_prestador'] : $prestador['tipo_conta_prestador'];
                                    ?>
                                    <option value="Corrente" <?php echo ($tipoSelecionado === 'Corrente') ? 'selected' : ''; ?>>Conta Corrente</option>
                                    <option value="Poupança" <?php echo ($tipoSelecionado === 'Poupança') ? 'selected' : ''; ?>>Conta Poupança</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Informações -->
            <div class="card mb-3">
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
                        <strong>Atenção</strong><br>
                        Verifique todos os dados antes de salvar as alterações.
                    </div>
                </div>
            </div>
            
            <!-- Ações -->
            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Alterações
                        </button>
                        <a href="prestadores.php?action=show&id=<?php echo $prestador['id_prestador']; ?>" class="btn btn-outline-info">
                            <i class="fas fa-eye me-1"></i>Visualizar
                        </a>
                        <a href="prestadores.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php endif; ?>

<?php 
// Limpar dados antigos da sessão
if (isset($_SESSION['old_input'])) {
    unset($_SESSION['old_input']);
}
?>

<script>
// Máscara para CPF
document.getElementById('cpf_prestador').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 11) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    }
});

// Validação de CPF
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
    
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.charAt(9))) return false;
    
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.charAt(10));
}

document.getElementById('cpf_prestador').addEventListener('blur', function(e) {
    if (e.target.value && !validarCPF(e.target.value)) {
        e.target.classList.add('is-invalid');
        if (!document.getElementById('cpf-error')) {
            const error = document.createElement('div');
            error.id = 'cpf-error';
            error.className = 'invalid-feedback';
            error.textContent = 'CPF inválido';
            e.target.parentNode.appendChild(error);
        }
    } else {
        e.target.classList.remove('is-invalid');
        const error = document.getElementById('cpf-error');
        if (error) error.remove();
    }
});

// Máscara para telefone
function mascaraTelefone(campo) {
    campo.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            if (value.length <= 10) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            } else {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value;
        }
    });
}

mascaraTelefone(document.getElementById('telefone_1_prestador'));
mascaraTelefone(document.getElementById('telefone_2_prestador'));

// Máscara para CEP
document.getElementById('cep_prestador').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 8) {
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    }
});

// Buscar endereço pelo CEP
document.getElementById('cep_prestador').addEventListener('blur', function(e) {
    const cep = e.target.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    if (confirm('Deseja preencher o endereço automaticamente com os dados do CEP?')) {
                        document.getElementById('endereco_prestador').value = data.logradouro;
                        document.getElementById('cidade_prestador').value = data.localidade;
                        document.getElementById('estado_prestador').value = data.uf;
                        document.getElementById('bairro_prestador').value = data.bairro;
                    }
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

