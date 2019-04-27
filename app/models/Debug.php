<?php

class Debug_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function TestSQL() {
        $this->db->query("SELECT 'asd' as 'asd' UNION ALL SELECT 'asd1' as 'asd'");
        return $this->db->resultSet();
    }
    
    public function BrokenSQL() {
        $this->db->query("SELECT 'asd' as asd' as 'asd'");
        return $this->db->resultSet();
    }

}