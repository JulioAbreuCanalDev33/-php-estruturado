<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/database.php';

try {
    // Conectar ao MySQL sem especificar banco
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    
    echo "Conexão com o MySQL bem-sucedida.\n";

    // Criar o banco de dados se não existir
    $dbName = DB_NAME;
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if ($conn->query($sql) === TRUE) {
        echo "Banco de dados '$dbName' criado ou já existe.\n";
    } else {
        echo "Erro ao criar banco: " . $conn->error . "\n";
    }

    // Selecionar o banco
    $conn->select_db($dbName);
    echo "Banco de dados selecionado.\n";

    // Executar script SQL
    $sql = file_get_contents(__DIR__ . '/create_tables.sql');
    if ($conn->multi_query($sql)) {
        do {
            // Armazenar primeiro resultado
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
        echo "Script SQL executado com sucesso.\n";
    } else {
        echo "Erro ao executar SQL: " . $conn->error . "\n";
    }

    // Inserir usuário admin padrão
    $password = password_hash('password', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, tipo_usuario) VALUES (?, ?, ?, ?)");
    $name = 'Admin';
    $email = 'admin@sistema.com';
    $tipo = 'admin';
    $stmt->bind_param("ssss", $name, $email, $password, $tipo);
    
    if ($stmt->execute()) {
        echo "Usuário admin padrão criado com sucesso.\n";
    } else {
        echo "Erro ao criar usuário admin: " . $stmt->error . "\n";
    }

    // Inserir usuário normal padrão
    $password2 = password_hash('password', PASSWORD_DEFAULT);
    $stmt2 = $conn->prepare("INSERT INTO users (name, email, password, tipo_usuario) VALUES (?, ?, ?, ?)");
    $name2 = 'Usuario';
    $email2 = 'usuario@sistema.com';
    $tipo2 = 'normal';
    $stmt2->bind_param("ssss", $name2, $email2, $password2, $tipo2);
    
    if ($stmt2->execute()) {
        echo "Usuário normal padrão criado com sucesso.\n";
    } else {
        echo "Erro ao criar usuário normal: " . $stmt2->error . "\n";
    }

    $stmt->close();
    $stmt2->close();
    $conn->close();

} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage() . "\n";
    exit(1);
}

echo "Instalação concluída com sucesso!\n";
echo "Usuários criados:\n";
echo "Admin: admin@sistema.com / password\n";
echo "Usuario: usuario@sistema.com / password\n";

?>

