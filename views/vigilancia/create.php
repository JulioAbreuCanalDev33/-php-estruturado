<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Nova Vigilância Veicular</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="vigilancia.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="vigilancia.php?action=store">
    <div class="row">
        <div class="col-md-8">
            <!-- Dados Básicos -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Básicos da Vigilância</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required
                                       value="<?php echo isset($_SESSION['old_input']['cliente']) ? htmlspecialchars($_SESSION['old_input']['cliente']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="servico" class="form-label">Serviço <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="servico" name="servico" required
                                       value="<?php echo isset($_SESSION['old_input']['servico']) ? htmlspecialchars($_SESSION['old_input']['servico']) : ''; ?>"
                                       placeholder="Ex: Vigilância Veicular">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="solicitante" class="form-label">Solicitante <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" required
                                       value="<?php echo isset($_SESSION['old_input']['solicitante']) ? htmlspecialchars($_SESSION['old_input']['solicitante']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="motivo" name="motivo" required
                                       value="<?php echo isset($_SESSION['old_input']['motivo']) ? htmlspecialchars($_SESSION['old_input']['motivo']) : ''; ?>"
                                       placeholder="Ex: Proteção patrimonial">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Dados do Veículo -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados do Veículo</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="placa_do_veiculo" class="form-label">Placa do Veículo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="placa_do_veiculo" name="placa_do_veiculo" required maxlength="8"
                                       value="<?php echo isset($_SESSION['old_input']['placa_do_veiculo']) ? htmlspecialchars($_SESSION['old_input']['placa_do_veiculo']) : ''; ?>"
                                       placeholder="ABC-1234">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="marca_veiculo" class="form-label">Marca do Veículo</label>
                                <input type="text" class="form-control" id="marca_veiculo" name="marca_veiculo"
                                       value="<?php echo isset($_SESSION['old_input']['marca_veiculo']) ? htmlspecialchars($_SESSION['old_input']['marca_veiculo']) : ''; ?>"
                                       placeholder="Ex: Toyota, Honda, Ford">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="modelo_veiculo" class="form-label">Modelo do Veículo</label>
                                <input type="text" class="form-control" id="modelo_veiculo" name="modelo_veiculo"
                                       value="<?php echo isset($_SESSION['old_input']['modelo_veiculo']) ? htmlspecialchars($_SESSION['old_input']['modelo_veiculo']) : ''; ?>"
                                       placeholder="Ex: Corolla, Civic, Focus">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="cor_veiculo" class="form-label">Cor do Veículo</label>
                                <input type="text" class="form-control" id="cor_veiculo" name="cor_veiculo"
                                       value="<?php echo isset($_SESSION['old_input']['cor_veiculo']) ? htmlspecialchars($_SESSION['old_input']['cor_veiculo']) : ''; ?>"
                                       placeholder="Ex: Branco, Preto, Prata">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ano_veiculo" class="form-label">Ano do Veículo</label>
                                <input type="number" class="form-control" id="ano_veiculo" name="ano_veiculo" min="1900" max="2030"
                                       value="<?php echo isset($_SESSION['old_input']['ano_veiculo']) ? htmlspecialchars($_SESSION['old_input']['ano_veiculo']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="chassi_veiculo" class="form-label">Chassi do Veículo</label>
                                <input type="text" class="form-control" id="chassi_veiculo" name="chassi_veiculo" maxlength="17"
                                       value="<?php echo isset($_SESSION['old_input']['chassi_veiculo']) ? htmlspecialchars($_SESSION['old_input']['chassi_veiculo']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Localização da Vigilância -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localização da Vigilância</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                                       value="<?php echo isset($_SESSION['old_input']['cep']) ? htmlspecialchars($_SESSION['old_input']['cep']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="2"
                                       value="<?php echo isset($_SESSION['old_input']['estado']) ? htmlspecialchars($_SESSION['old_input']['estado']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                       value="<?php echo isset($_SESSION['old_input']['cidade']) ? htmlspecialchars($_SESSION['old_input']['cidade']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="endereco_da_vigilancia" class="form-label">Endereço da Vigilância <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="endereco_da_vigilancia" name="endereco_da_vigilancia" required
                                       value="<?php echo isset($_SESSION['old_input']['endereco_da_vigilancia']) ? htmlspecialchars($_SESSION['old_input']['endereco_da_vigilancia']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                       value="<?php echo isset($_SESSION['old_input']['numero']) ? htmlspecialchars($_SESSION['old_input']['numero']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                       value="<?php echo isset($_SESSION['old_input']['latitude']) ? htmlspecialchars($_SESSION['old_input']['latitude']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                       value="<?php echo isset($_SESSION['old_input']['longitude']) ? htmlspecialchars($_SESSION['old_input']['longitude']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detalhes da Vigilância -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalhes da Vigilância</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempo_no_local" class="form-label">Tempo no Local (minutos)</label>
                                <input type="number" class="form-control" id="tempo_no_local" name="tempo_no_local" min="0"
                                       value="<?php echo isset($_SESSION['old_input']['tempo_no_local']) ? htmlspecialchars($_SESSION['old_input']['tempo_no_local']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quilometragem" class="form-label">Quilometragem</label>
                                <input type="number" class="form-control" id="quilometragem" name="quilometragem" min="0" step="0.1"
                                       value="<?php echo isset($_SESSION['old_input']['quilometragem']) ? htmlspecialchars($_SESSION['old_input']['quilometragem']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="valor_vigilancia" class="form-label">Valor da Vigilância (R$)</label>
                                <input type="number" class="form-control" id="valor_vigilancia" name="valor_vigilancia" min="0" step="0.01"
                                       value="<?php echo isset($_SESSION['old_input']['valor_vigilancia']) ? htmlspecialchars($_SESSION['old_input']['valor_vigilancia']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_vigilancia" class="form-label">Status da Vigilância</label>
                                <select class="form-select" id="status_vigilancia" name="status_vigilancia">
                                    <?php 
                                    $statusSelecionado = isset($_SESSION['old_input']['status_vigilancia']) ? $_SESSION['old_input']['status_vigilancia'] : 'Ativa';
                                    ?>
                                    <option value="Ativa" <?php echo ($statusSelecionado === 'Ativa') ? 'selected' : ''; ?>>Ativa</option>
                                    <option value="Pausada" <?php echo ($statusSelecionado === 'Pausada') ? 'selected' : ''; ?>>Pausada</option>
                                    <option value="Finalizada" <?php echo ($statusSelecionado === 'Finalizada') ? 'selected' : ''; ?>>Finalizada</option>
                                    <option value="Cancelada" <?php echo ($statusSelecionado === 'Cancelada') ? 'selected' : ''; ?>>Cancelada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao_dos_fatos" class="form-label">Descrição dos Fatos</label>
                        <textarea class="form-control" id="descricao_dos_fatos" name="descricao_dos_fatos" rows="4"
                                  placeholder="Descreva detalhadamente a situação que motivou a vigilância..."><?php echo isset($_SESSION['old_input']['descricao_dos_fatos']) ? htmlspecialchars($_SESSION['old_input']['descricao_dos_fatos']) : ''; ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Horários -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Horários</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="hora_solicitada" class="form-label">Hora Solicitada</label>
                        <input type="datetime-local" class="form-control" id="hora_solicitada" name="hora_solicitada"
                               value="<?php echo isset($_SESSION['old_input']['hora_solicitada']) ? $_SESSION['old_input']['hora_solicitada'] : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_local" class="form-label">Hora Local</label>
                        <input type="datetime-local" class="form-control" id="hora_local" name="hora_local"
                               value="<?php echo isset($_SESSION['old_input']['hora_local']) ? $_SESSION['old_input']['hora_local'] : ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_saida" class="form-label">Hora Saída</label>
                        <input type="datetime-local" class="form-control" id="hora_saida" name="hora_saida"
                               value="<?php echo isset($_SESSION['old_input']['hora_saida']) ? $_SESSION['old_input']['hora_saida'] : ''; ?>">
                    </div>
                </div>
            </div>
            
            <!-- Informações Adicionais -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Informações Adicionais</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Campos obrigatórios</strong><br>
                        Os campos marcados com <span class="text-danger">*</span> são obrigatórios.
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-shield-alt me-2"></i>
                        <strong>Vigilância Veicular</strong><br>
                        Preencha todos os dados do veículo para melhor identificação.
                    </div>
                </div>
            </div>
            
            <!-- Ações -->
            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Vigilância
                        </button>
                        <a href="vigilancia.php" class="btn btn-secondary">
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
// Máscara para placa de veículo
document.getElementById('placa_do_veiculo').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
    if (value.length <= 7) {
        if (value.length > 3) {
            value = value.replace(/([A-Z]{3})([0-9])/, '$1-$2');
        }
        e.target.value = value;
    }
});

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
                    document.getElementById('endereco_da_vigilancia').value = data.logradouro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
    }
});

// Validação de placa
function validarPlaca(placa) {
    const regex = /^[A-Z]{3}-[0-9]{4}$/;
    return regex.test(placa);
}

document.getElementById('placa_do_veiculo').addEventListener('blur', function(e) {
    if (e.target.value && !validarPlaca(e.target.value)) {
        e.target.classList.add('is-invalid');
        if (!document.getElementById('placa-error')) {
            const error = document.createElement('div');
            error.id = 'placa-error';
            error.className = 'invalid-feedback';
            error.textContent = 'Formato de placa inválido (ex: ABC-1234)';
            e.target.parentNode.appendChild(error);
        }
    } else {
        e.target.classList.remove('is-invalid');
        const error = document.getElementById('placa-error');
        if (error) error.remove();
    }
});

// Contador de caracteres para descrição
document.getElementById('descricao_dos_fatos').addEventListener('input', function(e) {
    const maxLength = 1000;
    const currentLength = e.target.value.length;
    
    if (currentLength > maxLength) {
        e.target.value = e.target.value.substring(0, maxLength);
    }
});

// Validação de ano do veículo
document.getElementById('ano_veiculo').addEventListener('input', function(e) {
    const ano = parseInt(e.target.value);
    const anoAtual = new Date().getFullYear();
    
    if (ano > anoAtual + 1) {
        e.target.value = anoAtual + 1;
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

