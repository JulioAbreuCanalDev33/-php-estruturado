<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportToPDF($data, $title, $headers, $filename = null) {
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', true);
    
    $dompdf = new Dompdf($options);
    
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { font-family: Arial, sans-serif; font-size: 12px; }
            .header { text-align: center; margin-bottom: 30px; }
            .title { font-size: 18px; font-weight: bold; color: #2c5aa0; }
            .date { font-size: 10px; color: #666; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
            th { background-color: #2c5aa0; color: white; font-weight: bold; }
            tr:nth-child(even) { background-color: #f9f9f9; }
            .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; }
        </style>
    </head>
    <body>
        <div class="header">
            <div class="title">' . $title . '</div>
            <div class="date">Gerado em: ' . date('d/m/Y H:i:s') . '</div>
        </div>
        
        <table>
            <thead>
                <tr>';
    
    foreach ($headers as $header) {
        $html .= '<th>' . htmlspecialchars($header) . '</th>';
    }
    
    $html .= '</tr>
            </thead>
            <tbody>';
    
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td>' . htmlspecialchars($cell ?? '') . '</td>';
        }
        $html .= '</tr>';
    }
    
    $html .= '</tbody>
        </table>
        
        <div class="footer">
            Sistema de Ocorrências Veiculares - Relatório gerado automaticamente
        </div>
    </body>
    </html>';
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    
    $filename = $filename ?: 'relatorio_' . date('Y-m-d_H-i-s') . '.pdf';
    
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    echo $dompdf->output();
    exit;
}

function exportToExcel($data, $title, $headers, $filename = null) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    // Título
    $sheet->setCellValue('A1', $title);
    $sheet->mergeCells('A1:' . chr(64 + count($headers)) . '1');
    $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
    
    // Data
    $sheet->setCellValue('A2', 'Gerado em: ' . date('d/m/Y H:i:s'));
    $sheet->mergeCells('A2:' . chr(64 + count($headers)) . '2');
    $sheet->getStyle('A2')->getFont()->setSize(10);
    $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
    
    // Cabeçalhos
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '4', $header);
        $sheet->getStyle($col . '4')->getFont()->setBold(true);
        $sheet->getStyle($col . '4')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('2c5aa0');
        $sheet->getStyle($col . '4')->getFont()->getColor()->setRGB('FFFFFF');
        $col++;
    }
    
    // Dados
    $row = 5;
    foreach ($data as $dataRow) {
        $col = 'A';
        foreach ($dataRow as $cell) {
            $sheet->setCellValue($col . $row, $cell ?? '');
            $col++;
        }
        $row++;
    }
    
    // Auto-ajustar colunas
    foreach (range('A', chr(64 + count($headers))) as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    // Bordas
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    $sheet->getStyle('A4:' . chr(64 + count($headers)) . ($row - 1))->applyFromArray($styleArray);
    
    $filename = $filename ?: 'relatorio_' . date('Y-m-d_H-i-s') . '.xlsx';
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

function exportClientes($format = 'pdf') {
    require_once __DIR__ . '/../models/ClienteModel.php';
    
    $clientes = ClienteModel::getAll();
    $headers = ['ID', 'Nome da Empresa', 'CNPJ', 'Contato', 'Telefone', 'Endereço'];
    $data = [];
    
    foreach ($clientes as $cliente) {
        $data[] = [
            $cliente['id_cliente'],
            $cliente['nome_empresa'],
            $cliente['cnpj'],
            $cliente['contato'],
            $cliente['telefone'],
            $cliente['endereco']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Clientes', $headers, 'clientes.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Clientes', $headers, 'clientes.pdf');
    }
}

function exportAgentes($format = 'pdf') {
    require_once __DIR__ . '/../models/AgenteModel.php';
    
    $agentes = AgenteModel::getAll();
    $headers = ['ID', 'Nome', 'Função', 'Status'];
    $data = [];
    
    foreach ($agentes as $agente) {
        $data[] = [
            $agente['id_agente'],
            $agente['nome'],
            $agente['funcao'],
            $agente['status']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Agentes', $headers, 'agentes.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Agentes', $headers, 'agentes.pdf');
    }
}

function exportAtendimentos($format = 'pdf') {
    require_once __DIR__ . '/../models/AtendimentoModel.php';
    
    $atendimentos = AtendimentoModel::getAll();
    $headers = ['ID', 'Solicitante', 'Cliente', 'Agente', 'Status', 'Hora Local'];
    $data = [];
    
    foreach ($atendimentos as $atendimento) {
        $data[] = [
            $atendimento['id_atendimento'],
            $atendimento['solicitante'],
            $atendimento['nome_empresa'] ?? 'N/A',
            $atendimento['nome_agente'] ?? 'N/A',
            $atendimento['status_atendimento'],
            $atendimento['hora_local']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Atendimentos', $headers, 'atendimentos.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Atendimentos', $headers, 'atendimentos.pdf');
    }
}

function exportOcorrencias($format = 'pdf') {
    require_once __DIR__ . '/../models/OcorrenciaVeicularModel.php';
    
    $ocorrencias = OcorrenciaVeicularModel::getAll();
    $headers = ['ID', 'Cliente', 'Solicitante', 'Tipo', 'Data/Hora Evento', 'Status'];
    $data = [];
    
    foreach ($ocorrencias as $ocorrencia) {
        $data[] = [
            $ocorrencia['id'],
            $ocorrencia['cliente'],
            $ocorrencia['solicitante'],
            $ocorrencia['tipo_de_ocorrencia'],
            $ocorrencia['data_hora_evento'],
            'Ativo'
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Ocorrências Veiculares', $headers, 'ocorrencias.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Ocorrências Veiculares', $headers, 'ocorrencias.pdf');
    }
}

function exportVigilancias($format = 'pdf') {
    require_once __DIR__ . '/../models/VigilanciaVeicularModel.php';
    
    $vigilancias = VigilanciaVeicularModel::getAll();
    $headers = ['ID', 'Placa', 'Marca', 'Modelo', 'Condutor', 'Status'];
    $data = [];
    
    foreach ($vigilancias as $vigilancia) {
        $data[] = [
            $vigilancia['id'],
            $vigilancia['placa'],
            $vigilancia['marca'],
            $vigilancia['modelo'],
            $vigilancia['nome_do_condutor'],
            $vigilancia['status_do_atendimento']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Vigilância Veicular', $headers, 'vigilancias.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Vigilância Veicular', $headers, 'vigilancias.pdf');
    }
}

function exportRondas($format = 'pdf') {
    require_once __DIR__ . '/../models/RondaPeriodicaModel.php';
    
    $rondas = RondaPeriodicaModel::getAll();
    $headers = ['ID', 'Atendimento', 'Quantidade Rondas', 'Data Final', 'Contato Local'];
    $data = [];
    
    foreach ($rondas as $ronda) {
        $data[] = [
            $ronda['id_ronda'],
            $ronda['solicitante'] ?? 'N/A',
            $ronda['quantidade_rondas'],
            $ronda['data_final'],
            $ronda['contato_no_local']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Rondas Periódicas', $headers, 'rondas.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Rondas Periódicas', $headers, 'rondas.pdf');
    }
}

function exportPrestadores($format = 'pdf') {
    require_once __DIR__ . '/../models/TabelaPrestadorModel.php';
    
    $prestadores = TabelaPrestadorModel::getAll();
    $headers = ['ID', 'Nome', 'CNPJ', 'Telefone', 'Banco', 'Agência', 'Conta'];
    $data = [];
    
    foreach ($prestadores as $prestador) {
        $data[] = [
            $prestador['id_prestador'],
            $prestador['nome_prestador'],
            $prestador['cnpj_prestador'],
            $prestador['telefone_prestador'],
            $prestador['codigo_do_banco'],
            $prestador['agencia_prestadores'],
            $prestador['conta_prestadores']
        ];
    }
    
    if ($format === 'excel') {
        exportToExcel($data, 'Relatório de Prestadores', $headers, 'prestadores.xlsx');
    } else {
        exportToPDF($data, 'Relatório de Prestadores', $headers, 'prestadores.pdf');
    }
}
?>

