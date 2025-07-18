<?php

require_once __DIR__ . '/../includes/database.php';

class ClienteModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT * FROM clientes ORDER BY nome_empresa";
        $result = $conn->query($sql);
        $clientes = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }
        
        $conn->close();
        return $clientes;
    }
    
    public static function getById($id_cliente) {
        $conn = connectDB();
        $sql = "SELECT * FROM clientes WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        $result = $stmt->get_result();
        $cliente = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $cliente;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO clientes (nome_empresa, cnpj, contato, endereco, telefone) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss",
            $data['nome_empresa'],
            $data['cnpj'],
            $data['contato'],
            $data['endereco'],
            $data['telefone']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id_cliente, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE clientes SET nome_empresa = ?, cnpj = ?, contato = ?, endereco = ?, telefone = ? WHERE id_cliente = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi",
            $data['nome_empresa'],
            $data['cnpj'],
            $data['contato'],
            $data['endereco'],
            $data['telefone'],
            $id_cliente
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id_cliente) {
        $conn = connectDB();
        $sql = "DELETE FROM clientes WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM clientes";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
}
?>

