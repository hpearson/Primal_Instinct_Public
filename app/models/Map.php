<?php

class Map_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    
    public function GetLargeMap(){
        $this->db->query("
            SELECT *
            FROM GameBoard
            ORDER BY Grid_Y, Grid_X
            ");
        return $this->db->resultSet();        
    }

}