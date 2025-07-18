<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Novo Atendimento</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="atendimentos.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<form method="POST" action="atendimentos.php?action=store">
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
                                <label for="solicitante" class="form-label">Solicitante <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="solicitante" name="solicitante" required
                                       value="<?php echo isset($_SESSION['old_input']['solicitante']) ? htmlspecialchars($_SESSION['old_input']['solicitante']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="motivo" name="motivo" required
                                       value="<?php echo isset($_SESSION['old_input']['motivo']) ? htmlspecialchars($_SESSION['old_input']['motivo']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_cliente" class="form-label">Cliente <span class="text-danger">*</span></label>
                                <select class="form-select" id="id_cliente" name="id_cliente" required>
                                    <option value="">Selecione o cliente</option>
                                    <?php foreach ($clientes as $cliente): ?>
                                        <option value="<?php echo $cliente['id_cliente']; ?>" 
                                                <?php echo (isset($_SESSION['old_input']['id_cliente']) && $_SESSION['old_input']['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cliente['nome_empresa']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="valor_patrimonial" class="form-label">Valor Patrimonial</label>
                                <input type="text" class="form-control" id="valor_patrimonial" name="valor_patrimonial"
                                       value="<?php echo isset($_SESSION['old_input']['valor_patrimonial']) ? htmlspecialchars($_SESSION['old_input']['valor_patrimonial']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="conta" class="form-label">Conta</label>
                                <input type="text" class="form-control" id="conta" name="conta"
                                       value="<?php echo isset($_SESSION['old_input']['conta']) ? htmlspecialchars($_SESSION['old_input']['conta']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="id_validacao" class="form-label">ID Validação</label>
                                <input type="text" class="form-control" id="id_validacao" name="id_validacao"
                                       value="<?php echo isset($_SESSION['old_input']['id_validacao']) ? htmlspecialchars($_SESSION['old_input']['id_validacao']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="filial" class="form-label">Filial</label>
                                <input type="text" class="form-control" id="filial" name="filial"
                                       value="<?php echo isset($_SESSION['old_input']['filial']) ? htmlspecialchars($_SESSION['old_input']['filial']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Localização -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Localização</h5>
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
                                <label for="endereco" class="form-label">Endereço <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="endereco" name="endereco" required
                                       value="<?php echo isset($_SESSION['old_input']['endereco']) ? htmlspecialchars($_SESSION['old_input']['endereco']) : ''; ?>">
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
            
            <!-- Equipe e Responsáveis -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Equipe e Responsáveis</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_agente" class="form-label">Agente</label>
                                <select class="form-select" id="id_agente" name="id_agente">
                                    <option value="">Selecione o agente</option>
                                    <?php foreach ($agentes as $agente): ?>
                                        <option value="<?php echo $agente['id_agente']; ?>" 
                                                <?php echo (isset($_SESSION['old_input']['id_agente']) && $_SESSION['old_input']['id_agente'] == $agente['id_agente']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($agente['nome']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="agentes_aptos" class="form-label">Agentes Aptos</label>
                                <input type="text" class="form-control" id="agentes_aptos" name="agentes_aptos"
                                       value="<?php echo isset($_SESSION['old_input']['agentes_aptos']) ? htmlspecialchars($_SESSION['old_input']['agentes_aptos']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="equipe" class="form-label">Equipe</label>
                                <input type="text" class="form-control" id="equipe" name="equipe"
                                       value="<?php echo isset($_SESSION['old_input']['equipe']) ? htmlspecialchars($_SESSION['old_input']['equipe']) : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="responsavel" class="form-label">Responsável</label>
                                <input type="text" class="form-control" id="responsavel" name="responsavel"
                                       value="<?php echo isset($_SESSION['old_input']['responsavel']) ? htmlspecialchars($_SESSION['old_input']['responsavel']) : ''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Status e Configurações -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Status e Configurações</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="status_atendimento" class="form-label">Status do Atendimento</label>
                        <select class="form-select" id="status_atendimento" name="status_atendimento">
                            <option value="Em andamento" <?php echo (isset($_SESSION['old_input']['status_atendimento']) && $_SESSION['old_input']['status_atendimento'] === 'Em andamento') ? 'selected' : 'selected'; ?>>Em andamento</option>
                            <option value="Finalizado" <?php echo (isset($_SESSION['old_input']['status_atendimento']) && $_SESSION['old_input']['status_atendimento'] === 'Finalizado') ? 'selected' : ''; ?>>Finalizado</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tipo_de_servico" class="form-label">Tipo de Serviço</label>
                        <select class="form-select" id="tipo_de_servico" name="tipo_de_servico">
                            <option value="Ronda" <?php echo (isset($_SESSION['old_input']['tipo_de_servico']) && $_SESSION['old_input']['tipo_de_servico'] === 'Ronda') ? 'selected' : 'selected'; ?>>Ronda</option>
                            <option value="Preservação" <?php echo (isset($_SESSION['old_input']['tipo_de_servico']) && $_SESSION['old_input']['tipo_de_servico'] === 'Preservação') ? 'selected' : ''; ?>>Preservação</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="indeterminado" name="indeterminado" value="1"
                                   <?php echo (isset($_SESSION['old_input']['indeterminado']) && $_SESSION['old_input']['indeterminado']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="indeterminado">
                                Tempo Indeterminado
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
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
            
            <!-- Ações -->
            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Salvar Atendimento
                        </button>
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
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                }
            })
            .catch(error => console.log('Erro ao buscar CEP:', error));
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>

