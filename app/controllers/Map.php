<?php

class Map extends Controller {
    private $SQL;
    
    public function __construct() {
        $this->SQL = $this->Model('Map');
    }
    
    public function Index() {
        $data = $this->SQL->GetLargeMap();
    
        $this->view('map/index', $data);
    }
}