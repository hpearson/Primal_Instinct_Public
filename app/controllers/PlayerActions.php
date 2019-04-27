<?php

class PlayerActions extends Controller {  
    private $SQL;
    
    public function __construct(){
        $this->SQL = $this->model('Game');
    }
    
    public function cut_POST(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        $input = [];
        // Process the form
        $data = $this->cut_check($input);
        //$data['HAS_ERRORS'] = true;
        if ($data['HAS_ERRORS'] == false) {        
            // Get Player Gameboard location
            $location = $this->SQL->GetPlayerLocation();
            // Trample the grass in current title
            $this->SQL->TrampleGrass($location->ID);
            // Reduce player AP for this action
            $this->SQL->ReduceAP();
            redirect('game/');
        } else {
            Inform::push_warning('Failed to cut vegitation.');
            redirect('game/');            
        }
    }
    
    public function cut_check($data){
        // Look up players actions left
        if ($this->SQL->GetAP()->AP == 0){
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
    
    public function attack_POST(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        $input = [
            'target' => POSTDATA['target'],
        ];
        // Process the form
        $data = $this->attack_check($input);
        
        if ($data['HAS_ERRORS'] == false) {
            //$this->SQL->MovePlayer($data['location']);

            // Reduce player AP for this action
            $this->SQL->ReduceHP($data['target']);           
            
            // Reduce player AP for this action
            $this->SQL->ReduceAP();
            Inform::push_warning('Your strike lands true.');
            redirect('game/');
        } else {
            Inform::push_warning('Failed to attack.');
            redirect('game/');
        }
    }
    
    public function attack_check($data){
        // Look up players actions left
        if ($this->SQL->GetAP()->AP == 0){
            $data['attack_err'] = true;
        }
        
        // Get Player Gameboard location
        $player_location = $this->SQL->GetPlayerLocation();
        
        // Get Target Gameboard location
        $target_location = $this->SQL->GetPlayerLocation($data['target']);
        
        // Compare player locations
        if ($player_location != $target_location){
            $data['attack_err'] = true;
        }
        
        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['attack_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }
        // Return to the controller
        return($data);
    }
    
    
   public function graffiti_POST(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        $input = [
            'graffiti' => POSTDATA['graffiti'],
        ];
        // Process the form
        $data = $this->graffiti_check($input);
        if ($data['HAS_ERRORS'] == false) {        
            // Get Player Gameboard location
            $location = $this->SQL->GetPlayerLocation();
            $data['location'] = $location->ID;
            // Spray the graffiti
            $this->SQL->SprayGraffiti($data);
            // Reduce player AP for this action
            $this->SQL->ReduceAP();
            redirect('game/');
        } else {
            Inform::push_warning('Failed to spray graffiti.');
            redirect('game/');            
        }
    }
    
    public function graffiti_check($data){
        $data['graffiti_err'] = RuleLookup::Graffiti($data['graffiti']);
        // Look up players actions left
        if ($this->SQL->GetAP()->AP == 0){
            $data['graffiti_err'] = true;
        }
        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['graffiti_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }
        // Return to the controller
        return($data);
    }
    
    
}