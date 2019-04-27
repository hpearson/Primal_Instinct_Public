<?php

class Errors_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateErrorReport($data) {
        $this->db->query(
                  "INSERT INTO UserReports "
                . "(ReportText) VALUES (:report) "
                );
        $this->db->bind('report', $data['report']);
        return $this->db->execute();
    }

}