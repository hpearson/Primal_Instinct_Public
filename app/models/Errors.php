<?php

class Errors_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateErrorReport($data) {
        // Allow NULL Players to file a report
        $player = Session::get('PlayerGUID');
        if (is_array($player)){
            $player = null;
        }
        $this->db->query(
                  "INSERT INTO UserReports "
                . "(ReportText, Reporter) VALUES (:report, :user) "
                );
        $this->db->bind('report', $data['report']);
        $this->db->bind('user', $player);
        return $this->db->execute();
    }

}