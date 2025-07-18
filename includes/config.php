<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "1234");
define("DB_NAME", "informacoes_ocorrencias_veicular");

// Definições de caminhos
define("BASE_URL", "http://localhost/sistema-ocorrencias-php-estruturado/public");
define("UPLOAD_PATH", __DIR__ . "/../uploads/");

// Configurações de erro
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sessão se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Função para redirecionar
function redirect($url) {
    // Se a URL não contém protocolo, adicionar caminho relativo
    if (!preg_match('/^https?:\/\//', $url)) {
        // Aqui você pode adicionar lógica para tratar URLs relativas, se necessário
    }
    header("Location: " . $url);
    exit();
}

// Função para verificar se usuário está logado
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Função para verificar se usuário é admin
function isAdmin() {
    return isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
}

// Função para logout
function logoutUser() {
    session_unset();
    session_destroy();
}

// Função para sanitizar dados
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Função para validar CNPJ
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    
    if (strlen($cnpj) != 14) {
        return false;
    }
    
    // Verificar se todos os dígitos são iguais
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }
    
    // Validar dígitos verificadores
    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    
    $resto = $soma % 11;
    
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }
    
    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    
    $resto = $soma % 11;
    
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verificar se todos os dígitos são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    
    // Validar primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * $j;
        $j--;
    }
    
    $resto = $soma % 11;
    
    if ($cpf[9] != ($resto < 2 ? 0 : 11 - $resto)) {
        return false;
    }
    
    // Validar segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * $j;
        $j--;
    }
    
    $resto = $soma % 11;
    
    return $cpf[10] == ($resto < 2 ? 0 : 11 - $resto);
}

?>

