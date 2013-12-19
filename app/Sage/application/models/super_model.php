<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Super_model extends CI_Model {

    //Tables
    var $target = 'default';
    var $table = 'regs_attendees';
    var $show_id = FALSE;

    function __construct()
    {
        parent::__construct();
        $this->set_target($this->target);
        $this->set_table($this->table);
        $this->set_show_id($this->show_id);
    }
    
    /**
     * @access public
     * @name set_target
     * @version 2.0.0
     * @author desand
     */
    public function set_target($target = 'default'){
    	switch($target){
    		case 'report':{
    			include(APPPATH.'config/db/'.$target.EXT);
    			break;
    		}
    		case 'schema':{
    			include(APPPATH.'config/db/'.$target.EXT);
    			break;
    		}
    		default:
    			include(APPPATH.'config/database'.EXT);
    			$target = 'default';
    			break;
    	}
    	
    	$this->target = $db[$target]['database'];
    }
    
	/**
     * @access public
     * @name set_table
     * @version 2.0.0
     * @author desand
     */
    public function set_table($table){   	
    	$this->table = $table;
    }
    
	/**
     * @access public
     * @name set_show_id
     * @version 2.0.0
     * @author desand
     */
    public function set_show_id($id){   	
    	$this->show_id = $id;
    }
    
	/**
     * @access public
     * @name q
     * @version 2.0.0
     * @author desand
     */
    public function q($q,$return_array = TRUE){
    	if($return_array){
    		return $this->db->query($q)->result('array');
    	}else{
    		return $this->db->query($q);
    	}
    }

    
    ## BASE ##
    function get_detail($id)
    {
    	return $this->db->get_where($this->table, array('id' => $id))->first_row('array');
    }
    
    function get_detail_by_other($conditions = array())
    {
    	return $this->db->get_where($this->table, $conditions)->result('array');
    }
    
    function insert_entry($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
	
	function del_entry($id)
    {
    	return $this->db->delete($this->table, array('id' => $id)); 
    }
    
	function del_entry_by_other($conditions)
    {
    	return $this->db->delete($this->table, $conditions); 
    }

}