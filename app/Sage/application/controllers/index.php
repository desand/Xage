<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * @name index
	 * @author desand
	 * @version 2.0.0
	 */
	public function index()
	{
		//$param = $this->uri->segment_array();
		//print_r($param);
		echo 'top';
		//$url = 'default/index';
		//$this->load->view($url);
	}
	
	public function top(){
		echo 'hi';
	}
	
	/**
	 * 验证码
	 *
	 * @name ValidateCode
	 * @author desand
	 * @version 2.0.0
	 */
	public function validatecode()
	{
	
		$this->load->file(APPPATH.'/libraries/validatecode/validatecode.php');
		$vd = new ValidateCode();
		$vd->createimg();
	
		$newdata = array(
			'validatecode' => strtolower($vd->getCode())
		);
	
		$this->session->set_userdata($newdata);
		$vd->outPut();
	}
}
?>