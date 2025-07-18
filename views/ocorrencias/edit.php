<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Editar Ocorrência Veicular</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="ocorrencias.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
            <a href="ocorrencias.php?action=show&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" class="btn btn-sm btn-outline-info">
                <i class="fas fa-eye me-1"></i>Visualizar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="ocorrencias.php?action=update">
    <input type="hidden" name="id" value="<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>">
    
    <div class="row">
        <div class="col-md-8">
            <!-- Dados Básicos -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dados Básicos da Ocorrência</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cliente" class="form-label">Cliente <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cliente" name="cliente" required
                                       value="<?php echo isset($_SESSION['old_input']['cliente']) ? htmlspecialchars($_SESSION['old_input']['cliente']) : htmlspecialchars($ocorrencia['cliente']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="servico" class="form-label">Serviço <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="servico" name="servico" required
                                       value="<?php echo isset($_SESSION['old_input']['servico']) ? htmlspecialchars($_SESSION['old_input']['servico']) : htmlspecialchars($ocorrencia['servico']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="solicitante" class="form-label">Solicitante <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" required
                                       value="<?php echo isset($_SESSION['old_input']['solicitante']) ? htmlspecialchars($_SESSION['old_input']['solicitante']) : htmlspecialchars($ocorrencia['solicitante']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="motivo" name="motivo" required
                                       value="<?php echo isset($_SESSION['old_input']['motivo']) ? htmlspecialchars($_SESSION['old_input']['motivo']) : htmlspecialchars($ocorrencia['motivo']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tipo_de_ocorrencia" class="form-label">Tipo de Ocorrência <span class="text-danger">*</span></label>
                                <select class="form-select" id="tipo_de_ocorrencia" name="tipo_de_ocorrencia" required>
                                    <option value="">Selecione o tipo</option>
                                    <?php 
                                    $tipoSelecionado = isset($_SESSION['old_input']['tipo_de_ocorrencia']) ? $_SESSION['old_input']['tipo_de_ocorrencia'] : $ocorrencia['tipo_de_ocorrencia'];
                                    ?>
                                    <option value="Acidente" <?php echo ($tipoSelecionado === 'Acidente') ? 'selected' : ''; ?>>Acidente</option>
                                    <option value="Roubo" <?php echo ($tipoSelecionado === 'Roubo') ? 'selected' : ''; ?>>Roubo</option>
                                    <option value="Furto" <?php echo ($tipoSelecionado === 'Furto') ? 'selected' : ''; ?>>Furto</option>
                                    <option value="Avaria" <?php echo ($tipoSelecionado === 'Avaria') ? 'selected' : ''; ?>>Avaria</option>
                                    <option value="Outros" <?php echo ($tipoSelecionado === 'Outros') ? 'selected' : ''; ?>>Outros</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="numero_bo" class="form-label">Número do B.O.</label>
                                <input type="text" class="form-control" id="numero_bo" name="numero_bo"
                                       value="<?php echo isset($_SESSION['old_input']['numero_bo']) ? htmlspecialchars($_SESSION['old_input']['numero_bo']) : htmlspecialchars($ocorrencia['numero_bo']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Localização -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localização da Ocorrência</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9"
                                       value="<?php echo isset($_SESSION['old_input']['cep']) ? htmlspecialchars($_SESSION['old_input']['cep']) : htmlspecialchars($ocorrencia['cep']); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="2"
                                       value="<?php echo isset($_SESSION['old_input']['estado']) ? htmlspecialchars($_SESSION['old_input']['estado']) : htmlspecialchars($ocorrencia['estado']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade"
                                       value="<?php echo isset($_SESSION['old_input']['cidade']) ? htmlspecialchars($_SESSION['old_input']['cidade']) : htmlspecialchars($ocorrencia['cidade']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="endereco_da_ocorrencia" class="form-label">Endereço da Ocorrência <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="endereco_da_ocorrencia" name="endereco_da_ocorrencia" required
                                       value="<?php echo isset($_SESSION['old_input']['endereco_da_ocorrencia']) ? htmlspecialchars($_SESSION['old_input']['endereco_da_ocorrencia']) : htmlspecialchars($ocorrencia['endereco_da_ocorrencia']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero"
                                       value="<?php echo isset($_SESSION['old_input']['numero']) ? htmlspecialchars($_SESSION['old_input']['numero']) : htmlspecialchars($ocorrencia['numero']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="latitude"
                                       value="<?php echo isset($_SESSION['old_input']['latitude']) ? htmlspecialchars($_SESSION['old_input']['latitude']) : htmlspecialchars($ocorrencia['latitude']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="longitude"
                                       value="<?php echo isset($_SESSION['old_input']['longitude']) ? htmlspecialchars($_SESSION['old_input']['longitude']) : htmlspecialchars($ocorrencia['longitude']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detalhes da Ocorrência -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detalhes da Ocorrência</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempo_no_local" class="form-label">Tempo no Local (minutos)</label>
                                <input type="number" class="form-control" id="tempo_no_local" name="tempo_no_local" min="0"
                                       value="<?php echo isset($_SESSION['old_input']['tempo_no_local']) ? htmlspecialchars($_SESSION['old_input']['tempo_no_local']) : htmlspecialchars($ocorrencia['tempo_no_local']); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quilometragem" class="form-label">Quilometragem</label>
                                <input type="number" class="form-control" id="quilometragem" name="quilometragem" min="0" step="0.1"
                                       value="<?php echo isset($_SESSION['old_input']['quilometragem']) ? htmlspecialchars($_SESSION['old_input']['quilometragem']) : htmlspecialchars($ocorrencia['quilometragem']); ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descricao_dos_fatos" class="form-label">Descrição dos Fatos</label>
                        <textarea class="form-control" id="descricao_dos_fatos" name="descricao_dos_fatos" rows="4"
                                  placeholder="Descreva detalhadamente o que aconteceu..."><?php echo isset($_SESSION['old_input']['descricao_dos_fatos']) ? htmlspecialchars($_SESSION['old_input']['descricao_dos_fatos']) : htmlspecialchars($ocorrencia['descricao_dos_fatos']); ?></textarea>
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
                               value="<?php echo isset($_SESSION['old_input']['hora_solicitada']) ? $_SESSION['old_input']['hora_solicitada'] : (isset($ocorrencia['hora_solicitada']) ? date('Y-m-d\TH:i', strtotime($ocorrencia['hora_solicitada'])) : ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_local" class="form-label">Hora Local</label>
                        <input type="datetime-local" class="form-control" id="hora_local" name="hora_local"
                               value="<?php echo isset($_SESSION['old_input']['hora_local']) ? $_SESSION['old_input']['hora_local'] : (isset($ocorrencia['hora_local']) ? date('Y-m-d\TH:i', strtotime($ocorrencia['hora_local'])) : ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="hora_saida" class="form-label">Hora Saída</label>
                        <input type="datetime-local" class="form-control" id="hora_saida" name="hora_saida"
                               value="<?php echo isset($_SESSION['old_input']['hora_saida']) ? $_SESSION['old_input']['hora_saida'] : (isset($ocorrencia['hora_saida']) ? date('Y-m-d\TH:i', strtotime($ocorrencia['hora_saida'])) : ''); ?>">
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
                        <a href="ocorrencias.php?action=show&id=<?php echo $ocorrencia['id_ocorrencia_veicular']; ?>" class="btn btn-outline-info">
                            <i class="fas fa-eye me-1"></i>Visualizar
                        </a>
                        <a href="ocorrencias.php" class="btn btn-secondary">
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
                        document.getElementById('endereco_da_ocorrencia').value = data.logradouro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    }
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

