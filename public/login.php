<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/auth.php';

// Se já estiver logado, redirecionar para dashboard
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];
    
    if (!empty($email) && !empty($password)) {
        if (loginUser($email, $password)) {
            redirect('dashboard.php');
        } else {
            $error = 'Email ou senha incorretos.';
        }
    } else {
        $error = 'Por favor, preencha todos os campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Ocorrências Veiculares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body class="login-page">
    <!-- Dark Mode Toggle for Login Page -->
    <div class="position-fixed top-0 end-0 p-3">
        <button class="btn btn-outline-light btn-sm" id="darkModeToggle" title="Alternar modo escuro">
            <i class="fas fa-moon" id="darkModeIcon"></i>
        </button>
    </div>
    
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="card login-card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                            <h2 class="text-primary">Sistema de Ocorrências</h2>
                            <p class="text-muted">Faça login para continuar</p>
                        </div>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Senha
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Entrar
                            </button>
                        </form>
                        
                        <div class="text-center">
                            <small class="text-muted">
                                Não tem conta? <a href="register.php" class="text-primary">Registre-se aqui</a>
                            </small>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <small class="text-muted">
                                <strong>Usuários de teste:</strong><br>
                                Admin: admin@sistema.com / password<br>
                                Usuário: usuario@sistema.com / password
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
</body>
</html>

