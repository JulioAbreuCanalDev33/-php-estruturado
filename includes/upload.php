<?php

/**
 * Sistema de Upload de Arquivos
 * Suporta imagens, documentos e validações de segurança
 */

class FileUpload {
    
    private $uploadDir;
    private $allowedTypes;
    private $maxFileSize;
    private $errors = [];
    
    public function __construct() {
        $this->uploadDir = __DIR__ . '/../uploads/';
        $this->maxFileSize = 5 * 1024 * 1024; // 5MB
        $this->allowedTypes = [
            // Imagens
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            
            // Documentos
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'text/plain' => 'txt',
            
            // Outros
            'application/zip' => 'zip',
            'application/x-rar-compressed' => 'rar'
        ];
        
        // Criar diretório de upload se não existir
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
        
        // Criar subdiretórios
        $this->createSubDirectories();
    }
    
    private function createSubDirectories() {
        $subdirs = ['images', 'documents', 'temp'];
        
        foreach ($subdirs as $subdir) {
            $path = $this->uploadDir . $subdir . '/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }
    }
    
    /**
     * Upload de arquivo único
     */
    public function uploadFile($file, $category = 'documents', $customName = null) {
        $this->errors = [];
        
        // Validar arquivo
        if (!$this->validateFile($file)) {
            return false;
        }
        
        // Determinar nome do arquivo
        $fileName = $this->generateFileName($file, $customName);
        
        // Determinar diretório baseado na categoria
        $targetDir = $this->uploadDir . $category . '/';
        $targetPath = $targetDir . $fileName;
        
        // Mover arquivo
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return [
                'success' => true,
                'filename' => $fileName,
                'path' => $targetPath,
                'url' => '/uploads/' . $category . '/' . $fileName,
                'size' => $file['size'],
                'type' => $file['type']
            ];
        } else {
            $this->errors[] = 'Erro ao mover arquivo para o destino';
            return false;
        }
    }
    
    /**
     * Upload múltiplo de arquivos
     */
    public function uploadMultiple($files, $category = 'documents') {
        $results = [];
        
        // Normalizar array de arquivos múltiplos
        $fileArray = $this->normalizeFilesArray($files);
        
        foreach ($fileArray as $file) {
            if ($file['error'] === UPLOAD_ERR_OK) {
                $result = $this->uploadFile($file, $category);
                if ($result) {
                    $results[] = $result;
                }
            }
        }
        
        return $results;
    }
    
    /**
     * Validar arquivo
     */
    private function validateFile($file) {
        // Verificar se houve erro no upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $this->errors[] = $this->getUploadErrorMessage($file['error']);
            return false;
        }
        
        // Verificar tamanho
        if ($file['size'] > $this->maxFileSize) {
            $this->errors[] = 'Arquivo muito grande. Tamanho máximo: ' . $this->formatBytes($this->maxFileSize);
            return false;
        }
        
        // Verificar tipo MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!array_key_exists($mimeType, $this->allowedTypes)) {
            $this->errors[] = 'Tipo de arquivo não permitido: ' . $mimeType;
            return false;
        }
        
        // Verificar se é realmente uma imagem (para arquivos de imagem)
        if (strpos($mimeType, 'image/') === 0) {
            $imageInfo = getimagesize($file['tmp_name']);
            if ($imageInfo === false) {
                $this->errors[] = 'Arquivo de imagem inválido';
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Gerar nome único para o arquivo
     */
    private function generateFileName($file, $customName = null) {
        $extension = $this->getFileExtension($file);
        
        if ($customName) {
            $baseName = $this->sanitizeFileName($customName);
        } else {
            $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
            $baseName = $this->sanitizeFileName($baseName);
        }
        
        // Adicionar timestamp para garantir unicidade
        $timestamp = date('Y-m-d_H-i-s');
        $randomString = substr(md5(uniqid()), 0, 8);
        
        return $baseName . '_' . $timestamp . '_' . $randomString . '.' . $extension;
    }
    
    /**
     * Obter extensão do arquivo baseada no tipo MIME
     */
    private function getFileExtension($file) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        return $this->allowedTypes[$mimeType] ?? 'bin';
    }
    
    /**
     * Sanitizar nome do arquivo
     */
    private function sanitizeFileName($filename) {
        // Remover caracteres especiais
        $filename = preg_replace('/[^a-zA-Z0-9\-_]/', '', $filename);
        
        // Limitar tamanho
        return substr($filename, 0, 50);
    }
    
    /**
     * Normalizar array de arquivos múltiplos
     */
    private function normalizeFilesArray($files) {
        $fileArray = [];
        
        if (is_array($files['name'])) {
            for ($i = 0; $i < count($files['name']); $i++) {
                $fileArray[] = [
                    'name' => $files['name'][$i],
                    'type' => $files['type'][$i],
                    'tmp_name' => $files['tmp_name'][$i],
                    'error' => $files['error'][$i],
                    'size' => $files['size'][$i]
                ];
            }
        } else {
            $fileArray[] = $files;
        }
        
        return $fileArray;
    }
    
    /**
     * Obter mensagem de erro do upload
     */
    private function getUploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'Arquivo muito grande (limite do servidor)';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Arquivo muito grande (limite do formulário)';
            case UPLOAD_ERR_PARTIAL:
                return 'Upload incompleto';
            case UPLOAD_ERR_NO_FILE:
                return 'Nenhum arquivo enviado';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Diretório temporário não encontrado';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Erro ao escrever arquivo';
            case UPLOAD_ERR_EXTENSION:
                return 'Upload bloqueado por extensão';
            default:
                return 'Erro desconhecido no upload';
        }
    }
    
    /**
     * Formatar bytes em formato legível
     */
    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
    
    /**
     * Excluir arquivo
     */
    public function deleteFile($filePath) {
        if (file_exists($filePath)) {
            return unlink($filePath);
        }
        return false;
    }
    
    /**
     * Obter erros
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * Obter tipos permitidos
     */
    public function getAllowedTypes() {
        return array_keys($this->allowedTypes);
    }
    
    /**
     * Obter tamanho máximo
     */
    public function getMaxFileSize() {
        return $this->maxFileSize;
    }
    
    /**
     * Redimensionar imagem
     */
    public function resizeImage($imagePath, $maxWidth = 800, $maxHeight = 600, $quality = 85) {
        if (!file_exists($imagePath)) {
            return false;
        }
        
        $imageInfo = getimagesize($imagePath);
        if ($imageInfo === false) {
            return false;
        }
        
        list($originalWidth, $originalHeight, $imageType) = $imageInfo;
        
        // Calcular novas dimensões
        $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);
        
        if ($ratio >= 1) {
            return true; // Imagem já é menor que o limite
        }
        
        $newWidth = round($originalWidth * $ratio);
        $newHeight = round($originalHeight * $ratio);
        
        // Criar imagem a partir do arquivo
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($imagePath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($imagePath);
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($imagePath);
                break;
            default:
                return false;
        }
        
        if (!$sourceImage) {
            return false;
        }
        
        // Criar nova imagem
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
        // Preservar transparência para PNG e GIF
        if ($imageType == IMAGETYPE_PNG || $imageType == IMAGETYPE_GIF) {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
            imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
        }
        
        // Redimensionar
        imagecopyresampled($newImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
        
        // Salvar imagem redimensionada
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $result = imagejpeg($newImage, $imagePath, $quality);
                break;
            case IMAGETYPE_PNG:
                $result = imagepng($newImage, $imagePath, 9);
                break;
            case IMAGETYPE_GIF:
                $result = imagegif($newImage, $imagePath);
                break;
            default:
                $result = false;
        }
        
        // Limpar memória
        imagedestroy($sourceImage);
        imagedestroy($newImage);
        
        return $result;
    }
}

/**
 * Funções auxiliares para upload
 */

function uploadFile($file, $category = 'documents', $customName = null) {
    $uploader = new FileUpload();
    return $uploader->uploadFile($file, $category, $customName);
}

function uploadMultiple($files, $category = 'documents') {
    $uploader = new FileUpload();
    return $uploader->uploadMultiple($files, $category);
}

function deleteUploadedFile($filePath) {
    $uploader = new FileUpload();
    return $uploader->deleteFile($filePath);
}

function getUploadErrors() {
    $uploader = new FileUpload();
    return $uploader->getErrors();
}

?>

