<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
        session_start(); // iniciar sesión para login/logout
    }

    // 🔹 Listado de usuarios
    public function index() {
        $users = $this->userModel->getUsers();
        $this->view('users/index', ['users' => $users]);
    }

    // 🔹 Mostrar formulario de registro
    public function create() {
        $this->view('users/create');
    }

    // 🔹 Guardar usuario en la BD
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role     = 'user'; // role por defecto

            $this->userModel->createUser($username, $email, $password, $role);

            // Iniciar sesión automáticamente
            $_SESSION['user'] = [
                'username' => $username,
                'email'    => $email,
                'role'     => $role
            ];

            // Redirigir al home
            header('Location: ' . BASE_URL . '/index/index');
            exit;
        }
    }

    // 🔹 Mostrar formulario de login
    public function login() {
        $this->view('users/login');
    }

    // 🔹 Procesar login
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Iniciar sesión
                session_start();
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'email'    => $user['email'],
                    'role'     => $user['role']
                ];

                // 🔹 Redirigir según el rol
                if ($user['role'] === 'admin') {
                    header('Location: ' . BASE_URL . '/dashboard/index');
                } else {
                    header('Location: ' . BASE_URL . '/index/index');
                }
                exit;
            } else {
                // Login fallido: volver a login con error
                $error = 'Email o contraseña incorrectos';
                $this->view('users/login', ['error' => $error]);
            }
        }
    }


    // 🔹 Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . '/index/index');
        exit;
    }
}
