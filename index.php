<?php
#require the csvfile class. 
require_once('class.csvfile.php'); 

$listFile = './data/hd2013.csv'; 
$headingsFile = './data/hd2013varlist.csv'; 

#load the school list csv. 
try {
	$listcsv = new csvfile($listFile, true); 
} catch (Exception $e) {
	echo($e->getMessage()); 
}

#if the unitid is set, load the headings svc
if(isset($_REQUEST['UNITID']) && is_numeric($_REQUEST['UNITID'])) {
	
	#get the unit id. 
	$id = $_REQUEST['UNITID'];
	
	#read and parse the csv file
	try {
		$headingcsv = new csvfile($headingsFile, true); 
	} catch (Exception $e) {
		echo($e->getMessage()); 
	}
	
	//get the school record based on the unitid
	$record = $listcsv->selectRow('UNITID', $id);
	
	//$record = array_combine($headingcsv->getData(), $record);
	
	$tableHtml = "";
	$tableHtml .= "<table id='table-school-data' border='1'>";
	$tableHtml .= "<thead>";
	$tableHtml .= "<tr>"; 
		foreach($headings = $headingcsv->getData() as $row) {
			$tableHtml .= "<th>" . $row['varTitle'] . "</th>"; 
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
}

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<title>IS218 Programming Challenge 1</title>
		
		<link rel='stylesheet' type='text/css' href='/styles/main.css' />
	</head>
	
	<body>
		<h1>School List</h1>
		<div id='div-school-list'>
			<ul id='ul-school-list'>
				<?php foreach($rows = $listcsv->getData() as $row) { ?>
					<li id='li-item'>
						<a href="/?UNITID=<?php echo($row['UNITID']); ?>">
							<?php echo($row['INSTNM']); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<div id='div-school-data'>
			<?php if(isset($tableHtml)) { echo($tableHtml); } ?>
		</div>
		
	</body>
</html>