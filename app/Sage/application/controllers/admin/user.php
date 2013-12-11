<?php
require_once APPPATH . 'controllers/base_controller.php';
class User extends Base_Controller 
{
	private $url = '';
	private $data = array();
	
	private $role = __ROLE__;
	
	public function __construct()
	{
		parent::__construct();
		$this->url = strtolower(__CLASS__.'/'.$this->uri->rsegment(2));
		
		#site
		$this->load->config('app_base_config');
		$this->data['site'] = $this->config->item('site');
		
		#model
		$this->load->model('super_model');
	}
	

	/**
	 * 后台管理登录页
	 * 
	 * Step 1.判断是否有Session存在
	 * Step 2.是否有登录提交动作
	 * Step 3.如果无以上的动作,则显示默认的登录页
	 *
	 * @name login
	 * @author desand
	 * @version 2.0.0
	 */
	public function login()
	{
		#有用户session,跳转到后台管理首页
		if($this->session->userdata('userid')
			&& $this->session->userdata('username')
			&& $this->session->userdata('show_id')){
			
			redirect('admin/manage/index/'.$this->session->userdata('show_id'),'refresh');
		}
		
		#是否有登录提交动作
		if($this->input->post()){
			print_r($this->input->post());
			
			//$this->super_model->set();
			die('hi');
		}
		
		
		$this->load->view($this->url,$this->data);
	}
	
	/**
	 * 清空所有SESSION 并重定向到 Login页
	 * 
	 * @name logout
	 * @author desand
	 * @version 2.0.0
	 */
	public function logout()
	{
		$this->session->sess_destroy();//清空所有SESSION
		redirect('admin/user/login','refresh');
	}
	
}
?>