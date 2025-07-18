<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Atendimento</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="atendimentos.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="atendimentos.php?action=show&id=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-sm btn-outline-info">
                <i class="fas fa-eye me-1"></i>Visualizar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="atendimentos.php?action=update">
    <input type="hidden" name="id" value="<?php echo $atendimento['id_atendimento']; ?>">
    
    <div class="row">
        <div class="col-md-8">
            <!-- Dados Básicos -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Básicos do Atendimento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required
                                       value="<?php echo isset($_SESSION['old_input']['cliente']) ? htmlspecialchars($_SESSION['old_input']['cliente']) : htmlspecialchars($atendimento['cliente']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="servico" class="form-label">Serviço <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="servico" name="servico" required
                                       value="<?php echo isset($_SESSION['old_input']['servico']) ? htmlspecialchars($_SESSION['old_input']['servico']) : htmlspecialchars($atendimento['servico']); ?>"
                                       placeholder="Ex: Vigilância, Segurança, Monitoramento">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="solicitante" class="form-label">Solicitante <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" required
                                       value="<?php echo isset($_SESSION['old_input']['solicitante']) ? htmlspecialchars($_SESSION['old_input']['solicitante']) : htmlspecialchars($atendimento['solicitante']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="motivo" name="motivo" required
                                       value="<?php echo isset($_SESSION['old_input']['motivo']) ? htmlspecialchars($_SESSION['old_input']['motivo']) : htmlspecialchars($atendimento['motivo']); ?>"
                                       placeholder="Ex: Alarme disparado, Ronda preventiva">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status_atendimento" class="form-label">Status do Atendimento</label>
                                <select class="form-select" id="status_atendimento" name="status_atendimento">
                                    <?php 
                                    $statusSelecionado = isset($_SESSION['old_input']['status_atendimento']) ? $_SESSION['old_input']['status_atendimento'] : $atendimento['status_atendimento'];
                                    ?>
                                    <option value="Pendente" <?php echo ($statusSelecionado === 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                                    <option value="Em Andamento" <?php echo ($statusSelecionado === 'Em Andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                                    <option value="Concluído" <?php echo ($statusSelecionado === 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
                                    <option value="Cancelado" <?php echo ($statusSelecionado === 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Localização -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localização do Atendimento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                                       value="<?php echo isset($_SESSION['old_input']['cep']) ? htmlspecialchars($_SESSION['old_input']['cep']) : htmlspecialchars($atendimento['cep']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="2"
                                       value="<?php echo isset($_SESSION['old_input']['estado']) ? htmlspecialchars($_SESSION['old_input']['estado']) : htmlspecialchars($atendimento['estado']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                       value="<?php echo isset($_SESSION['old_input']['cidade']) ? htmlspecialchars($_SESSION['old_input']['cidade']) : htmlspecialchars($atendimento['cidade']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="endereco_do_atendimento" class="form-label">Endereço do Atendimento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="endereco_do_atendimento" name="endereco_do_atendimento" required
                                       value="<?php echo isset($_SESSION['old_input']['endereco_do_atendimento']) ? htmlspecialchars($_SESSION['old_input']['endereco_do_atendimento']) : htmlspecialchars($atendimento['endereco_do_atendimento']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                       value="<?php echo isset($_SESSION['old_input']['numero']) ? htmlspecialchars($_SESSION['old_input']['numero']) : htmlspecialchars($atendimento['numero']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                       value="<?php echo isset($_SESSION['old_input']['latitude']) ? htmlspecialchars($_SESSION['old_input']['latitude']) : htmlspecialchars($atendimento['latitude']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                       value="<?php echo isset($_SESSION['old_input']['longitude']) ? htmlspecialchars($_SESSION['old_input']['longitude']) : htmlspecialchars($atendimento['longitude']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detalhes do Atendimento -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalhes do Atendimento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempo_no_local" class="form-label">Tempo no Local (minutos)</label>
                                <input type="number" class="form-control" id="tempo_no_local" name="tempo_no_local" min="0"
                                       value="<?php echo isset($_SESSION['old_input']['tempo_no_local']) ? htmlspecialchars($_SESSION['old_input']['tempo_no_local']) : htmlspecialchars($atendimento['tempo_no_local']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quilometragem" class="form-label">Quilometragem (km)</label>
                                <input type="number" class="form-control" id="quilometragem" name="quilometragem" min="0" step="0.1"
                                       value="<?php echo isset($_SESSION['old_input']['quilometragem']) ? htmlspecialchars($_SESSION['old_input']['quilometragem']) : htmlspecialchars($atendimento['quilometragem']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao_dos_fatos" class="form-label">Descrição dos Fatos</label>
                        <textarea class="form-control" id="descricao_dos_fatos" name="descricao_dos_fatos" rows="4"
                                  placeholder="Descreva detalhadamente o que aconteceu durante o atendimento..."><?php echo isset($_SESSION['old_input']['descricao_dos_fatos']) ? htmlspecialchars($_SESSION['old_input']['descricao_dos_fatos']) : htmlspecialchars($atendimento['descricao_dos_fatos']); ?></textarea>
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
                               value="<?php echo isset($_SESSION['old_input']['hora_solicitada']) ? $_SESSION['old_input']['hora_solicitada'] : (isset($atendimento['hora_solicitada']) ? date('Y-m-d\TH:i', strtotime($atendimento['hora_solicitada'])) : ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_local" class="form-label">Hora Local</label>
                        <input type="datetime-local" class="form-control" id="hora_local" name="hora_local"
                               value="<?php echo isset($_SESSION['old_input']['hora_local']) ? $_SESSION['old_input']['hora_local'] : (isset($atendimento['hora_local']) ? date('Y-m-d\TH:i', strtotime($atendimento['hora_local'])) : ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_saida" class="form-label">Hora Saída</label>
                        <input type="datetime-local" class="form-control" id="hora_saida" name="hora_saida"
                               value="<?php echo isset($_SESSION['old_input']['hora_saida']) ? $_SESSION['old_input']['hora_saida'] : (isset($atendimento['hora_saida']) ? date('Y-m-d\TH:i', strtotime($atendimento['hora_saida'])) : ''); ?>">
                    </div>
                </div>
            </div>
            
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
                        <a href="atendimentos.php?action=show&id=<?php echo $atendimento['id_atendimento']; ?>" class="btn btn-outline-info">
                            <i class="fas fa-eye me-1"></i>Visualizar
                        </a>
                        <a href="atendimentos.php" class="btn btn-secondary">
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
                        document.getElementById('endereco_do_atendimento').value = data.logradouro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    }
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
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

// Validação de coordenadas
function validarCoordenada(campo, tipo) {
    campo.addEventListener('blur', function(e) {
        const valor = parseFloat(e.target.value);
        if (e.target.value && isNaN(valor)) {
            e.target.classList.add('is-invalid');
            if (!document.getElementById(tipo + '-error')) {
                const error = document.createElement('div');
                error.id = tipo + '-error';
                error.className = 'invalid-feedback';
                error.textContent = 'Coordenada inválida';
                e.target.parentNode.appendChild(error);
            }
        } else {
            e.target.classList.remove('is-invalid');
            const error = document.getElementById(tipo + '-error');
            if (error) error.remove();
        }
    });
}

validarCoordenada(document.getElementById('latitude'), 'latitude');
validarCoordenada(document.getElementById('longitude'), 'longitude');

// Obter localização atual
function obterLocalizacao() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
            document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
        });
    }
}

// Adicionar botão para obter localização
const latitudeField = document.getElementById('latitude');
if (latitudeField) {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-outline-secondary btn-sm mt-1';
    button.innerHTML = '<i class="fas fa-map-marker-alt me-1"></i>Obter Localização';
    button.onclick = obterLocalizacao;
    latitudeField.parentNode.appendChild(button);
}
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

