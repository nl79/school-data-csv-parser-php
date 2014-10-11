<?php
namespace controller;

class index extends controller{
    
    protected function indexAction () {
        
        #csv filenames
        $listFile = 'data/hd2013.csv'; 
        
        #load the school list csv. 
        $listcsv = new \library\csvfile($listFile, true);
        
        $schoolList = $listcsv->getData();
        
        #view object data array. 
        $vData = array('list' => $schoolList); 
              
        $view = new \view\index($this->_action, $vData);
    }
    
    protected function infoAction() {
        #csv filenames
        $listFile = 'data/hd2013.csv'; 
        $headingsFile = 'data/hd2013varlist.csv';
        
        #load the school list csv. 
        $listcsv = new \library\csvfile($listFile, true);
        
        $schoolList = $listcsv->getData();
        
        #view object data array. 
        $vData = array('list' => $schoolList); 
          
        if(isset($_REQUEST['UNITID']) && is_numeric($_REQUEST['UNITID'])) {
            
                #load the headings csv. 
                $headingcsv = new \library\csvfile($headingsFile, true);
                //$headingList = $headingcsv->getData();
                        
                #extract every varTitle field from the headings collection
                $headings = $headingcsv->getFieldsByName('varTitle'); 
                
                #get the unit id. 
                $id = isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : 0;
                                                           
                $record = $schoolList[$id];
                
                /*
                 * check if the record UNITID matches the UNITID supplied with the query string
                 * to make sure the right record was retrieved.
                 */
                
                #combine the headings and the record array.
                $record = array_combine($headings, $record); 
                
                /*
                #merge the record and the headings into a single array. 
                if(!empty($record) && !empty($headings)) {
                        $dataArray = array(); 
                        
                        #get the row count. 
                        $count = count($record);
                        
                        #loop and merge the arrays. 
                        for($i = 0; $i < $count; $i++ ) {
                                
                                #build a new array and add it to the dataArray
                                $dataArray[] = array(array_shift($headings) , array_shift($record)); 
                        }
                        $vData['record'] = $dataArray; 
                }
                */
                $vData['record'] = array($record); 
        }
        
        $view = new \view\index($this->_action, $vData);
    }

}