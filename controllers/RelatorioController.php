<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/ClienteModel.php';
require_once __DIR__ . '/../models/AgenteModel.php';
require_once __DIR__ . '/../models/AtendimentoModel.php';
require_once __DIR__ . '/../models/RondaPeriodicaModel.php';
require_once __DIR__ . '/../models/OcorrenciaVeicularModel.php';
require_once __DIR__ . '/../models/VigilanciaVeicularModel.php';
require_once __DIR__ . '/../models/TabelaPrestadorModel.php';

class RelatorioController {
    
    public function index() {
        requireLogin();
        
        $title = 'Relatórios - Sistema de Ocorrências';
        
        // Estatísticas para o dashboard de relatórios
        $stats = [
            'total_clientes' => count(ClienteModel::getAll()),
            'total_agentes' => count(AgenteModel::getAll()),
            'total_atendimentos' => count(AtendimentoModel::getAll()),
            'total_rondas' => count(RondaPeriodicaModel::getAll()),
            'total_ocorrencias' => count(OcorrenciaVeicularModel::getAll()),
            'total_vigilancia' => count(VigilanciaVeicularModel::getAll()),
            'total_prestadores' => count(TabelaPrestadorModel::getAll())
        ];
        
        include __DIR__ . '/../views/relatorios/index.php';
    }
    
    public function export() {
        requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('relatorios.php');
        }
        
        $tipo = $_POST['tipo'] ?? '';
        $formato = $_POST['formato'] ?? 'pdf';
        $data_inicio = $_POST['data_inicio'] ?? '';
        $data_fim = $_POST['data_fim'] ?? '';
        
        try {
            switch ($tipo) {
                case 'clientes':
                    $this->exportClientes($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'agentes':
                    $this->exportAgentes($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'atendimentos':
                    $this->exportAtendimentos($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'rondas':
                    $this->exportRondas($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'ocorrencias':
                    $this->exportOcorrencias($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'vigilancia':
                    $this->exportVigilancia($formato, $data_inicio, $data_fim);
                    break;
                    
                case 'prestadores':
                    $this->exportPrestadores($formato, $data_inicio, $data_fim);
                    break;
                    
                default:
                    $_SESSION['error'] = 'Tipo de relatório inválido';
                    redirect('relatorios.php');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Erro ao gerar relatório: ' . $e->getMessage();
            redirect('relatorios.php');
        }
    }
    
    private function exportClientes($formato, $data_inicio, $data_fim) {
        $clientes = ClienteModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($clientes, 'Relatório de Clientes', [
                'ID' => 'id_cliente',
                'Nome da Empresa' => 'nome_empresa',
                'CNPJ' => 'cnpj',
                'Contato' => 'contato',
                'Telefone' => 'telefone',
                'Endereço' => 'endereco'
            ]);
        } else {
            $this->exportToPDF($clientes, 'Relatório de Clientes', [
                'ID' => 'id_cliente',
                'Nome da Empresa' => 'nome_empresa',
                'CNPJ' => 'cnpj',
                'Contato' => 'contato',
                'Telefone' => 'telefone'
            ]);
        }
    }
    
    private function exportAgentes($formato, $data_inicio, $data_fim) {
        $agentes = AgenteModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($agentes, 'Relatório de Agentes', [
                'ID' => 'id_agente',
                'Nome' => 'nome',
                'Função' => 'funcao',
                'Status' => 'status'
            ]);
        } else {
            $this->exportToPDF($agentes, 'Relatório de Agentes', [
                'ID' => 'id_agente',
                'Nome' => 'nome',
                'Função' => 'funcao',
                'Status' => 'status'
            ]);
        }
    }
    
    private function exportAtendimentos($formato, $data_inicio, $data_fim) {
        $atendimentos = AtendimentoModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($atendimentos, 'Relatório de Atendimentos', [
                'ID' => 'id_atendimento',
                'Solicitante' => 'solicitante',
                'Motivo' => 'motivo',
                'Cliente ID' => 'id_cliente',
                'Endereço' => 'endereco',
                'Status' => 'status_atendimento',
                'Tipo de Serviço' => 'tipo_de_servico'
            ]);
        } else {
            $this->exportToPDF($atendimentos, 'Relatório de Atendimentos', [
                'ID' => 'id_atendimento',
                'Solicitante' => 'solicitante',
                'Motivo' => 'motivo',
                'Status' => 'status_atendimento',
                'Tipo de Serviço' => 'tipo_de_servico'
            ]);
        }
    }
    
    private function exportRondas($formato, $data_inicio, $data_fim) {
        $rondas = RondaPeriodicaModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($rondas, 'Relatório de Rondas Periódicas', [
                'ID' => 'id_ronda_periodica',
                'Atendimento ID' => 'id_atendimento',
                'Quantidade de Rondas' => 'quantidade_rondas',
                'Data Final' => 'data_final',
                'Pagamento' => 'pagamento',
                'Contato no Local' => 'contato_no_local'
            ]);
        } else {
            $this->exportToPDF($rondas, 'Relatório de Rondas Periódicas', [
                'ID' => 'id_ronda_periodica',
                'Atendimento ID' => 'id_atendimento',
                'Quantidade de Rondas' => 'quantidade_rondas',
                'Data Final' => 'data_final',
                'Pagamento' => 'pagamento'
            ]);
        }
    }
    
    private function exportOcorrencias($formato, $data_inicio, $data_fim) {
        $ocorrencias = OcorrenciaVeicularModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($ocorrencias, 'Relatório de Ocorrências Veiculares', [
                'ID' => 'id_ocorrencia_veicular',
                'Cliente' => 'cliente',
                'Serviço' => 'servico',
                'Solicitante' => 'solicitante',
                'Motivo' => 'motivo',
                'Endereço' => 'endereco_da_ocorrencia',
                'Tipo de Ocorrência' => 'tipo_de_ocorrencia'
            ]);
        } else {
            $this->exportToPDF($ocorrencias, 'Relatório de Ocorrências Veiculares', [
                'ID' => 'id_ocorrencia_veicular',
                'Cliente' => 'cliente',
                'Solicitante' => 'solicitante',
                'Motivo' => 'motivo',
                'Tipo de Ocorrência' => 'tipo_de_ocorrencia'
            ]);
        }
    }
    
    private function exportVigilancia($formato, $data_inicio, $data_fim) {
        $vigilancias = VigilanciaVeicularModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($vigilancias, 'Relatório de Vigilância Veicular', [
                'ID' => 'id_vigilancia_veicular',
                'Veículo Recuperado' => 'veiculo_foi_recuperado',
                'Condutor é Proprietário' => 'condutor_e_proprietario',
                'Placa' => 'placa',
                'Marca' => 'marca',
                'Modelo' => 'modelo',
                'Nome do Condutor' => 'nome_do_condutor',
                'Status' => 'status_do_atendimento'
            ]);
        } else {
            $this->exportToPDF($vigilancias, 'Relatório de Vigilância Veicular', [
                'ID' => 'id_vigilancia_veicular',
                'Placa' => 'placa',
                'Marca' => 'marca',
                'Modelo' => 'modelo',
                'Nome do Condutor' => 'nome_do_condutor',
                'Status' => 'status_do_atendimento'
            ]);
        }
    }
    
    private function exportPrestadores($formato, $data_inicio, $data_fim) {
        $prestadores = TabelaPrestadorModel::getAll();
        
        if ($formato === 'excel') {
            $this->exportToExcel($prestadores, 'Relatório de Prestadores', [
                'ID' => 'id_prestador',
                'Nome' => 'nome_prestador',
                'Serviço' => 'servico_prestador',
                'CPF' => 'cpf_prestador',
                'Email' => 'email_prestador',
                'Telefone' => 'telefone_1_prestador',
                'Cidade' => 'cidade_prestador',
                'Estado' => 'estado_prestador'
            ]);
        } else {
            $this->exportToPDF($prestadores, 'Relatório de Prestadores', [
                'ID' => 'id_prestador',
                'Nome' => 'nome_prestador',
                'Serviço' => 'servico_prestador',
                'Email' => 'email_prestador',
                'Cidade' => 'cidade_prestador'
            ]);
        }
    }
    
    private function exportToExcel($data, $title, $columns) {
        // Cabeçalhos para download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $this->sanitizeFilename($title) . '_' . date('Y-m-d_H-i-s') . '.xls"');
        header('Cache-Control: max-age=0');
        
        // Início do arquivo Excel
        echo "\xEF\xBB\xBF"; // BOM para UTF-8
        echo "<table border='1'>";
        
        // Cabeçalho
        echo "<tr style='background-color: #4472C4; color: white; font-weight: bold;'>";
        echo "<td colspan='" . count($columns) . "' style='text-align: center; font-size: 16px; padding: 10px;'>$title</td>";
        echo "</tr>";
        
        echo "<tr style='background-color: #D9E2F3; font-weight: bold;'>";
        foreach ($columns as $header => $field) {
            echo "<td style='padding: 8px;'>$header</td>";
        }
        echo "</tr>";
        
        // Dados
        foreach ($data as $row) {
            echo "<tr>";
            foreach ($columns as $header => $field) {
                $value = isset($row[$field]) ? htmlspecialchars($row[$field]) : '';
                echo "<td style='padding: 5px;'>$value</td>";
            }
            echo "</tr>";
        }
        
        echo "</table>";
        
        // Rodapé
        echo "<br><p style='font-size: 12px; color: #666;'>";
        echo "Relatório gerado em: " . date('d/m/Y H:i:s') . "<br>";
        echo "Total de registros: " . count($data) . "<br>";
        echo "Sistema de Ocorrências";
        echo "</p>";
        
        exit;
    }
    
    private function exportToPDF($data, $title, $columns) {
        // Cabeçalhos para download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $this->sanitizeFilename($title) . '_' . date('Y-m-d_H-i-s') . '.pdf"');
        header('Cache-Control: max-age=0');
        
        // HTML para PDF (usando uma biblioteca simples de HTML para PDF)
        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>' . $title . '</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .title { font-size: 24px; font-weight: bold; color: #2c3e50; margin-bottom: 10px; }
                .subtitle { font-size: 14px; color: #7f8c8d; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th { background-color: #3498db; color: white; padding: 12px; text-align: left; }
                td { padding: 8px; border-bottom: 1px solid #ecf0f1; }
                tr:nth-child(even) { background-color: #f8f9fa; }
                .footer { margin-top: 30px; font-size: 12px; color: #7f8c8d; text-align: center; }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="title">' . $title . '</div>
                <div class="subtitle">Sistema de Ocorrências</div>
                <div class="subtitle">Gerado em: ' . date('d/m/Y H:i:s') . '</div>
            </div>
            
            <table>
                <thead>
                    <tr>';
        
        foreach ($columns as $header => $field) {
            $html .= '<th>' . $header . '</th>';
        }
        
        $html .= '</tr>
                </thead>
                <tbody>';
        
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($columns as $header => $field) {
                $value = isset($row[$field]) ? htmlspecialchars($row[$field]) : '';
                $html .= '<td>' . $value . '</td>';
            }
            $html .= '</tr>';
        }
        
        $html .= '</tbody>
            </table>
            
            <div class="footer">
                <p>Total de registros: ' . count($data) . '</p>
                <p>Sistema de Ocorrências - Relatório Automatizado</p>
            </div>
        </body>
        </html>';
        
        // Para uma implementação simples, vamos usar DomPDF ou similar
        // Por enquanto, vamos converter HTML para PDF usando uma abordagem básica
        
        // Salvar HTML temporariamente e converter
        $tempFile = tempnam(sys_get_temp_dir(), 'relatorio_') . '.html';
        file_put_contents($tempFile, $html);
        
        // Usar wkhtmltopdf se disponível, senão retornar HTML
        if (shell_exec('which wkhtmltopdf')) {
            $pdfFile = tempnam(sys_get_temp_dir(), 'relatorio_') . '.pdf';
            shell_exec("wkhtmltopdf $tempFile $pdfFile");
            
            if (file_exists($pdfFile)) {
                readfile($pdfFile);
                unlink($tempFile);
                unlink($pdfFile);
            } else {
                // Fallback para HTML
                header('Content-Type: text/html; charset=UTF-8');
                echo $html;
            }
        } else {
            // Fallback para HTML
            header('Content-Type: text/html; charset=UTF-8');
            echo $html;
        }
        
        unlink($tempFile);
        exit;
    }
    
    private function sanitizeFilename($filename) {
        return preg_replace('/[^a-zA-Z0-9\-_]/', '_', $filename);
    }
}

?>

