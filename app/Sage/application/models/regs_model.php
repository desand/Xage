<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regs_model extends CI_Model {

	//regs_attendees
    var $id = 'id';
    var $barcode = 'barcode';
    
    var $mobile = 'mobile';
    var $email = 'email';
    var $reg_date = 'Reg_Date';
    var	$reg_time = 'Reg_Time';
    var $reg_counter = 'Reg_Counter';
    var $addtioncode = 'addtioncode';
    var	$cat = 'Cat';
    var $submit_date = 'submit_date';
    var	$submit_time = 'submit_time';
    var $submit_counter = 'submit_counter';
    
    var $ticket_id = 'ticket_id';
    var $group_id = 'group_id';
    var	$show_id = 'show_id';
    
    //Tables
    var $table = 'regs_attendees';
    
    var $fields = 'regs_fields';
    var $fields_groups = 'regs_fields_groups';
    var $answer = 'regs_answer';
    
    var $history = 'regs_attendees_history';
    var $editmark = 'regs_editmark_attendees';
    var $raupload = 'regs_attendees_upload';

    function __construct()
    {
        parent::__construct();        
    }
    
    function setShowTable($show_id = NULL){
   		if($show_id){
        	include(APPPATH.'config/database'.EXT);
        	        	
        	$tname = $this->table.'_'.$show_id;
        	$q = "select TABLE_NAME from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='".$db['default']['database']."' and TABLE_NAME='".$tname."'";
        	if($this->q($q)){
        		$this->table = $tname;
        		$this->history = $this->history.'_'.$show_id;
        	}
        }
    }
    
	function xclone($from,$to,$data = false)
    {
    	#$table_tar = array('fields_groups','fields','answer');
    	    	
    	#fields_groups start
    	$tar = 'fields_groups';
    	$list = $this->get_list($from,$tar);
    	$fgroups = array();
    	if(is_array($list)&&count($list)>0){
    		foreach ($list as $each) {
    			$fromid = $each['id'];
    			unset($each['id']);
    			$each['show_id'] = $to;
    			$fgroups[$fromid] = $this->insert_entry($each,$tar);
    		}
    	}
    	#fields_groups end
    	
    	#fields start
    	$tar = 'fields';
    	$list = $this->get_list($from,$tar);
    	$fs = array();
    	$ffs = array();
    	if(is_array($list)&&count($list)>0){
    		foreach ($list as $each) {
    			$fromid = $each['id'];
    			$ffs[] = $fromid;
    			unset($each['id']);
    			$each['show_id'] = $to;
    			
    			#status
    			$fstatus = json_decode($each['status']);
    			$tstatus = array();
    			foreach ($fstatus as $sk=>$sv){
    				$tstatus[$data[$sk]] = $sv;
    			}
    			$each['status'] = json_encode($tstatus);
    			$each['group'] = isset($fgroups[$each['group']])?$fgroups[$each['group']]:$each['group'];
    			$fs[$fromid] = $this->insert_entry($each,$tar);
    		}
    	}
    	#fields end
    	
    	#answer start
    	$tar = 'answer';
    	$list = $this->get_answers_by_in(implode(',',$ffs));
    	if(is_array($list)&&count($list)>0){
    		foreach ($list as $each) {
    			unset($each['id']);
    			$each['fid'] = isset($fs[$each['fid']])?$fs[$each['fid']]:$each['fid'];
    			$this->insert_entry($each,$tar);
    		}
    	}
    	#answer end
    }
    
	function u($q)
    {
    	$q = str_replace('`regs_attendees`','`'.$this->table.'`',$q);
    	$q = str_replace('`regs_attendees_history`','`'.$this->history.'`',$q);
    	return $this->db->query($q);
    }
    function q($q)
    {
    	$q = str_replace('`regs_attendees`','`'.$this->table.'`',$q);
    	$q = str_replace('`regs_attendees_history`','`'.$this->history.'`',$q);
    	return $this->db->query($q)->result('array');
    }
	public function c($w)
    {
    	$q = "
		SELECT count( * ) AS ctotal,count(`Reg_Date`) AS creg 
		FROM `".$this->table."`
		WHERE $w";
    	return $this->db->query($q)->result('array');
    }
    
    
	/**
	 * 查询该活动Regs相关资料(嘉宾信息 or 注册字段 等)
	 * @name get_list
	 * @param Array $show_id
	 * @return Boolen false/Array
	 * @author desand
     * @version 1.0.0
	 */
	function get_list($show_id,$type = false)
    {
    	$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
    	return $this->db->get_where($this->$table, array($this->show_id => $show_id))->result('array');
    }
    
    function list_attendees($show_id,$page = 1,$rows = 20){
    	
    	$this->db->from($this->table);
    	$this->db->where($this->show_id,$show_id);
    	
    	if($page&&$rows){
			$f = ($page-1)*$rows;
			$this->db->limit($rows,$f);
		}
    	$this->db->order_by('id asc');
    	$query = $this->db->get();
    	
    	return $query->result('array');
    }
    
	public function count_attendees($show_id)
    {
    	$q = "
		SELECT count( * ) AS ctotal,count(`Reg_Date`) AS creg 
		FROM `".$this->table."`
		WHERE `show_id` = $show_id";
    	return $this->db->query($q)->result('array');
    }
    
	public function count_values($key,$show_id)
    {
    	$q = "
		SELECT count( `$key` ) AS ctotal,`$key`
		FROM `".$this->table."`
		WHERE `show_id` = $show_id GROUP BY $key";
    	return $this->db->query($q)->result('array');
    }
    
    /**
	 * 查询问题的答案
	 * @name get_answers
	 * @param Array $fid
	 * @return Array / Boolen false
	 * @author desand
     * @version 1.0.0
	 */
    function get_answers($fid)
    {
    	return $this->db->get_where($this->answer, array('fid' => $fid))->result('array');
    }
	public function get_answers_by_in($sql)
    {
    	$q = "
		SELECT *
		FROM `".$this->answer."`
		WHERE `fid` IN($sql) ORDER BY `id` asc";
    	
    	return $this->db->query($q)->result('array');
    }
    
	/**
	 * 查询该嘉宾详细数据
	 * @name get_detail
	 * @param Array $id
	 * @return Boolen true/false
	 * @author desand
     * @version 1.0.0
	 */
    function get_detail($id,$type = false)
    {
   		$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
    	return $this->db->get_where($this->$table, array($this->id => $id))->first_row('array');
    }
    
    function get_detail_by_other($conditions,$type = false)
    {
    	$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
    	return $this->db->get_where($this->$table, $conditions)->result('array');
    }
    
    function insert_entry($data,$type = false)
    {
    	$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
        $this->db->insert($this->$table, $data);
        return $this->db->insert_id();
    }
    
    function insert_attendee_entry($data,$prebarcode = false){
    	if(!$prebarcode) return false;
    	$this->db->insert($this->table, $data);
    	$id = $this->db->insert_id();
    	$this->db->update($this->table, array('barcode'=>''.($prebarcode+$id)), array('id' => $id));
    	
        return $id;
    }
    
	function update_entry($data,$id,$type = false,$pwd = false,$uid = false,$changemark = false)
    {
    	$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
    	
    	#如果对regs_attendees作更新操作,则先备份数据到regs_attendees_history
    	if($table == 'table'){
    		$detail = $this->db->get_where($this->$table, array($this->id => $id))->first_row('array');
    		if(!$uid){
    			$detail['uid'] = $this->session->userdata('userid')?$this->session->userdata('userid'):NULL;
    		}
    		$detail['rid'] = $detail['id'];
    		$detail['insert_date'] = date('Y-m-d');
    		$detail['insert_time'] = date('H:i:s');
    		unset($detail['id']);
    		if($pwd){
    			$detail['password'] = $pwd;
    		}
    		if($changemark){
    			$detail['editmark'] = $changemark;
    		}
    		$this->db->insert($this->history, $detail);
    	}
        return $this->db->update($this->$table, $data, array('id' => $id));
    }
	
	function del_entry($id,$type = false)
    {
    	$table = 'table';
    	if($type&&is_string($type)){
    		$table = $this->getTableByType($type);
    	}
    	return $this->db->delete($this->$table, array('id' => $id)); 
    }
    
	function del_entry_by_fid($fid)
    {
    	return $this->db->delete($this->answer, array('fid' => $fid)); 
    }
    
    public function get_fields_total_details($show_id)
    {
    	$q = "SELECT `regs_fields`.`id` AS id, `regs_fields`.fieldname, `regs_fields`.displayname_cn, `regs_fields`.displayname_en, `regs_fields`.type, `regs_fields`.status, `regs_fields`.sort, `regs_fields`.group, `regs_fields`.`show_id` AS show_id, `regs_fields_groups`.groupname
FROM `regs_fields`
LEFT JOIN `regs_fields_groups` ON `regs_fields`.`group` = `regs_fields_groups`.`id`
AND `regs_fields_groups`.`show_id` = `regs_fields`.`show_id`
WHERE `regs_fields`.`show_id`=$show_id order by `regs_fields`.group asc,sort asc";
    	return $this->db->query($q)->result('array');
    }
    
    /**
     * 返回fieldgroup ID
     * @name new_fieldgroup
     * @param String $groupname
     * @param Integer $show_id
     * @return Boolen/Array
     * @author desand
     * @version 1.0.0
     */
    public function new_fieldgroup($groupname,$show_id)
    {
    	$check = $this->db->get_where($this->fields_groups, array('groupname' => $groupname,$this->show_id => $show_id))->first_row('array');
    	if($check){
    		return $check['id'];
    	}else{
    		$data = array(
    			'groupname' => $groupname,
    			'show_id' => $show_id
    		);
    		return $this->insert_entry($data,'fields_groups');
    	}
    }
    
	/**
     * 返回Table Name
     * @name getLastField
     * @param Integer $show_id
     * @return Boolen/Array
     * @author desand
     * @version 1.0.0
     */
    public function getLastField($show_id)
    {
    	$q = 'SELECT `fieldname` FROM '.$this->fields.' WHERE `show_id` = '.$show_id;
    	$q .= ' ORDER BY `id` desc LIMIT 0,1';
    	
    	return $this->db->query($q)->result('array');
    }
    
    /**
     * 返回Ticket 售卖情况
     * @name getTicketSold
     * @param Integer $show_id
     * @return Boolen/Array
     * @author desand
     * @version 1.0.0
     */
    public function getTicketSold($show_id)
    {
    	$q = 'SELECT count(*) as ctotal,ticket_id FROM '.$this->table.' WHERE `show_id` = '.$show_id;
    	$q .= ' GROUP BY ticket_id';
    	
    	return $this->db->query($q)->result('array');
    }
    
    /**
     * 返回Table Name
     * @name getTableByType
     * @param Array $type
     * @return String
     * @author desand
     * @version 1.0.0
     */
    private function getTableByType($type)
    {
    	return $type;
    }

}


/* End of file regs_model.php */
/* Location: ./application/model/regs_model.php */