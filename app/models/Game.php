<?php

class Game_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function GetPlayerLocation() {
        $this->db->query("
            SELECT GameBoard.ID
            FROM Player
            LEFT JOIN GameBoard
            ON Player.Player_Location = Gameboard.ID
            WHERE Player.ID = :player
        ");
        
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->single();
    }
    
    public function GetMap($data) {
        $this->db->query("
            DECLARE @X int 
            DECLARE @Y int
            SELECT @X = Grid_X, @Y = Grid_Y FROM GameBoard WHERE ID = :location
            SELECT * FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y - 1
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y - 1
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y - 1
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y + 1
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y + 1
            UNION
            SELECT * FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y + 1
            ORDER BY Grid_Y, Grid_X
        ");
        
        $this->db->bind('location', $data);
        return $this->db->resultSet();
    }
    
    public function MovePlayer($data) {
        $this->db->query("UPDATE Player SET Player_Location = :location");
        $this->db->bind('location', $data);
        return $this->db->execute();
    }
    
    public function TrampleGrass($data) {
        $this->db->query("UPDATE GameBoard SET Vegitation = Vegitation - 1 WHERE ID = :location");
        $this->db->bind('location', $data);
        return $this->db->execute();        
    }
    
}