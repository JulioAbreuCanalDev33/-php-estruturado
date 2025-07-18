<?php

require_once __DIR__ . '/../includes/database.php';

class VigilanciaVeicularModel {
    
    public static function getAll() {
        $conn = connectDB();
        $sql = "SELECT * FROM vigilancia_veicular ORDER BY id DESC";
        $result = $conn->query($sql);
        $vigilancias = [];
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $vigilancias[] = $row;
            }
        }
        
        $conn->close();
        return $vigilancias;
    }
    
    public static function getById($id) {
        $conn = connectDB();
        $sql = "SELECT * FROM vigilancia_veicular WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $vigilancia = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $vigilancia;
    }
    
    public static function create($data) {
        $conn = connectDB();
        
        $sql = "INSERT INTO vigilancia_veicular (
            veiculo_foi_recuperado, condutor_e_proprietario, tipo_de_equipamento_embarcado,
            placa, renavam, cor, marca, modelo, cidade, dados_adicionais_veiculo,
            placa_carreta, renavam_carreta, cor_carreta, marca_carreta, modelo_carreta,
            cidade_carreta, dados_adicionais_carreta, nome_do_condutor, cpf_condutor,
            cnh_condutor, telefone_condutor, status_do_atendimento
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssssssssss",
            $data['veiculo_foi_recuperado'],
            $data['condutor_e_proprietario'],
            $data['tipo_de_equipamento_embarcado'],
            $data['placa'],
            $data['renavam'],
            $data['cor'],
            $data['marca'],
            $data['modelo'],
            $data['cidade'],
            $data['dados_adicionais_veiculo'],
            $data['placa_carreta'],
            $data['renavam_carreta'],
            $data['cor_carreta'],
            $data['marca_carreta'],
            $data['modelo_carreta'],
            $data['cidade_carreta'],
            $data['dados_adicionais_carreta'],
            $data['nome_do_condutor'],
            $data['cpf_condutor'],
            $data['cnh_condutor'],
            $data['telefone_condutor'],
            $data['status_do_atendimento']
        );
        
        $success = $stmt->execute();
        $id = $conn->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $success ? $id : false;
    }
    
    public static function update($id, $data) {
        $conn = connectDB();
        
        $sql = "UPDATE vigilancia_veicular SET 
            veiculo_foi_recuperado = ?, condutor_e_proprietario = ?, tipo_de_equipamento_embarcado = ?,
            placa = ?, renavam = ?, cor = ?, marca = ?, modelo = ?, cidade = ?,
            dados_adicionais_veiculo = ?, placa_carreta = ?, renavam_carreta = ?,
            cor_carreta = ?, marca_carreta = ?, modelo_carreta = ?, cidade_carreta = ?,
            dados_adicionais_carreta = ?, nome_do_condutor = ?, cpf_condutor = ?,
            cnh_condutor = ?, telefone_condutor = ?, status_do_atendimento = ?
            WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssssssssssi",
            $data['veiculo_foi_recuperado'],
            $data['condutor_e_proprietario'],
            $data['tipo_de_equipamento_embarcado'],
            $data['placa'],
            $data['renavam'],
            $data['cor'],
            $data['marca'],
            $data['modelo'],
            $data['cidade'],
            $data['dados_adicionais_veiculo'],
            $data['placa_carreta'],
            $data['renavam_carreta'],
            $data['cor_carreta'],
            $data['marca_carreta'],
            $data['modelo_carreta'],
            $data['cidade_carreta'],
            $data['dados_adicionais_carreta'],
            $data['nome_do_condutor'],
            $data['cpf_condutor'],
            $data['cnh_condutor'],
            $data['telefone_condutor'],
            $data['status_do_atendimento'],
            $id
        );
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function delete($id) {
        $conn = connectDB();
        $sql = "DELETE FROM vigilancia_veicular WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    public static function count() {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) as total FROM vigilancia_veicular";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return $row['total'];
    }
}
?>

