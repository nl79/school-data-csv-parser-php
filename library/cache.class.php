<?php

class cache {
    
    #caching directory path.
    private $_dir = null; 
    
    public function __construct($dir) {
        $this->_dir = is_string($dir) && !empty($dir) ? $dir : null; 
    }
    
    public function cacheJson($filename, &$data) {      
        $json = json_encode($data);
    
        file_put_contents($this->_dir . $filename, $json);

    }
    
    public function getJsonData($filename) {
        $data = json_decode(file_get_contents($this->_dir . $filename), true);
          
        return $data; 
    }
    
    public function cacheHtml($filename, $data) {
        file_put_contents($this->_dir . $filename, $data);
    }
}