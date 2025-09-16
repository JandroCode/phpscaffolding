<?php
class DashboardController extends Controller {
    
    public function __construct() {
        session_start();
        
        // Solo usuarios logueados con rol admin pueden acceder
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            // Redirigir al login si no es admin
            header('Location: ' . BASE_URL . '/user/login');
            exit;
        }
    }

    public function index() {
        // Puedes pasar datos al dashboard si quieres
        $this->view('dashboard/index', ['username' => $_SESSION['user']['username']]);
    }
}
