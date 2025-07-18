<?php

require_once __DIR__ . '/../includes/database.php';

class TabelaPrestadorModel
{

    // ...outros métodos...

    public static function count()
    {
        $conn = connectDB();
        $sql = "SELECT COUNT(*) AS total FROM tabela_prestadores";
        $result = $conn->query($sql);
        $total = 0;
        if ($result && $row = $result->fetch_assoc()) {
            $total = (int)$row['total'];
        }
        $conn->close();
        return $total;
    }

    public static function getAll()
    {
        $conn = connectDB();
        $sql = "SELECT * FROM tabela_prestadores ORDER BY nome_prestador";
        $result = $conn->query($sql);
        $prestadores = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $prestadores[] = $row;
            }
        }

        $conn->close();
        return $prestadores;
    }

    public static function getById($id)
    {
        $conn = connectDB();
        $sql = "SELECT * FROM tabela_prestadores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $prestador = $result->fetch_assoc();

        $stmt->close();
        $conn->close();
        return $prestador;
    }

    public static function create($data)
    {
        $conn = connectDB();

        $sql = "INSERT INTO tabela_prestadores (
            nome_prestador, equipes, servico_prestador, cpf_prestador, rg_prestador,
            email_prestador, telefone_1_prestador, telefone_2_prestador, cep_prestador,
            endereco_prestador, numero_prestador, bairro_prestador, cidade_prestador,
            estado_prestador, observacao, documento_prestador, foto_prestador,
            codigo_do_banco, pix_banco_prestadores, titular_conta, tipo_de_conta,
            agencia_prestadores, digito_agencia_prestadores, conta_prestadores,
            digito_conta_prestadores
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssssssssssss",
            $data['nome_prestador'],
            $data['equipes'],
            $data['servico_prestador'],
            $data['cpf_prestador'],
            $data['rg_prestador'],
            $data['email_prestador'],
            $data['telefone_1_prestador'],
            $data['telefone_2_prestador'],
            $data['cep_prestador'],
            $data['endereco_prestador'],
            $data['numero_prestador'],
            $data['bairro_prestador'],
            $data['cidade_prestador'],
            $data['estado_prestador'],
            $data['observacao'],
            $data['documento_prestador'],
            $data['foto_prestador'],
            $data['codigo_do_banco'],
            $data['pix_banco_prestadores'],
            $data['titular_conta'],
            $data['tipo_de_conta'],
            $data['agencia_prestadores'],
            $data['digito_agencia_prestadores'],
            $data['conta_prestadores'],
            $data['digito_conta_prestadores']
        );

        $success = $stmt->execute();
        $id = $conn->insert_id;

        $stmt->close();
        $conn->close();

        return $success ? $id : false;
    }

    public static function update($id, $data)
    {
        $conn = connectDB();

        $sql = "UPDATE tabela_prestadores SET 
            nome_prestador = ?, equipes = ?, servico_prestador = ?, cpf_prestador = ?,
            rg_prestador = ?, email_prestador = ?, telefone_1_prestador = ?,
            telefone_2_prestador = ?, cep_prestador = ?, endereco_prestador = ?,
            numero_prestador = ?, bairro_prestador = ?, cidade_prestador = ?,
            estado_prestador = ?, observacao = ?, documento_prestador = ?,
            foto_prestador = ?, codigo_do_banco = ?, pix_banco_prestadores = ?,
            titular_conta = ?, tipo_de_conta = ?, agencia_prestadores = ?,
            digito_agencia_prestadores = ?, conta_prestadores = ?,
            digito_conta_prestadores = ?
            WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssssssssssssi",
            $data['nome_prestador'],
            $data['equipes'],
            $data['servico_prestador'],
            $data['cpf_prestador'],
            $data['rg_prestador'],
            $data['email_prestador'],
            $data['telefone_1_prestador'],
            $data['telefone_2_prestador'],
            $data['cep_prestador'],
            $data['endereco_prestador'],
            $data['numero_prestador'],
            $data['bairro_prestador'],
            $data['cidade_prestador'],
            $data['estado_prestador'],
            $data['observacao'],
            $data['documento_prestador'],
            $data['foto_prestador'],
            $data['codigo_do_banco'],
            $data['pix_banco_prestadores'],
            $data['titular_conta'],
            $data['tipo_de_conta'],
            $data['agencia_prestadores'],
            $data['digito_agencia_prestadores'],
            $data['conta_prestadores'],
            $data['digito_conta_prestadores'],
            $id
        );

        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }

    public static function delete($id)
    {
        $conn = connectDB();
        $sql = "DELETE FROM tabela_prestadores WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $success;
    }
}
