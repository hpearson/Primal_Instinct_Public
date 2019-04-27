<?php

class Index extends Controller {  
	  
    public function __construct(){
		
    }
    
    public function index(){
	$data = [
            'title' => 'Home Page',
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