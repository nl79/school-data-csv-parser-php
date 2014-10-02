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
        
        $html = "<li id='" . html::getVal($args, 'id') . "' class='" . html::getVal($args, 'class') . "'>" . html::getVal($args, 'data') . "</li>";
        
        return $html; 
    }
    
    public static function table($args = array(), $orientation = 'h') {
        
        #get the headigs and the data arrays
        $data = html::getVal($args, 'data');
        
        #validate and convert the orientation flag to lower case
        $orientation = !empty($orientation) && is_string($orientation) ? strtolower($orientation) : 'h';
        
        $html = "<table id='" . html::getVal($args, 'id') . "' border='" . html::getVal($args, 'border') . " '>"; 
        
        #switch the orientation flag.
        switch($orientation) {
            case 'h':
                
                if(!empty($data)) {
                    foreach($data as $item) {
                        $html .= "<tr>";
                        foreach($item as $field) {
                            $html .= "<td>" . $field . "</td>"; 
                        }
                        $html .= "</tr>"; 
                    }
                }
                
                break; 
        }
        
        $html .= '</table>';    
        
        return $html; 
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