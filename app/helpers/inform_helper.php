<?php

class Inform {
    
    static function push_error($ErrorMSG){
        $_SESSION['InformError'][] = $ErrorMSG;
    }
    
    static function push_warning($WarningMSG){
        $_SESSION['InformWarning'][] = $WarningMSG;
    }
    
    static function push_info($InfoMSG){
        $_SESSION['InformInfo'][] = $InfoMSG;
    }
    
}