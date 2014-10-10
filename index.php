<?php
#set errors reporting
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


require_once('library/loader.class.php'); 
spl_autoload_register('library\\loader::load'); 

$controller = new controller\index(); 

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
			<?php 
				#build the ul
				echo(buildUL($schoolList)); 
			?>
			
		</div>
		
		<div id='div-school-data'>
			<?php if(isset($tableHtml)) { echo($tableHtml); } ?>
		</div>
		
	</body>
</html>
