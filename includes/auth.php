<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

// Função para fazer login
function loginUser($email, $password) {
    $conn = connectDB();
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
            
            $stmt->close();
            $conn->close();
            return true;
        }
    }
    
    $stmt->close();
    $conn->close();
    return false;
}

// Função para registrar usuário
function registerUser($name, $email, $password, $tipo_usuario = 'normal') {
    $conn = connectDB();
    
    // Verificar se email já existe
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $stmt->close();
        $conn->close();
        return false; // Email já existe
    }
    
    // Inserir novo usuário
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, tipo_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $tipo_usuario);
    
    $success = $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    return $success;
}

// Função para verificar se usuário está logado
function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}

// Função para verificar se usuário é admin
function requireAdmin() {
    if (!isAdmin()) {
        $_SESSION['error'] = 'Acesso negado. Apenas administradores podem acessar esta página.';
        redirect('dashboard.php');
    }
}

// Função para obter dados do usuário logado
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['name'],
        'email' => $_SESSION['email'],
        'tipo_usuario' => $_SESSION['tipo_usuario']
    ];
}

?>

