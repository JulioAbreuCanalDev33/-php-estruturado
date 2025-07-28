<?php

class Router {
    private $routes = [];
    private $currentRoute = null;
    
    public function __construct() {
        $this->loadRoutes();
    }
    
    private function loadRoutes() {
        require_once __DIR__ . '/../routes/web.php';
    }
    
    public function get($path, $controller, $action) {
        $this->addRoute('GET', $path, $controller, $action);
    }
    
    public function post($path, $controller, $action) {
        $this->addRoute('POST', $path, $controller, $action);
    }
    
    private function addRoute($method, $path, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action
        ];
    }
    
    public function dispatch($requestUri, $requestMethod) {
        // Remover query string
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Remover .php se existir
        $path = str_replace('.php', '', $path);
        
        // Normalizar path
        $path = '/' . trim($path, '/');
        if ($path === '/') $path = '/dashboard';
        
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $path, $requestMethod)) {
                return $this->executeRoute($route);
            }
        }
        
        // Rota não encontrada
        http_response_code(404);
        echo "Página não encontrada";
        return false;
    }
    
    private function matchRoute($route, $path, $method) {
        return $route['method'] === $method && $route['path'] === $path;
    }
    
    private function executeRoute($route) {
        $controllerFile = __DIR__ . '/../controllers/' . $route['controller'] . '.php';
        
        if (!file_exists($controllerFile)) {
            throw new Exception("Controller não encontrado: " . $route['controller']);
        }
        
        require_once $controllerFile;
        
        $controllerClass = $route['controller'];
        if (!class_exists($controllerClass)) {
            throw new Exception("Classe do controller não encontrada: " . $controllerClass);
        }
        
        $controller = new $controllerClass();
        $action = $route['action'];
        
        if (!method_exists($controller, $action)) {
            throw new Exception("Método não encontrado: " . $action . " em " . $controllerClass);
        }
        
        return $controller->$action();
    }
    
    public static function redirect($url) {
        header("Location: " . $url);
        exit();
    }
    
    public static function url($path) {
        return BASE_URL . $path;
    }
}

// Função helper para rotas
function route($name, $params = []) {
    // Implementação simples de rotas nomeadas
    $routes = [
        'dashboard' => '/dashboard',
        'clientes.index' => '/clientes.php',
        'clientes.create' => '/clientes.php?action=create',
        'clientes.show' => '/clientes.php?action=show',
        'clientes.edit' => '/clientes.php?action=edit',
        'agentes.index' => '/agentes.php',
        'agentes.create' => '/agentes.php?action=create',
        'agentes.show' => '/agentes.php?action=show',
        'agentes.edit' => '/agentes.php?action=edit',
        'atendimentos.index' => '/atendimentos.php',
        'atendimentos.create' => '/atendimentos.php?action=create',
        'atendimentos.show' => '/atendimentos.php?action=show',
        'atendimentos.edit' => '/atendimentos.php?action=edit',
        'rondas.index' => '/rondas.php',
        'rondas.create' => '/rondas.php?action=create',
        'rondas.show' => '/rondas.php?action=show',
        'rondas.edit' => '/rondas.php?action=edit',
        'ocorrencias.index' => '/ocorrencias.php',
        'ocorrencias.create' => '/ocorrencias.php?action=create',
        'ocorrencias.show' => '/ocorrencias.php?action=show',
        'ocorrencias.edit' => '/ocorrencias.php?action=edit',
        'vigilancia.index' => '/vigilancia.php',
        'vigilancia.create' => '/vigilancia.php?action=create',
        'vigilancia.show' => '/vigilancia.php?action=show',
        'vigilancia.edit' => '/vigilancia.php?action=edit',
        'prestadores.index' => '/prestadores.php',
        'prestadores.create' => '/prestadores.php?action=create',
        'prestadores.show' => '/prestadores.php?action=show',
        'prestadores.edit' => '/prestadores.php?action=edit',
        'relatorios.index' => '/relatorios.php'
    ];
    
    if (isset($routes[$name])) {
        $url = $routes[$name];
        
        // Substituir parâmetros
        foreach ($params as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }
        
        return $url;
    }
    
    return '#';
}

?>

