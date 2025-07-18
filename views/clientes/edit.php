<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Cliente</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="clientes.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="clientes.php?action=show&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-sm btn-outline-info">
                <i class="fas fa-eye me-1"></i>Visualizar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="clientes.php?action=update">
    <input type="hidden" name="id" value="<?php echo $cliente['id_cliente']; ?>">
    
    <div class="row">
        <div class="col-md-8">
            <!-- Dados da Empresa -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados da Empresa</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="razao_social" class="form-label">Razão Social <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="razao_social" name="razao_social" required
                                       value="<?php echo isset($_SESSION['old_input']['razao_social']) ? htmlspecialchars($_SESSION['old_input']['razao_social']) : htmlspecialchars($cliente['razao_social']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cnpj" class="form-label">CNPJ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" required maxlength="18"
                                       value="<?php echo isset($_SESSION['old_input']['cnpj']) ? htmlspecialchars($_SESSION['old_input']['cnpj']) : htmlspecialchars($cliente['cnpj']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                                <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"
                                       value="<?php echo isset($_SESSION['old_input']['nome_fantasia']) ? htmlspecialchars($_SESSION['old_input']['nome_fantasia']) : htmlspecialchars($cliente['nome_fantasia']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <?php 
                                    $statusSelecionado = isset($_SESSION['old_input']['status']) ? $_SESSION['old_input']['status'] : $cliente['status'];
                                    ?>
                                    <option value="Ativo" <?php echo ($statusSelecionado === 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                                    <option value="Inativo" <?php echo ($statusSelecionado === 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                                    <option value="Suspenso" <?php echo ($statusSelecionado === 'Suspenso') ? 'selected' : ''; ?>>Suspenso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inscricao_estadual" class="form-label">Inscrição Estadual</label>
                                <input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual"
                                       value="<?php echo isset($_SESSION['old_input']['inscricao_estadual']) ? htmlspecialchars($_SESSION['old_input']['inscricao_estadual']) : htmlspecialchars($cliente['inscricao_estadual']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inscricao_municipal" class="form-label">Inscrição Municipal</label>
                                <input type="text" class="form-control" id="inscricao_municipal" name="inscricao_municipal"
                                       value="<?php echo isset($_SESSION['old_input']['inscricao_municipal']) ? htmlspecialchars($_SESSION['old_input']['inscricao_municipal']) : htmlspecialchars($cliente['inscricao_municipal']); ?>">
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
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telefone_1" class="form-label">Telefone Principal</label>
                                <input type="text" class="form-control" id="telefone_1" name="telefone_1"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_1']) ? htmlspecialchars($_SESSION['old_input']['telefone_1']) : htmlspecialchars($cliente['telefone_1']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telefone_2" class="form-label">Telefone Secundário</label>
                                <input type="text" class="form-control" id="telefone_2" name="telefone_2"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_2']) ? htmlspecialchars($_SESSION['old_input']['telefone_2']) : htmlspecialchars($cliente['telefone_2']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="<?php echo isset($_SESSION['old_input']['email']) ? htmlspecialchars($_SESSION['old_input']['email']) : htmlspecialchars($cliente['email']); ?>">
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
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                                       value="<?php echo isset($_SESSION['old_input']['cep']) ? htmlspecialchars($_SESSION['old_input']['cep']) : htmlspecialchars($cliente['cep']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="2"
                                       value="<?php echo isset($_SESSION['old_input']['estado']) ? htmlspecialchars($_SESSION['old_input']['estado']) : htmlspecialchars($cliente['estado']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                       value="<?php echo isset($_SESSION['old_input']['cidade']) ? htmlspecialchars($_SESSION['old_input']['cidade']) : htmlspecialchars($cliente['cidade']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco"
                                       value="<?php echo isset($_SESSION['old_input']['endereco']) ? htmlspecialchars($_SESSION['old_input']['endereco']) : htmlspecialchars($cliente['endereco']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                       value="<?php echo isset($_SESSION['old_input']['numero']) ? htmlspecialchars($_SESSION['old_input']['numero']) : htmlspecialchars($cliente['numero']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento"
                                       value="<?php echo isset($_SESSION['old_input']['complemento']) ? htmlspecialchars($_SESSION['old_input']['complemento']) : htmlspecialchars($cliente['complemento']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro"
                                       value="<?php echo isset($_SESSION['old_input']['bairro']) ? htmlspecialchars($_SESSION['old_input']['bairro']) : htmlspecialchars($cliente['bairro']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pessoa de Contato -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Pessoa de Contato</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="pessoa_contato" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="pessoa_contato" name="pessoa_contato"
                                       value="<?php echo isset($_SESSION['old_input']['pessoa_contato']) ? htmlspecialchars($_SESSION['old_input']['pessoa_contato']) : htmlspecialchars($cliente['pessoa_contato']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="telefone_contato" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone_contato" name="telefone_contato"
                                       value="<?php echo isset($_SESSION['old_input']['telefone_contato']) ? htmlspecialchars($_SESSION['old_input']['telefone_contato']) : htmlspecialchars($cliente['telefone_contato']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email_contato" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email_contato" name="email_contato"
                                       value="<?php echo isset($_SESSION['old_input']['email_contato']) ? htmlspecialchars($_SESSION['old_input']['email_contato']) : htmlspecialchars($cliente['email_contato']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Observações -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Observações</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"
                                  placeholder="Observações gerais sobre o cliente..."><?php echo isset($_SESSION['old_input']['observacoes']) ? htmlspecialchars($_SESSION['old_input']['observacoes']) : htmlspecialchars($cliente['observacoes']); ?></textarea>
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
                        <a href="clientes.php?action=show&id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-outline-info">
                            <i class="fas fa-eye me-1"></i>Visualizar
                        </a>
                        <a href="clientes.php" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
// Limpar dados antigos da sessão
if (isset($_SESSION['old_input'])) {
    unset($_SESSION['old_input']);
}
?>

<script>
// Máscara para CNPJ
document.getElementById('cnpj').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 14) {
        value = value.replace(/(\d{2})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1/$2');
        value = value.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
        e.target.value = value;
    }
});

// Validação de CNPJ
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, '');
    if (cnpj.length !== 14) return false;
    
    if (/^(\d)\1{13}$/.test(cnpj)) return false;
    
    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    
    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;
    
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    return resultado == digitos.charAt(1);
}

document.getElementById('cnpj').addEventListener('blur', function(e) {
    if (e.target.value && !validarCNPJ(e.target.value)) {
        e.target.classList.add('is-invalid');
        if (!document.getElementById('cnpj-error')) {
            const error = document.createElement('div');
            error.id = 'cnpj-error';
            error.className = 'invalid-feedback';
            error.textContent = 'CNPJ inválido';
            e.target.parentNode.appendChild(error);
        }
    } else {
        e.target.classList.remove('is-invalid');
        const error = document.getElementById('cnpj-error');
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

mascaraTelefone(document.getElementById('telefone_1'));
mascaraTelefone(document.getElementById('telefone_2'));
mascaraTelefone(document.getElementById('telefone_contato'));

// Máscara para CEP
document.getElementById('cep').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length <= 8) {
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    }
});

// Buscar endereço pelo CEP
document.getElementById('cep').addEventListener('blur', function(e) {
    const cep = e.target.value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    if (confirm('Deseja preencher o endereço automaticamente com os dados do CEP?')) {
                        document.getElementById('endereco').value = data.logradouro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                        document.getElementById('bairro').value = data.bairro;
                    }
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
    }
});

// Contador de caracteres para observações
document.getElementById('observacoes').addEventListener('input', function(e) {
    const maxLength = 1000;
    const currentLength = e.target.value.length;
    
    if (currentLength > maxLength) {
        e.target.value = e.target.value.substring(0, maxLength);
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

