<?php
class Controller {
    // Cargar modelo
    public function model($model) {
        require_once "../app/models/".$model.".php";
        return new $model();
    }

    // Cargar vista
    public function view($view, $data = []) {
        // Convertir el array de datos en variables para la vista
        if(!empty($data)) {
            foreach($data as $key => $value) {
                $$key = $value; // ['username'=>'admin'] → $username
            }
        }

        // Ruta absoluta a la vista
        $viewFile = __DIR__ . "/../views/" . $view . ".php";

        if(file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Vista no encontrada: " . $viewFile);
        }
    }
}
