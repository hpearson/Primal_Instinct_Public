<?php

class PlayerActions_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

        public function ReduceAP() {
        $this->db->query("UPDATE Player SET AP = AP - 1 WHERE ID = :player ");
        $this->db->bind('player', Session::get('PlayerGUID'));
        return $this->db->execute();
    }
}