<?php

class Index_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    
    public function GetAliveOrDeadPlayers() {
        $this->db->query("
                SELECT
                    (SELECT COUNT(*) FROM Player WHERE HP > 0) AS 'Alive',
                    (SELECT COUNT(*) FROM Player WHERE HP = 0) AS 'Dead'            
                ");
        return $this->db->single();        
    }
    
}