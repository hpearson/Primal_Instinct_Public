<?php

class Errors_Model {

    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function CreateErrorReport($reporter, $reporttext){
        if (is_array($reporter)){
            $reporter = null;
        }
        $this->db->query("EXEC InsertErrorReport @Reporter = :reporter, @ReportText = :reporttext");
        $this->db->bind('reporter', $reporter);
        $this->db->bind('reporttext', $reporttext);
        return $this->db->execute();
    }

}