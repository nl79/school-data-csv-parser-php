<?php

class html {
    
    /*
     *@method a() - build an anchor tag
     *@static
     *@access public
     *@param array $args - parameters array.
     */ 
    public static function a($args = array()) {
        
        $html = '<a href="' . html::getVal($args, 'href') . '">' . html::getVal($args, 'data') . '</a>';
        
        return $html; 
    }
    
    
    
    public static function li($args = array()) {
        
        $html = "<li class='" . html::getVal($args, 'class') . "'>" . html::getVal($args, 'data') . "</li>";
        
        return $html; 
    }
    
    public static function table($args) {
        
    }
    
    
    private static function getVal($args = array(), $val = "") {
        
        #validate if the parameters are valid. 
        if(!is_array($args) || empty($args) ||
           !is_string($val) || empty($val) ||
            !isset($args[$val])) {
            return ""; 
        }
        
        #return the value. 
        return $args[$val]; 
    }
}