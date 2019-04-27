<?php

class Game extends Controller {  
    private $SQL;
    
    public function __construct(){
	$this->SQL = $this->model('Game');
    }
    
    public function index(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        
        //TODO
	$data = [
	];

        // Get Player Gameboard location
        $location = $this->SQL->GetPlayerLocation();

        // Look up Gameboard data
        $MapData = $this->SQL->GetMap($location->ID);

        // Players at this location
        $NearPlayers = $this->SQL->GetNeighbors($location->ID);

        //$HTMLsafe = Secure::HTML($data);
	//$this->view('game/index', $data);

        require APPROOT . '/views/inc/header.php';
        require APPROOT . '/views/inc/inform.php';

        $this->view('game/_gameboard', $MapData);
        $this->view('game/_nearplayers', $NearPlayers);

        require APPROOT . '/views/inc/footer.php'; 
    }

    public function movement_POST(){
        if (!Session::get('SignedIn')){redirect(''); die;}
        // Process the form
        $input = [
            'player' => Session::get('PlayerGUID'),
            'location' => POSTDATA['location'],
            'location_err' => ''
        ];
        $data = $this->movement_check($input);
        //$data['HAS_ERRORS'] = true;
        if ($data['HAS_ERRORS'] == false) {
            // Get Player Gameboard location
            $location = $this->SQL->GetPlayerLocation();
            // Trample the grass in current title
            $this->SQL->TrampleGrass($location->ID);
            // Move the player to the new location
            $this->SQL->MovePlayer($data['location']);
            // Trample the grass in new title
            $this->SQL->TrampleGrass($data['location']);
            redirect('game/');
        } else {
            Inform::push_warning('Failed to moved.');
            redirect('game/');
        }
    }
    
    private function movement_check($data) {
        //Load current players X/Y
        // Get Player Gameboard location
        $location = $this->SQL->GetPlayerLocation();
        // Look up Gameboard data
        $MapData = $this->SQL->GetMap($location->ID);
        // Check if desired destination is in GetMap (stop teleportation)
        $isTooFar = true;
        foreach ($MapData as $value) {
            if ($value->ID == $data['location']){$isTooFar = false;}
        }
        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['location_err']) &&
            $isTooFar == false
        ) {
            $data['HAS_ERRORS'] = false;
        }
        // Return to the controller
        return($data);
    }
}