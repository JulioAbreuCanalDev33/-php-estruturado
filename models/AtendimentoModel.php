<?php

require_once __DIR__ . '/../includes/database.php';

class AtendimentoModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT a.*, c.nome_empresa, ag.nome as nome_agente 
                FROM atendimentos a 
                LEFT JOIN clientes c ON a.id_cliente = c.id_cliente 
                LEFT JOIN agentes ag ON a.id_agente = ag.id_agente 
                ORDER BY a.hora_local DESC";
        $result = $conn->query($sql);
        $atendimentos = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $atendimentos[] = $row;
            }
        }
        
        $conn->close();
        return $atendimentos;
    }
    
    public static function getById($id_atendimento) {
        $conn = connectDB();
        $sql = "SELECT a.*, c.nome_empresa, ag.nome as nome_agente 
                FROM atendimentos a 
                LEFT JOIN clientes c ON a.id_cliente = c.id_cliente 
                LEFT JOIN agentes ag ON a.id_agente = ag.id_agente 
                WHERE a.id_atendimento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_atendimento);
        $stmt->execute();
        $result = $stmt->get_result();
        $atendimento = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $atendimento;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO atendimentos (
            solicitante, motivo, valor_patrimonial, id_cliente, conta, id_validacao, filial,
            ordem_servico, cep, estado, cidade, endereco, numero, latitude, longitude,
            agentes_aptos, id_agente, equipe, responsavel, estabelecimento, hora_solicitada,
            hora_local, hora_saida, status_atendimento, tipo_de_servico, tipos_de_dados,
            estabelecida_inicio, estabelecida_fim, indeterminado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdisssssssssddssissssssssssi",
            $data['solicitante'],
            $data['motivo'],
            $data['valor_patrimonial'],
            $data['id_cliente'],
            $data['conta'],
            $data['id_validacao'],
            $data['filial'],
            $data['ordem_servico'],
            $data['cep'],
            $data['estado'],
            $data['cidade'],
            $data['endereco'],
            $data['numero'],
            $data['latitude'],
            $data['longitude'],
            $data['agentes_aptos'],
            $data['id_agente'],
            $data['equipe'],
            $data['responsavel'],
            $data['estabelecimento'],
            $data['hora_solicitada'],
            $data['hora_local'],
            $data['hora_saida'],
            $data['status_atendimento'],
            $data['tipo_de_servico'],
            $data['tipos_de_dados'],
            $data['estabelecida_inicio'],
            $data['estabelecida_fim'],
            $data['indeterminado']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id_atendimento, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE atendimentos SET 
            solicitante = ?, motivo = ?, valor_patrimonial = ?, id_cliente = ?, conta = ?,
            id_validacao = ?, filial = ?, ordem_servico = ?, cep = ?, estado = ?, cidade = ?,
            endereco = ?, numero = ?, latitude = ?, longitude = ?, agentes_aptos = ?,
            id_agente = ?, equipe = ?, responsavel = ?, estabelecimento = ?, hora_solicitada = ?,
            hora_local = ?, hora_saida = ?, status_atendimento = ?, tipo_de_servico = ?,
            tipos_de_dados = ?, estabelecida_inicio = ?, estabelecida_fim = ?, indeterminado = ?
            WHERE id_atendimento = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdissssssssddsisssssssssssii",
            $data['solicitante'],
            $data['motivo'],
            $data['valor_patrimonial'],
            $data['id_cliente'],
            $data['conta'],
            $data['id_validacao'],
            $data['filial'],
            $data['ordem_servico'],
            $data['cep'],
            $data['estado'],
            $data['cidade'],
            $data['endereco'],
            $data['numero'],
            $data['latitude'],
            $data['longitude'],
            $data['agentes_aptos'],
            $data['id_agente'],
            $data['equipe'],
            $data['responsavel'],
            $data['estabelecimento'],
            $data['hora_solicitada'],
            $data['hora_local'],
            $data['hora_saida'],
            $data['status_atendimento'],
            $data['tipo_de_servico'],
            $data['tipos_de_dados'],
            $data['estabelecida_inicio'],
            $data['estabelecida_fim'],
            $data['indeterminado'],
            $id_atendimento
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id_atendimento) {
        $conn = connectDB();
        $sql = "DELETE FROM atendimentos WHERE id_atendimento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_atendimento);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM atendimentos";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
}
?>

