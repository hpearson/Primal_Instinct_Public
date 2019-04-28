<?php

class Users_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    
    public function InsertUserAccount($username, $email, $password) {
        $this->db->query("EXEC InsertUserAccount @Username = :username, @Email = :email, @Password = :password");
        $this->db->bind('username', $username);
        $this->db->bind('email', $email);
        $this->db->bind('password', $password);
        return $this->db->execute();
    }

    public function UsernameExists($data) {
        $this->db->query("SELECT * FROM Player WHERE Username = :username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }
    
    public function EmailExists($data) {
        $this->db->query("SELECT * FROM Player WHERE Email = :email");
        $this->db->bind('email', $data['email']);
        return $this->db->single();
    }    
    
}