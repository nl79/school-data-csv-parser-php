<?php
#require the csvfile class. 
require_once('class.csvfile.php'); 

$start = microtime(true);

#csv filenames
$listFile = './data/hd2013.csv'; 
$headingsFile = './data/hd2013varlist.csv';

#cache filenames
$listFileCache = './cache/hd2013.cache.json';
$headingsFileCache = './cache/hd2013varlist.cache.json';

$ulHmlFile = './cache/schoolListUl.html'; 


$schoolList = null;
$headingList = null; 

#check if the files are cached
if(file_exists($listFileCache) &&
   file_exists($headingsFileCache)) {
	#open the files and decode json.
	$schoolList = json_decode(file_get_contents($listFileCache), true);
	$headingList = json_decode(file_get_contents($headingsFileCache), true);
	
} else {
	
	#open the files.
	try {
		
		#load the list csv. 
		$listcsv = new csvfile($listFile, true);
		
		$schoolList = $listcsv->getData(); 
		
		#load the headings csv. 
		$headingcsv = new csvfile($headingsFile, true);
		
		$headingList = $headingcsv->getData(); 
		
		
		#if the files were opened and loaded successfully, cache the csv objects.
		#encode json
		$listJson = json_encode($schoolList);
		
		file_put_contents($listFileCache, $listJson);
		
		#unset the cacheFile
		unset($listJson);
		
		$headingsJson = json_encode($headingList);
		
		file_put_contents($headingsFileCache, $headingsJson);
		
		unset($headingsJson);
		
		#build the UL and cache it as html.
		$ulHtml = buildUL($schoolList);
		
		file_put_contents($ulHmlFile, $ulHtml); 
		
		
	} catch (Exception $e) {
		echo($e->getMessage()); 
	}
}



#if the unitid is set, load the headings svc
if(isset($_REQUEST['UNITID']) && is_numeric($_REQUEST['UNITID'])) {
	
	#get the unit id. 
	$id = $_REQUEST['UNITID'];
	
	//get the school record based on the unitid
	//$record = $listcsv->selectRow('UNITID', $id);
	
	$record = null;
	
	#loop throught the data and match the key with the value.
	foreach($schoolList as $row) {
		
		#loop through each row
		foreach($row as $rKey => $rValue) {
			
			#check if the key and value matches the parameters. 
			if($rKey == 'UNITID' && $rValue == $id) {
				 
				$record = $row; 
			}
		}
	}
	
	//$record = array_combine($headingcsv->getData(), $record);
	/*
	$tableHtml = "";
	$tableHtml .= "<table id='table-school-data' border='1'>";
		
	$tableHtml .= "<thead>";
	$tableHtml .= "<tr>"; 
		foreach($headings = $headingcsv->getData() as $row) {
			$tableHtml .= "<th class='cell'>" . $row['varTitle'] . "</th>"; 
		}
	$tableHtml .= "</tr>"; 
	$tableHtml .= "</thead>";
	
	$tableHtml .= "<tbody>";
	$tableHtml .= "<tr>"; 
		foreach($record as $item) {
			$tableHtml .= "<td>" . $item . "</td>"; 
		}
	$tableHtml .= "</tr>"; 
	$tableHtml .= "</tbody>";
	
	$tableHtml .= "<tfoot>";
	$tableHtml .= "</tfoot>";
	
	$tableHtml .= "</table>";
	*/
	
	#if record was found, build the table
	if($record) {
		$tableHtml = "";
		$tableHtml .= "<table id='table-school-data' border='1'>";
			
		$tableHtml .= "<thead><tr><th>Field Name</th><th>Field Value</th></tr></thead>";
	
		$tableHtml .= "<tbody>";
			$count = 0;
			 
			foreach($record as $item) {
				$tableHtml .= '<tr>';
				$tableHtml .= "<td class='td-name'>" . $headingList[$count]['varTitle'] . '</td>'; 
				$tableHtml .= "<td class='td-value'>" . $item . '</td>';
				$tableHtml .= '</tr>';
				$count++; 
			}
		
		$tableHtml .= "</tbody>";
		
		$tableHtml .= "<tfoot>";
		$tableHtml .= "</tfoot>";
		
		$tableHtml .= "</table>";
		
		#check if its an ajax call, if so, echo the table.
		if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'ajax') {
			echo($tableHtml);
			exit; 
		}
	
	}
}

$end = microtime(true);

echo($end - $start);



function buildUL($list) {
	
	$html = '';
	
	$html .= "<ul id='ul-school-list'>"; 
	
	foreach($list as $row) {
		
		$html .= "<li class='li-item'><a href=./?UNITID=" . $row['UNITID'] . ">" . $row['INSTNM'] . "</a></li>";
		
	}
	
	$html .= "</ul>"; 
	
	return $html; 
}

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>IS218 Programming Challenge 1</title>
		
		<link rel='stylesheet' type='text/css' href='./styles/main.css' />
		<script type='text/javascript' src='./js/main.js'></script>
	</head>
	
	<body>
		<h1>School List</h1>
		<div id='div-school-list'>
			<?php if(file_exists($ulHmlFile)) { include($ulHmlFile); } ?>
			
		</div>
		
		<div id='div-school-data'>
			<?php if(isset($tableHtml)) { echo($tableHtml); } ?>
		</div>
		
	</body>
</html>
