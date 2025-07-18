<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/export.php';

// Verificar se usuário está logado
if (!isLoggedIn()) {
    redirect('login.php');
}

// Processar exportação
if (isset($_GET['export'])) {
    $type = $_GET['export'];
    $format = $_GET['format'] ?? 'pdf';
    
    switch ($type) {
        case 'clientes':
            exportClientes($format);
            break;
        case 'agentes':
            exportAgentes($format);
            break;
        case 'atendimentos':
            exportAtendimentos($format);
            break;
        case 'ocorrencias':
            exportOcorrencias($format);
            break;
        case 'vigilancias':
            exportVigilancias($format);
            break;
        case 'rondas':
            exportRondas($format);
            break;
        case 'prestadores':
            if (isAdmin()) {
                exportPrestadores($format);
            } else {
                $_SESSION['error'] = 'Acesso negado.';
                redirect('relatorios.php');
            }
            break;
        default:
            $_SESSION['error'] = 'Tipo de relatório inválido.';
            redirect('relatorios.php');
    }
}

$title = 'Relatórios - Sistema de Ocorrências';
?>
<?php include __DIR__ . '/../views/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Relatórios</h1>
</div>

<div class="row">
    <!-- Clientes -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-building fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Clientes</h5>
                <p class="card-text">Relatório completo de todos os clientes cadastrados no sistema.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=clientes&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=clientes&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Agentes -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x text-success mb-3"></i>
                <h5 class="card-title">Agentes</h5>
                <p class="card-text">Relatório de todos os agentes cadastrados e suas informações.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=agentes&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=agentes&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Atendimentos -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-headset fa-3x text-info mb-3"></i>
                <h5 class="card-title">Atendimentos</h5>
                <p class="card-text">Relatório detalhado de todos os atendimentos realizados.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=atendimentos&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=atendimentos&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Ocorrências Veiculares -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <h5 class="card-title">Ocorrências Veiculares</h5>
                <p class="card-text">Relatório de todas as ocorrências veiculares registradas.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=ocorrencias&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=ocorrencias&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Vigilância Veicular -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-eye fa-3x text-secondary mb-3"></i>
                <h5 class="card-title">Vigilância Veicular</h5>
                <p class="card-text">Relatório de vigilância veicular e monitoramento.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=vigilancias&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=vigilancias&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Rondas Periódicas -->
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-route fa-3x text-dark mb-3"></i>
                <h5 class="card-title">Rondas Periódicas</h5>
                <p class="card-text">Relatório de rondas periódicas e inspeções realizadas.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=rondas&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=rondas&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Prestadores (apenas para admin) -->
    <?php if (isAdmin()): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="fas fa-handshake fa-3x text-danger mb-3"></i>
                <h5 class="card-title">Prestadores</h5>
                <p class="card-text">Relatório de prestadores de serviços e dados bancários.</p>
                <div class="btn-group" role="group">
                    <a href="relatorios.php?export=prestadores&format=pdf" class="btn btn-danger btn-sm">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="relatorios.php?export=prestadores&format=excel" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="alert alert-info mt-4">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Informações:</strong>
    <ul class="mb-0 mt-2">
        <li>Os relatórios em PDF são ideais para impressão e apresentação.</li>
        <li>Os relatórios em Excel permitem análise e manipulação dos dados.</li>
        <li>Todos os relatórios incluem data e hora de geração.</li>
        <?php if (isAdmin()): ?>
        <li>O relatório de Prestadores contém informações bancárias sensíveis - disponível apenas para administradores.</li>
        <?php endif; ?>
    </ul>
</div>

<?php include __DIR__ . '/../views/includes/footer.php'; ?>

