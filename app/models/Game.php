<?php

class Game_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    
    public function GetMap($location) {
        $this->db->query("EXEC GetMap @Location = :location");
        $this->db->bind('location', $location);
        return $this->db->resultSet();
    }
    
    public function GetPlayerData($player) {
        $this->db->query("EXEC GetPlayerData @player = :player");
        $this->db->bind('player', $player);
        return $this->db->single();
    }
    
    public function GetPlayerLocation($player) {
        $this->db->query("EXEC GetPlayerLocation @player = :player");
        $this->db->bind('player', $player);
        return $this->db->single();        
    }
    
    public function GetLocalPlayers($location, $player, $alive) {
        $this->db->query("EXEC GetLocalPlayers @location = :location, @player = :player, @alive = :alive");
        $this->db->bind('location', $location);
        $this->db->bind('player', $player);
        $this->db->bind('alive', $alive);
        return $this->db->resultSet();
    }
    
    public function GetHistory($data) {
        $this->db->query("SELECT TOP 100 * FROM TileLog WHERE EventLocation = :location ORDER BY EventTime DESC");
        $this->db->bind('location', $data);
        return $this->db->resultSet();
    } 
    
    public function MovePlayer($location, $player){
        $this->db->query("EXEC UpdatePlayerPosition @LocationTo = :location, @Player = :player");
        $this->db->bind('location', $location);
        $this->db->bind('player', $player);
        return $this->db->execute();
    }
    
    public function SprayGraffiti($location, $desc) {
        $this->db->query("EXEC InsertTileLog @EventLocation = :location, @EventDesc = :text");   
        $this->db->bind('location', $location);
        $this->db->bind('text', 'Graffiti: ' . $desc);
        return $this->db->execute();
    }        
    
    public function UpdateVegitation($location, $amount) {
        $this->db->query("EXEC UpdateVegitation @Location = :location, @Amount = :amount");
        $this->db->bind('location', $location);
        $this->db->bind('amount', $amount);
        return $this->db->execute();          
    }
    
    public function UpdateAP($player, $amount) {
        $this->db->query("EXEC UpdateAP @player = :player, @Amount = :amount");
        $this->db->bind('player', $player);
        $this->db->bind('amount', $amount);
        return $this->db->execute();
    }
    
    public function UpdateHP($player, $amount) {
        $this->db->query("EXEC UpdateHP @player = :player, @Amount = :amount");
        $this->db->bind('player', $player);
        $this->db->bind('amount', $amount);
        return $this->db->execute();
    }
    
}