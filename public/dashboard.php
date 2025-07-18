<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../models/AgenteModel.php';
require_once __DIR__ . '/../models/AtendimentoModel.php';
require_once __DIR__ . '/../models/OcorrenciaVeicularModel.php';
require_once __DIR__ . '/../models/VigilanciaVeicularModel.php';
require_once __DIR__ . '/../models/RondaPeriodicaModel.php';
require_once __DIR__ . '/../models/TabelaPrestadorModel.php';

// Verificar se usuário está logado
requireLogin();

// Obter estatísticas
$totalClientes = ClienteModel::count();
$totalAgentes = AgenteModel::count();
$totalAtendimentos = AtendimentoModel::count();
$totalOcorrencias = OcorrenciaVeicularModel::count();
$totalVigilancias = VigilanciaVeicularModel::count();
$totalRondas = RondaPeriodicaModel::count();
$totalPrestadores = TabelaPrestadorModel::count();


$title = 'Dashboard - Sistema de Ocorrências';
?>
<?php include __DIR__ . '/../views/includes/header.php'; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-calendar me-1"></i><?php echo date('d/m/Y'); ?>
            </button>
        </div>
    </div>
</div>

<!-- Cards de Estatísticas -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Clientes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalClientes; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Agentes</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAgentes; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Atendimentos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAtendimentos; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-headset fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Ocorrências</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalOcorrencias; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Segunda linha de cards -->
<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Vigilância Veicular</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalVigilancias; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Rondas Periódicas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalRondas; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-route fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isAdmin()): ?>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Prestadores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalPrestadores; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-handshake fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Gráficos e Tabelas -->
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Visão Geral do Sistema</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Distribuição por Módulo</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ações Rápidas -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ações Rápidas</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <a href="clientes.php?action=create" class="btn btn-primary btn-block">
                            <i class="fas fa-plus me-2"></i>Novo Cliente
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="agentes.php?action=create" class="btn btn-success btn-block">
                            <i class="fas fa-user-plus me-2"></i>Novo Agente
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="atendimentos.php?action=create" class="btn btn-info btn-block">
                            <i class="fas fa-headset me-2"></i>Novo Atendimento
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="relatorios.php" class="btn btn-warning btn-block">
                            <i class="fas fa-chart-bar me-2"></i>Relatórios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Gráfico de área
const ctx = document.getElementById('myAreaChart').getContext('2d');
const myAreaChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Atendimentos',
            data: [10, 20, 15, 25, 30, 35],
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            borderColor: 'rgba(78, 115, 223, 1)',
            borderWidth: 2,
            fill: true
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Gráfico de pizza
const ctx2 = document.getElementById('myPieChart').getContext('2d');
const myPieChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Clientes', 'Agentes', 'Atendimentos', 'Ocorrências'],
        datasets: [{
            data: [<?php echo $totalClientes; ?>, <?php echo $totalAgentes; ?>, <?php echo $totalAtendimentos; ?>, <?php echo $totalOcorrencias; ?>],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e']
        }]
    },
    options: {
        responsive: true
    }
});
</script>

<?php include __DIR__ . '/../views/includes/footer.php'; ?>

