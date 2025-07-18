<?php

// Rotas do sistema

// Dashboard
$router->get('/dashboard', 'DashboardController', 'index');

// Clientes
$router->get('/clientes', 'ClienteController', 'index');
$router->get('/clientes/create', 'ClienteController', 'create');
$router->post('/clientes/store', 'ClienteController', 'store');
$router->get('/clientes/show', 'ClienteController', 'show');
$router->get('/clientes/edit', 'ClienteController', 'edit');
$router->post('/clientes/update', 'ClienteController', 'update');
$router->post('/clientes/delete', 'ClienteController', 'delete');

// Agentes
$router->get('/agentes', 'AgenteController', 'index');
$router->get('/agentes/create', 'AgenteController', 'create');
$router->post('/agentes/store', 'AgenteController', 'store');
$router->get('/agentes/show', 'AgenteController', 'show');
$router->get('/agentes/edit', 'AgenteController', 'edit');
$router->post('/agentes/update', 'AgenteController', 'update');
$router->post('/agentes/delete', 'AgenteController', 'delete');

// Atendimentos
$router->get('/atendimentos', 'AtendimentoController', 'index');
$router->get('/atendimentos/create', 'AtendimentoController', 'create');
$router->post('/atendimentos/store', 'AtendimentoController', 'store');
$router->get('/atendimentos/show', 'AtendimentoController', 'show');
$router->get('/atendimentos/edit', 'AtendimentoController', 'edit');
$router->post('/atendimentos/update', 'AtendimentoController', 'update');
$router->post('/atendimentos/delete', 'AtendimentoController', 'delete');

// Rondas Periódicas
$router->get('/rondas', 'RondaPeriodicaController', 'index');
$router->get('/rondas/create', 'RondaPeriodicaController', 'create');
$router->post('/rondas/store', 'RondaPeriodicaController', 'store');
$router->get('/rondas/show', 'RondaPeriodicaController', 'show');
$router->get('/rondas/edit', 'RondaPeriodicaController', 'edit');
$router->post('/rondas/update', 'RondaPeriodicaController', 'update');
$router->post('/rondas/delete', 'RondaPeriodicaController', 'delete');

// Ocorrências Veiculares
$router->get('/ocorrencias', 'OcorrenciaVeicularController', 'index');
$router->get('/ocorrencias/create', 'OcorrenciaVeicularController', 'create');
$router->post('/ocorrencias/store', 'OcorrenciaVeicularController', 'store');
$router->get('/ocorrencias/show', 'OcorrenciaVeicularController', 'show');
$router->get('/ocorrencias/edit', 'OcorrenciaVeicularController', 'edit');
$router->post('/ocorrencias/update', 'OcorrenciaVeicularController', 'update');
$router->post('/ocorrencias/delete', 'OcorrenciaVeicularController', 'delete');

// Vigilância Veicular
$router->get('/vigilancia', 'VigilanciaVeicularController', 'index');
$router->get('/vigilancia/create', 'VigilanciaVeicularController', 'create');
$router->post('/vigilancia/store', 'VigilanciaVeicularController', 'store');
$router->get('/vigilancia/show', 'VigilanciaVeicularController', 'show');
$router->get('/vigilancia/edit', 'VigilanciaVeicularController', 'edit');
$router->post('/vigilancia/update', 'VigilanciaVeicularController', 'update');
$router->post('/vigilancia/delete', 'VigilanciaVeicularController', 'delete');

// Prestadores (apenas admin)
$router->get('/prestadores', 'PrestadorController', 'index');
$router->get('/prestadores/create', 'PrestadorController', 'create');
$router->post('/prestadores/store', 'PrestadorController', 'store');
$router->get('/prestadores/show', 'PrestadorController', 'show');
$router->get('/prestadores/edit', 'PrestadorController', 'edit');
$router->post('/prestadores/update', 'PrestadorController', 'update');
$router->post('/prestadores/delete', 'PrestadorController', 'delete');

// Relatórios
$router->get('/relatorios', 'RelatorioController', 'index');
$router->post('/relatorios/export', 'RelatorioController', 'export');

?>

