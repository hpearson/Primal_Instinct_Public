<?php

class Errors_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateErrorReport($data) {
        $this->db->query("SELECT :report AS 'report' WHERE 1 = 1");
        $this->db->bind('report', $data['report']);
        return $this->db->execute();
    }

}