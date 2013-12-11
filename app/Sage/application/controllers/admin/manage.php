<?php
require_once APPPATH . 'controllers/base_controller.php';
class Manage extends Base_Controller 
{
	private $url = '';
	private $data = array();
	private $show_id = FALSE;
	
	private $needverify = FALSE;
	private $role = __ROLE__;
	
	public function __construct()
	{
		parent::__construct();
		$this->url = strtolower(__CLASS__.'/'.$this->uri->rsegment(2));
		
		if($this->input->get('key')){
			$this->load->library('encrypt');
			$key = explode('_',$this->input->get('key'));
			if (count($key)==2 && $key[1] == $this->encrypt->encode($key[0],__KEY__)){
				$url = current_url().'/'.$key[0].'?token='.$key[1];
				redirect($url);
			}
		}
		$this->show_id = $this->_show_id;
		
		#verify
		if($this->needverify){
			if(!$this->Verify()){
				redirect('admin/user/logout','refresh');
			}
		}
		
		#site
		$this->load->config('app_base_config');
		$this->data['site'] = $this->config->item('site');
		
		#model
		$this->load->model('super_model');
	}
	/**
	 * @name index
	 * @author desand
	 * @version 2.0.0
	 */
	public function index()
	{
		$this->load->view($this->get_diy_view($this->url,$this->show_id),$this->data);
	}
	public function dashboard(){
		$this->load->view($this->get_diy_view($this->url,$this->show_id),$this->data);
	}
	public function xmlrequest(){
		header( 'Content-type: text/html; charset=utf-8' );
		echo '<script type="text/javascript" src="'.base_url().'material/js/jquery/jquery.js'.'"></script>';
		$target = $this->input->get('tar');
		if($target == ''){die;}
		
		$incfile = APPPATH.'component/'.$target.'/';
		$incfile = file_exists($incfile.$this->show_id.EXT)?$incfile.$this->show_id.EXT:(file_exists($incfile.$this->role.EXT)?$incfile.$this->role.EXT:$incfile.'default'.EXT);
		
		include APPPATH.'core/xanalysis'.EXT;
		switch ($target){
			case 'dashboard':{
				include $incfile;
				
				$i = 1;
				$total = count($$target);
				if($total > 0){
					foreach ($$target as $key => $each){
						$data = $this->regs_model->q($each['q']);
						
						if($i == $total){
							echo '<script type="text/javascript">$("#loading", parent.document).animate({"height":"'.($i/$total*120).'"},function(){setTimeout(function(){window.parent.init()},5);})</script>';
						}else{
							echo '<script type="text/javascript">$("#loading", parent.document).animate({"height":"'.($i/$total*120).'"})</script>';
						}
						echo '<script type="text/javascript">window.parent.showdata("'.$key.'",'.json_encode($data).')</script>';
						@flush();
						@ob_flush();
						usleep(1);
						++$i;
					}
				}else{
					echo '<script type="text/javascript">$("#loading", parent.document).animate({"height":"120"});setTimeout(function(){window.parent.init()},500);</script>';
				}
			
				break;
			}
			default:
				break;
		}
	}
	
	/**
	 * @name import
	 * load import page
	 * 
	 * @author desand
	 * @version 2.0.0
	 */
	public function import()
	{
		$this->load->view($this->get_diy_view($this->url,$this->show_id),$this->data);
	}
}
?>