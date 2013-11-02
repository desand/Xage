<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Super_model extends CI_Model {

    //Tables
    var $target;
    var $table;
    var $show_id;

    function __construct()
    {
        parent::__construct();
        $this->setTarget();
        $this->setTable('regs_attendees');
        $this->setShowID(false);
    }
    
    /**
     * @access private
     * @name setTarget
     * @version 2.0.0
     * @author desand
     */
    private function setTarget($target = 'default'){
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
     * @access private
     * @name setTable
     * @version 2.0.0
     * @author desand
     */
    private function setTable($table){   	
    	$this->table = $table;
    }
    
	/**
     * @access private
     * @name setShowID
     * @version 2.0.0
     * @author desand
     */
    private function setShowID($id){   	
    	$this->show_id = $id;
    }
    
	/**
     * @access public
     * @name q
     * @version 2.0.0
     * @author desand
     */
    public function q($q,$returnArray = true){
    	if($returnArray){
    		return $this->db->query($q)->result('array');
    	}else{
    		return $this->db->query($q);
    	}
    }
    
    /**
     * @access public
     * @name issetTable
     * @version 2.0.0
     * @author desand
     */
    public function issetTable($db,$table){
   		$q = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='".$db."' and TABLE_NAME='".$table."'";
        if($this->q($q)){
        	return true;
        }
        return false;
    }
    
    /**
     * @access public
     * @name getShowTable
     * @version 2.0.0
     * @author desand
     */
    public function getShowTable($db,$table,$show_id){
    	if(issetTable($db,$table.'_'.$show_id)){
    		return $table.'_'.$show_id;
    	}else{
    		return $table;
    	}
    }
    
    /* BASE */
    function get_detail($id,$type = false)
    {
    	return $this->db->get_where($this->table, array($this->id => $id))->first_row('array');
    }
    
    function get_detail_by_other($conditions,$type = false)
    {
    	return $this->db->get_where($this->table, $conditions)->result('array');
    }
    
    function insert_entry($data,$type = false)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
	
	function del_entry($id,$type = false)
    {
    	return $this->db->delete($this->table, array('id' => $id)); 
    }
    
	function del_entry_by_fid($fid)
    {
    	return $this->db->delete($this->answer, array('fid' => $fid)); 
    }

}