<?php

require_once __DIR__ . '/../includes/database.php';

class OcorrenciaVeicularModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT * FROM ocorrencias_veiculares ORDER BY data_hora_evento DESC";
        $result = $conn->query($sql);
        $ocorrencias = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $ocorrencias[] = $row;
            }
        }
        
        $conn->close();
        return $ocorrencias;
    }
    
    public static function getById($id) {
        $conn = connectDB();
        $sql = "SELECT * FROM ocorrencias_veiculares WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ocorrencia = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $ocorrencia;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO ocorrencias_veiculares (
            cliente, servico, id_validacao, valor_veicular, cep, estado, cidade,
            solicitante, motivo, endereco_da_ocorrencia, número, latitude, longitude,
            agentes_aptos, prestador, equipe, tipo_de_ocorrencia, data_hora_evento,
            data_hora_deslocamento, data_hora_transmissao, data_hora_local,
            data_hora_inicio_atendimento, data_hora_fim_atendimento, franquia_hora,
            franquia_km, km_inicial_atendimento, km_final_atendimento,
            total_horas_atendimento, total_km_percorrido, descricao_fatos, gastos_adicionais
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdsssssssddsssssssssssddddssd",
            $data['cliente'],
            $data['servico'],
            $data['id_validacao'],
            $data['valor_veicular'],
            $data['cep'],
            $data['estado'],
            $data['cidade'],
            $data['solicitante'],
            $data['motivo'],
            $data['endereco_da_ocorrencia'],
            $data['número'],
            $data['latitude'],
            $data['longitude'],
            $data['agentes_aptos'],
            $data['prestador'],
            $data['equipe'],
            $data['tipo_de_ocorrencia'],
            $data['data_hora_evento'],
            $data['data_hora_deslocamento'],
            $data['data_hora_transmissao'],
            $data['data_hora_local'],
            $data['data_hora_inicio_atendimento'],
            $data['data_hora_fim_atendimento'],
            $data['franquia_hora'],
            $data['franquia_km'],
            $data['km_inicial_atendimento'],
            $data['km_final_atendimento'],
            $data['total_horas_atendimento'],
            $data['total_km_percorrido'],
            $data['descricao_fatos'],
            $data['gastos_adicionais']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE ocorrencias_veiculares SET 
            cliente = ?, servico = ?, id_validacao = ?, valor_veicular = ?, cep = ?,
            estado = ?, cidade = ?, solicitante = ?, motivo = ?, endereco_da_ocorrencia = ?,
            número = ?, latitude = ?, longitude = ?, agentes_aptos = ?, prestador = ?,
            equipe = ?, tipo_de_ocorrencia = ?, data_hora_evento = ?, data_hora_deslocamento = ?,
            data_hora_transmissao = ?, data_hora_local = ?, data_hora_inicio_atendimento = ?,
            data_hora_fim_atendimento = ?, franquia_hora = ?, franquia_km = ?,
            km_inicial_atendimento = ?, km_final_atendimento = ?, total_horas_atendimento = ?,
            total_km_percorrido = ?, descricao_fatos = ?, gastos_adicionais = ?
            WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdsssssssddsssssssssssddddssi",
            $data['cliente'],
            $data['servico'],
            $data['id_validacao'],
            $data['valor_veicular'],
            $data['cep'],
            $data['estado'],
            $data['cidade'],
            $data['solicitante'],
            $data['motivo'],
            $data['endereco_da_ocorrencia'],
            $data['número'],
            $data['latitude'],
            $data['longitude'],
            $data['agentes_aptos'],
            $data['prestador'],
            $data['equipe'],
            $data['tipo_de_ocorrencia'],
            $data['data_hora_evento'],
            $data['data_hora_deslocamento'],
            $data['data_hora_transmissao'],
            $data['data_hora_local'],
            $data['data_hora_inicio_atendimento'],
            $data['data_hora_fim_atendimento'],
            $data['franquia_hora'],
            $data['franquia_km'],
            $data['km_inicial_atendimento'],
            $data['km_final_atendimento'],
            $data['total_horas_atendimento'],
            $data['total_km_percorrido'],
            $data['descricao_fatos'],
            $data['gastos_adicionais'],
            $id
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id) {
        $conn = connectDB();
        $sql = "DELETE FROM ocorrencias_veiculares WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM ocorrencias_veiculares";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
}
?>

