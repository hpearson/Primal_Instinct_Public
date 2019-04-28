<?php

// Load in the validation library into an easy to use variable
use Respect\Validation\Validator as v;
// Load in librarie extension to self name
use Respect\Validation\Exceptions\ValidationException;

class RuleLookup {

    static function Username($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Alnum(),
                v::NoWhitespace(),
                v::Length(3, 15)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);
    }
    
    static function Email($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Email(),
                v::Length(3, 50)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);
    }
    
    static function Password($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Alnum(),
                v::NoWhitespace(),
                v::Length(8, 25)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);
    }    
    
    static function ConfPasswords($input1, $input2){
        $output = '';
        if ($input1 != $input2){
           $output = 'Passwords must match';
        }
        return $output;
    }
    
    static function Report($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Length(50, 255)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);        
    }
    
    static function Graffiti($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Length(5, 255)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);        
    }    
    
    static function Rename($input){
        $ValidateAgainst = v::allOf(
                v::NotEmpty(),
                v::Length(1, 255)
        );
        $VWithName = $ValidateAgainst->setName(' ');
        return RuleLookup::RunTest($VWithName, $input);        
    }     
    ////////////////////////////////////////
    // Perform the test against the input //
    ////////////////////////////////////////
    static function RunTest($test, $input){
        $output = '';
        try {
            $test->check($input);
        } catch (ValidationException $exception) {
            $output = ucfirst(trim($exception->getMainMessage()));
        }
        return $output;
    }
    
}