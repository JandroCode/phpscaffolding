<?php
class App {
    protected $controller = 'IndexController'; // Página principal por defecto
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Determinar el controlador
        if (isset($url[0])) {
            $controllerName = ucwords($url[0]) . 'Controller'; // user → UserController

            if (file_exists("../app/controllers/" . $controllerName . ".php")) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once "../app/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        // Determinar el método
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                // Si no existe el método, redirige a index()
                $this->method = 'index';
            }
        }

        // Parámetros
        $this->params = $url ? array_values($url) : [];

        // Llamada final
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        if (isset($_GET['url'])) {
            return explode(
                '/',
                filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)
            );
        }
        return [];
    }
}
