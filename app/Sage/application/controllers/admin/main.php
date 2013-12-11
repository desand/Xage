<?php
require_once APPPATH . 'controllers/base_controller.php';
class Main extends Base_Controller 
{
	private $url = '';
	private $data = array();
	private $show_id = false;
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
		
		#site
		$this->load->config('app_base_config');
		$this->data['site'] = $this->config->item('site');
		
		#model
		$this->load->model('regs_model');
	}
	/**
	 * @name index
	 * @author desand
	 * @version 2.0.0
	 */
	public function index()
	{
		
		$this->load->view($this->getDiyView($this->url,$this->show_id),$this->data);
	}
}
?>