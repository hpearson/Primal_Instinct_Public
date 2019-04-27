<?php

class Game_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function GetPlayerLocation($target = null) {
        $this->db->query("
            SELECT GameBoard.ID
            FROM Player
            LEFT JOIN GameBoard
            ON Player.Player_Location = Gameboard.ID
            WHERE Player.ID = :player
        ");
        
        if ($target == null){
            $this->db->bind('player', Session::get('PlayerGUID'));
        } else {
            $this->db->bind('player', $target);
        }
        return $this->db->single();
    }
    
    public function GetMap($data) {
        $this->db->query("
            DECLARE @X int 
            DECLARE @Y int
            SELECT @X = Grid_X, @Y = Grid_Y FROM GameBoard WHERE ID = :location
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y - 1
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y - 1
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y - 1
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X - 1 AND @Y = Grid_Y + 1
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X AND @Y = Grid_Y + 1
            UNION
            SELECT *, (SELECT COUNT(*) FROM Player WHERE Player_Location = GameBoard.ID) AS 'Players' FROM GameBoard WHERE @X = Grid_X + 1 AND @Y = Grid_Y + 1
            ORDER BY Grid_Y, Grid_X
        ");
        
        $this->db->bind('location', $data);
        return $this->db->resultSet();
    }
    
    public function MovePlayer($data) {
        $this->db->query("
                INSERT INTO TileLog (EventLocation, EventDesc) VALUES (
                (SELECT Player_Location FROM Player WHERE ID = :player_1)
                ,'A player has left this location.')
                INSERT INTO TileLog (EventLocation, EventDesc) VALUES (:location_1,'A player entered this location.')
                UPDATE Player SET Player_Location = :location WHERE ID = :player 
            ");
        $this->db->bind('location', $data);
        $this->db->bind('location_1', $data);
        $this->db->bind('player', Session::get('PlayerGUID'));
        $this->db->bind('player_1', Session::get('PlayerGUID'));
        return $this->db->execute();
    }
    
    public function TrampleGrass($data) {
        $this->db->query("UPDATE GameBoard SET Vegitation = CASE WHEN Vegitation = 1 THEN 1 ELSE Vegitation - 1 END WHERE ID = :location");
        $this->db->bind('location', $data);
        return $this->db->execute();        
    }
    
    public function GetNeighbors($data) {
        $this->db->query("SELECT * FROM Player WHERE Player_Location = :location AND ID != :player ");
        $this->db->bind('location', $data);
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->resultSet();
    }
    
    public function GetAP() {
        $this->db->query("SELECT AP FROM Player WHERE ID = :player ");
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->single();
    }    
    
    public function ReduceAP() {
        $this->db->query("UPDATE Player SET AP = AP - 1 WHERE ID = :player ");
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->execute();
    }
    
    public function ReduceHP($target) {
        $this->db->query("
                UPDATE Player SET HP = HP - 1 WHERE ID = :player 
                INSERT INTO TileLog (EventLocation, EventDesc) VALUES (
                (SELECT Player_Location FROM Player WHERE ID = :player_1)
                ,'A player was attacked!')
                ");
        $this->db->bind('player', $target);
        $this->db->bind('player_1', $target);
        return $this->db->execute();
    }
    
    public function GetStatus() {
        $this->db->query("SELECT * FROM Player WHERE ID = :player ");
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->single();
    }   
    
    public function GetHistory($data) {
        $this->db->query("SELECT TOP 100 * FROM TileLog WHERE EventLocation = :location ORDER BY EventTime DESC");
        $this->db->bind('location', $data);
        return $this->db->resultSet();
    }
    
    public function SprayGraffiti($data) {
        $this->db->query("
                INSERT INTO TileLog (EventLocation, EventDesc) VALUES (
                :location
                ,'Graffiti: ' + :text)
                ");   
        $this->db->bind('location', $data['location']);
        $this->db->bind('text', $data['graffiti']);
        return $this->db->execute();
    }
    
}