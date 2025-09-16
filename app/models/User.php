<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getUsers() {
        $this->db->query("SELECT id, username, email, role FROM users");
        return $this->db->resultSet();
    }

    public function createUser($username, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query("INSERT INTO users (username, email, password, role) 
                        VALUES (:username, :email, :password, :role)");
        $this->db->bind(':username', $username);
        $this->db->bind(':email', $email);       
        $this->db->bind(':password', $hashedPassword); 
        $this->db->bind(':role', $role);
        return $this->db->execute();
    }

    public function deleteUser($id) {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // 🔹 Nuevo método para login
    public function getUserByEmail($email) {
        $this->db->query("SELECT * FROM users WHERE email = :email LIMIT 1");
        $this->db->bind(':email', $email);
        return $this->db->single(); // devuelve un array asociativo con todos los campos
    }
}
