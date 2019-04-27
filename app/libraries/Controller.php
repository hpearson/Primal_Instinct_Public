<?php

class Controller {

    // Load model
    public function model($model) {
        // Require model file
        require_once 'app/models/' . $model . '.php';
        // Make append to model class name
        $model = $model . '_Model';
        // Instatiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = []) {
        // Check for view file
        if (file_exists('app/views/' . $view . '.php')) {
            require_once 'app/views/' . $view . '.php';
        } else {
            Inform::push_error('View does not exist: '.$view);
            redirect('Errors');
        }
    }

}
