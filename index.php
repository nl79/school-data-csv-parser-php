<?php
#require the csvfile class. 
require_once('class.csvfile.php'); 

$listFile = './data/hd2013.csv'; 
$headingsFile = './data/hd2013varlist.csv'; 

try {
	$listcsv = new csvfile($listFile, true); 
} catch (Exception $e) {
	echo($e->getMessage()); 
}	

echo(phpinfo()); 
