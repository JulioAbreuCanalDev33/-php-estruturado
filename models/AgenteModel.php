<?php

require_once __DIR__ . '/../includes/database.php';

class AgenteModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT * FROM agentes ORDER BY nome";
        $result = $conn->query($sql);
        $agentes = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agentes[] = $row;
            }
        }
        
        $conn->close();
        return $agentes;
    }
    
    public static function getById($id_agente) {
        $conn = connectDB();
        $sql = "SELECT * FROM agentes WHERE id_agente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_agente);
        $stmt->execute();
        $result = $stmt->get_result();
        $agente = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $agente;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO agentes (nome, funcao, status) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss",
            $data['nome'],
            $data['funcao'],
            $data['status']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id_agente, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE agentes SET nome = ?, funcao = ?, status = ? WHERE id_agente = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi",
            $data['nome'],
            $data['funcao'],
            $data['status'],
            $id_agente
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id_agente) {
        $conn = connectDB();
        $sql = "DELETE FROM agentes WHERE id_agente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_agente);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM agentes";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
    
    public static function getAtivos() {
        $conn = connectDB();
        $sql = "SELECT * FROM agentes WHERE status = 'Ativo' ORDER BY nome";
        $result = $conn->query($sql);
        $agentes = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agentes[] = $row;
            }
        }
        
        $conn->close();
        return $agentes;
    }
}
?>

