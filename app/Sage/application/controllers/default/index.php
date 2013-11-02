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
		echo 'default/top';
		
		//$url = $this->getDiyView('default/'.strtolower(__FUNCTION__),$this->show_id);
		$this->load->view('default/'.strtolower(__FUNCTION__));
	}
}
?>