<?php

class Errors extends Controller {
    private $SQL;
    
    public function __construct() {
        $this->SQL = $this->Model('Errors');
    }

    public function Index() {
        $data = [
        ];

        $this->view('errors/index', $data);
    }

    // This function is hard coded to create an error, to test catcher
    public function Test() {
        // Produce an error
        $a = 10 / 0;
    }
    
    public function Report() {
        $data = [
            'error' => '',
            'error_err' => ''
        ];

        $this->view('errors/report', $data);
    }
    
    public function Report_POST() {
        $input = [
            'error' => POSTDATA['error'],
            'error_err' => ''
        ];
        $data = $this->report_check_error($input);
        
        if ($data['HAS_ERRORS'] == false) {
            $Var_Input = [];
            $Var_Input['report'] = POSTDATA['error'];            
            $this->SQL = $this->SQL->CreateErrorReport($Var_Input);
            Inform::push_info('Error Report has been sent, Thank you!');
            redirect('');
        } else {
            $HTMLsafe = Secure::HTML($data);
            $this->view('errors/report', $HTMLsafe);
        }
    }    

    private function report_check_error($data) {
        $data['error_err'] = RuleLookup::Report($data['error']);
        
        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['error_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }

        //Return to the controller
        return($data);
    }
    
}
