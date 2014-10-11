<?php
#set errors reporting
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


require_once('library/loader.class.php'); 
spl_autoload_register('library\\loader::load'); 

$controller = new controller\index();
