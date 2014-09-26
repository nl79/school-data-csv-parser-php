<?php 

class csvfile {


	private $_filepath = null; 		#path to the csv file. 
	
	private $_headExists = false; 	#flag that is set if the file has a heading row. 
	
	private $_headings = null; 		#array containing the headings if exist. 
	
	private $_data = array(); 		#array containing the data rows. 

	public function __construct($filepath, $headings = false) {
	
			#validate the filepath and headings.  
			$this->_filepath = is_string($filepath) && !empty($filepath) ? $filepath : null;
			
			$this->_headExists = is_boolean($headings) ? $headings : false;  
			
			#load the csv file
			$this->loadFile(); 
	
	}

	/*
	/@method loadFile() - Validate that the csv file exists and build the array. 
	/@return Boolean - returns true on success or false on failure. 
	*/
	private function loadFile() {
		#check if the file exists 
		if(is_string($this->_filepath) && 
			file_exists($this->_filepath) &&
			is_file($this->_filepath)) {
			
			#open the csv file
			$file = fopen($this->_filepath, 'r'); 
			
			
			#flag that controls if the headings have been read
			$hRead = false; 
			
			#extract and parse each line
			while($row = fgetcsv($file)) {
				#check if the headings flag is set, and if headings have been read.
				if($this->_headExists && $hRead == false) {
				
					#set the row as the headings array
					$this->_headings = $row; 
					
					#set the read flag to true
					$hRead = true; 
				} else {
					#if the heading is set combine the row and head array. 
					if($this->headExists && 
						is_array($this->_headings) && 
						!empty($this->_headings)) {
					
						#combine the arrays. 
						$this->_data[] = array_combine($this->_headings, $row); 
					
					} else {
						$this->_data[] = $row; 
					}
				
				}
				
			}

		}
	}
}
