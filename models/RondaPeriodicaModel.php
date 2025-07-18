<?php

require_once __DIR__ . '/../includes/database.php';

class RondaPeriodicaModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT r.*, a.solicitante 
                FROM rondas_periodicas r 
                LEFT JOIN atendimentos a ON r.id_atendimento = a.id_atendimento 
                ORDER BY r.data_final DESC";
        $result = $conn->query($sql);
        $rondas = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rondas[] = $row;
            }
        }
        
        $conn->close();
        return $rondas;
    }
    
    public static function getById($id_ronda) {
        $conn = connectDB();
        $sql = "SELECT r.*, a.solicitante 
                FROM rondas_periodicas r 
                LEFT JOIN atendimentos a ON r.id_atendimento = a.id_atendimento 
                WHERE r.id_ronda = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_ronda);
        $stmt->execute();
        $result = $stmt->get_result();
        $ronda = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $ronda;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO rondas_periodicas (
            id_atendimento, quantidade_rondas, data_final, pagamento, contato_no_local,
            nome_local, funcao_local, verificado_fiacao, quadro_eletrico,
            verificado_portas_entradas, local_energizado, sirene_disparada,
            local_violado, observacao
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssssssssss",
            $data['id_atendimento'],
            $data['quantidade_rondas'],
            $data['data_final'],
            $data['pagamento'],
            $data['contato_no_local'],
            $data['nome_local'],
            $data['funcao_local'],
            $data['verificado_fiacao'],
            $data['quadro_eletrico'],
            $data['verificado_portas_entradas'],
            $data['local_energizado'],
            $data['sirene_disparada'],
            $data['local_violado'],
            $data['observacao']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id_ronda, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE rondas_periodicas SET 
            id_atendimento = ?, quantidade_rondas = ?, data_final = ?, pagamento = ?,
            contato_no_local = ?, nome_local = ?, funcao_local = ?, verificado_fiacao = ?,
            quadro_eletrico = ?, verificado_portas_entradas = ?, local_energizado = ?,
            sirene_disparada = ?, local_violado = ?, observacao = ?
            WHERE id_ronda = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissssssssssssi",
            $data['id_atendimento'],
            $data['quantidade_rondas'],
            $data['data_final'],
            $data['pagamento'],
            $data['contato_no_local'],
            $data['nome_local'],
            $data['funcao_local'],
            $data['verificado_fiacao'],
            $data['quadro_eletrico'],
            $data['verificado_portas_entradas'],
            $data['local_energizado'],
            $data['sirene_disparada'],
            $data['local_violado'],
            $data['observacao'],
            $id_ronda
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id_ronda) {
        $conn = connectDB();
        $sql = "DELETE FROM rondas_periodicas WHERE id_ronda = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_ronda);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM rondas_periodicas";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
}
?>

