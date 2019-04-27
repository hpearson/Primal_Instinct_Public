<?php

class PlayerActions extends Controller {  
    private $SQL;
    private $SQL2;
    
    public function __construct(){
	//$this->SQL = $this->model('Game');
        $this->SQL2 = $this->model('Game');
    }
    
    public function cut_POST(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        $input = [];
        // Process the form
        $data = $this->cut_check($input);
        //$data['HAS_ERRORS'] = true;
        if ($data['HAS_ERRORS'] == false) {        
            // Get Player Gameboard location
            $location = $this->SQL2->GetPlayerLocation();
            // Trample the grass in current title
            $this->SQL2->TrampleGrass($location->ID);
            // Reduce player AP for this action
            $this->SQL2->ReduceAP();
            redirect('game/');
        } else {
            Inform::push_warning('Failed to cut vegitation.');
            redirect('game/');            
        }
    }
    
    public function cut_check($data){
        // Look up players actions left
        if ($this->SQL2->GetAP()->AP == 0){
            $data['cut_err'] = true;
        }
        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['cut_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }
        // Return to the controller
        return($data);
    }
    
}