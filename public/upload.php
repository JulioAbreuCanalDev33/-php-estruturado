<?php

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/upload.php';

// Verificar se o usuário está logado
requireLogin();

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit;
}

// Verificar se há arquivos
if (empty($_FILES)) {
    http_response_code(400);
    echo json_encode(['error' => 'Nenhum arquivo enviado']);
    exit;
}

try {
    $uploader = new FileUpload();
    $results = [];
    
    // Processar cada arquivo enviado
    foreach ($_FILES as $fieldName => $file) {
        $category = $_POST['category'] ?? 'documents';
        $customName = $_POST['custom_name'] ?? null;
        
        if (is_array($file['name'])) {
            // Upload múltiplo
            $uploadResults = $uploader->uploadMultiple($file, $category);
            $results = array_merge($results, $uploadResults);
        } else {
            // Upload único
            $result = $uploader->uploadFile($file, $category, $customName);
            if ($result) {
                $results[] = $result;
            }
        }
    }
    
    if (!empty($results)) {
        echo json_encode([
            'success' => true,
            'files' => $results,
            'message' => count($results) . ' arquivo(s) enviado(s) com sucesso'
        ]);
    } else {
        $errors = $uploader->getErrors();
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'errors' => $errors,
            'message' => 'Erro no upload: ' . implode(', ', $errors)
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'message' => 'Erro interno do servidor'
    ]);
}

?>

