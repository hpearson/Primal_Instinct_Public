<?php

class Game extends Controller {  
    private $SQL;
    
    public function __construct(){
	$this->SQL = $this->model('Game');
    }
    
    public function index(){
        if (!Session::get('SignedIn')){redirect(''); die;}

        // Get Player Gameboard location
        $location = $this->SQL->GetPlayerLocation();
        // Look up Gameboard data
        $MapData = $this->SQL->GetMap($location->ID);
        // Attach player data
        $MapData['PlayerStatus'] = $this->SQL->GetStatus();
        
        

        // Players at this location
        $NearPlayers = $this->SQL->GetNeighbors($location->ID);

        //$HTMLsafe = Secure::HTML($data);
	//$this->view('game/index', $data);
        
        //TODO
	$data = [
            'location' => $location->ID,
            'nearplayers' => $NearPlayers
	];        

        require APPROOT . '/views/inc/header.php';
        require APPROOT . '/views/inc/inform.php';

        echo '<div class="container">';
        echo '<div class="row">';
            echo '<div class="col-sm">';
                $this->view('game/_gameboard', $MapData);
            echo '</div>';
            echo '<div class="col-sm">';
                $this->view('game/_nearplayers', $NearPlayers);
                $this->view('game/_actions', $data);
                $this->view('game/_tilelog', $this->SQL->GetHistory($location->ID));
            echo '</div>';
        echo '</div>';
        echo '</div>';
        
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
        if ($data['HAS_ERRORS'] == false) {
            // Move the player to the new location
            $this->SQL->MovePlayer($data['location']);
            // Trample the grass in new title
            $this->SQL->TrampleGrass($data['location']);
            // Reduce player AP for this action
            $this->SQL->ReduceAP();
            redirect('game/');
        } else {
            Inform::push_warning('Failed to moved.');
            redirect('game/');
        }
    }
    
    private function movement_check($data) {
        // Look up players actions left
        if ($this->SQL->GetAP()->AP == 0){
            $data['location_err'] = true;
        }
        
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