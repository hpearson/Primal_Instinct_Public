<?php

class Users_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateUserAccount($data) {
        $this->db->query("
            INSERT INTO Player ( 
                Player_Location,
                Username, 
                Email, 
                Player_Password
            ) VALUES ( 
                ( SELECT TOP 1 ID FROM GameBoard WHERE Vegitation != 0 ORDER BY NEWID() ),
                :username, 
                :email, 
                :password
            )"
        );
        $this->db->bind('username', $data['username']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
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