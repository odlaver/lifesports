<?php
namespace App\Core;

class Router {
    private $routes = [];
    public function get($path, $handler) { $this->routes[] = ['GET', $path, $handler]; }
    public function post($path, $handler) { $this->routes[] = ['POST', $path, $handler]; }
    public function dispatch($uri, $method) {
        $uri = rtrim($uri, '/'); if ($uri === '') $uri = '/';
        foreach ($this->routes as $route) {
            [$routeMethod, $routePath, $handler] = $route;
            if ($routeMethod !== $method) continue;
            $pattern = $this->buildPattern($routePath);
            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->callHandler($handler, $params);
                return;
            }
        }
        http_response_code(404); echo '404 - Halaman tidak ditemukan.';
    }
    private function buildPattern($path) {
        $path = rtrim($path, '/'); if ($path === '') $path = '/';
        $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $pattern . '$#';
    }
    private function callHandler($handler, $params) {
        $args = array_values($params);
        if (is_callable($handler)) { call_user_func_array($handler, $args); return; }
        if (is_array($handler)) { [$class, $method] = $handler; $instance = new $class(); call_user_func_array([$instance, $method], $args); return; }
        if (is_string($handler) && strpos($handler, '@') !== false) {
            [$class, $method] = explode('@', $handler); $instance = new $class(); call_user_func_array([$instance, $method], $args);
        }
    }
}
