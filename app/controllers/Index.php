<?php

class Index extends Controller {  
    private $SQL;

    public function __construct() {
        $this->SQL = $this->model('Index');
    }
    
    public function index(){
	$data = [
            'title' => 'Home Page',
            'players' => $this->SQL->GetAliveOrDeadPlayers()
	];
	$this->view('index/index', $data);
    }

    public function about(){
        $data = [
             'title' => 'About'
            ,'version' => VERSION
	];
	$this->view('index/about', $data);
    }
	
}