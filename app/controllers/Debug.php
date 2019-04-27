<?php

class Debug extends Controller {
    private $SQL;

    public function __construct() {
        $this->SQL = $this->Model('Debug');
    }

    public function Index() {
        $data = [
            'title' => 'Debug Home Page'
            , 'SQL' => $this->SQL
        ];
        $this->view('debug/index', $data);
    }

    public function DatabaseTester() {
        $this->SQL = $this->SQL->TestSQL();

        $data = [
            'title' => 'Debug Test Database'
            , 'SQL' => $this->SQL
        ];

        $this->view('debug/databaseTester', $data);
    }

    public function BrokenSQL() {
        $this->SQL = $this->SQL->BrokenSQL();

        $data = [
            'title' => 'Debug Test Database'
            , 'SQL' => $this->SQL
        ];

        $this->view('debug/databaseTester', $data);
    }
    
}
