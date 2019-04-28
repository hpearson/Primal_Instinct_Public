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
            $location = $this->SQL->GetPlayerLocation(Session::get('PlayerGUID'));
            // Trample the grass in current title
            $this->SQL->UpdateVegitation($location->ID,-1);
            // Log this action
            $this->SQL->InsertTileLog($location->ID,'Parts of the wilderness have been removed.');            
            // Reduce player AP for this action
            $this->SQL->UpdateAP(Session::get('PlayerGUID'),-1);
            redirect('game/');
        } else {
            Inform::push_warning('Failed to cut vegitation.');
            redirect('game/');            
        }
    }
    
    public function cut_check($data){
        // Look up players actions left
        if ($this->SQL->GetPlayerData(Session::get('PlayerGUID'))->AP == 0){
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
            Inform::push_info('Your strike lands true.');
            // Reduce player HP for this action
            $kill = $this->SQL->UpdateHP($data['target'],-1); 
            if($kill->Killed == 1){
                //Add kill to score
                $this->SQL->UpdateKills(Session::get('PlayerGUID'),1); 
                Inform::push_info('The kill is yours.');
            }
            // Reduce player AP for this action
            $this->SQL->UpdateAP(Session::get('PlayerGUID'),-1);
            redirect('game/');
        } else {
            Inform::push_warning('Failed to attack.');
            redirect('game/');
        }
    }
    
    public function attack_check($data){
        // Look up players actions left
        if ($this->SQL->GetPlayerData(Session::get('PlayerGUID'))->AP == 0){
            $data['attack_err'] = true;
        }
        
        // Get Player Gameboard location
        $player_location = $this->SQL->GetPlayerLocation(Session::get('PlayerGUID'));

        // Get Target Gameboard location
        $target_location = $this->SQL->GetPlayerLocation($data['target']);
        
        // Compare player locations
        if ($player_location->Player_Location != $target_location->Player_Location){
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
            $location = $this->SQL->GetPlayerLocation(Session::get('PlayerGUID'));
            $data['location'] = $location->ID;
            // Spray the graffiti
            $this->SQL->SprayGraffiti($location->ID, $data['graffiti']);
            // Reduce player AP for this action
            $this->SQL->UpdateAP(Session::get('PlayerGUID'),-1);
            redirect('game/');
        } else {
            Inform::push_warning('Failed to spray graffiti.');
            redirect('game/');            
        }
    }
    
    public function graffiti_check($data){
        $data['graffiti_err'] = RuleLookup::Graffiti($data['graffiti']);
        // Look up players actions left
        if ($this->SQL->GetPlayerData(Session::get('PlayerGUID'))->AP == 0){
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