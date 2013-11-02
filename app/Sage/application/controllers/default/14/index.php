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
		echo 'default/14/top';
		$this->load->view('default/'.strtolower(__FUNCTION__));
	}
	
	public function top(){
		echo 'hi';
	}
}
?>