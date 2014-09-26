<?php
#require the csvfile class. 
require_once('class.csvfile.php'); 

$listFile = './data/hd2013.csv'; 
$headingsFile = './data/hd2013varlist.csv'; 

try {
	$listcsv = new csvfile($listFile, true);
	$headingcsv = new csvfile($headingsFile, true); 
} catch (Exception $e) {
	echo($e->getMessage()); 
}

//$names = $listcsv->getFieldsByName('instnm'); 

echo("<pre>"); 
print_r($headingcsv->getHeadings());
//print_r($names); 
print_r($listcsv->getData()); 
echo("</pre>"); 

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>IS218 Programming Challenge 1</title>
	</head>
	<body>
		
	</body>
</html>