<?php
namespace view;

class index extends view {
    
    public function indexView($data) {
        
        #build the row table.
        $tableHtml = "";
        if(isset($data['record']) && is_array($data['record'])) {
            $tableHtml = \library\html::table(array('id'=>'table-school-data',
                                           'border' => '1',
                                           'data' => $data['record']), 'h');
        }
    
        #if its an ajax call, echo out only the table html. 
        if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] == 'ajax' && !empty($tableHtml)) {
            $this->_output .= $tableHtml;
            
            #end the method execution
            return; 
        }
        
        
        $this->_output .= $this->buildUL($data['list']);
        $this->_output .= "<div id='div-school-data'>" . $tableHtml . '</div>';
      
    }
    
    
    private function buildUL($list) {
                $html = '';
                
                $html .= "<div id='div-school-list'>
                            <h1>School List</h1>    
                            <ul id='ul-school-list'>"; 
                
                foreach($list as $row) {
                
                        #build the anchor tag.
                        $a = \library\html::a(array('href' => "./?UNITID=" . $row['UNITID'],
                                              'data' => $row['INSTNM']));
                        $li = \library\html::li(array('class' => 'li-item',
                                             'data' => $a)); 
                        $html .= $li; 
                        
                }
                
                $html .= "</ul></div>"; 
                
                $this->_output .= $html; 
    }
     
}