<?php

class Users extends Controller {

    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function register() {
        // Load blank form
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];

        $this->view('users/register', $data);
    }

    public function register_POST() {
        // Process the form
        $input = [
            'username' => POSTDATA['username'],
            'email' => POSTDATA['email'],
            'password' => POSTDATA['password'],
            'confirm_password' => POSTDATA['confirm_password'],
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];
        $data = $this->register_check_error($input);
        
        if ($data['HAS_ERRORS'] == false) {
            // Validated
            die('SUCCESS');
        } else {
            $HTMLsafe = Secure::HTML($data);
            $this->view('users/register', $HTMLsafe);
        }
    }

    public function login() {
        // Load blank form
        $data = [
            'email' => '',
            'password' => '',
            'email_err' => '',
            'password_err' => ''
        ];

        // Load view
        $this->view('users/login', $data);
    }

    public function login_POST() {
        // Process the form
        $input = [
            'email' => POSTDATA['email'],
            'password' => POSTDATA['password'],
            'email_err' => '',
            'password_err' => ''
        ];
        
        $data = $this->login_check_error($input);

        if ($data['HAS_ERRORS'] == false) {
            // Validated
            die('SUCCESS');
        } else {
            $HTMLsafe = Secure::HTML($data);
            $this->view('users/login', $HTMLsafe);
        }

    }
    
    private function register_check_error($data) {
        $data['username_err'] = RuleLookup::Username($data['username']);
        // Check if there is not an error
            // Check if the username already exists in the database
        
        $data['email_err'] = RuleLookup::Email($data['email']);
        // Check if there is not an error
            // Check if the email already exists in the database
        
        $data['password_err'] = RuleLookup::Password($data['password']);
        
        $data['confirm_password_err'] = RuleLookup::ConfPasswords($data['password'],$data['confirm_password']);

        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['username_err']) &&
            empty($data['email_err']) &&
            empty($data['password_err']) &&
            empty($data['confirm_password_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }

        //Return to the controller
        return($data);
    }
    
    public function login_check_error($data) {
        $data['email_err'] = RuleLookup::Email($data['email']);
        
        $data['password_err'] = RuleLookup::Password($data['password']);

        // Set error flag if an error was found
        $data['HAS_ERRORS'] = true;
        if (
            empty($data['email_err']) &&
            empty($data['password_err'])
        ) {
            $data['HAS_ERRORS'] = false;
        }

        //Return to the controller
        return($data);
    }


}
