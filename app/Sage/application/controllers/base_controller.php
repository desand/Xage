<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_Controller extends CI_Controller 
{
	public $_show_id = false;
	public function __construct()
	{
		parent::__construct();
		if($this->input->get('token')){
			$segments = $this->uri->segment_array();
			$this->_show_id = array_pop(array_slice($segments,-1,1));
			$this->_show_id = is_numeric($this->_show_id)?$this->_show_id:false;
			$this->_show_id = md5('seasonfair'.$this->_show_id)==$this->input->get('token')?$this->_show_id:false;
		}
	}
	/**
	 * 获得该 SHOW ID 的前台指向路径.无则返回默认($base).
	 *
	 * @name	getDiyView
	 * @param	String $base
	 * @param	Integer $show_id
	 * 
	 * @access  public
	 * @return  String
	 * @author	desand
	 * @version	1.0.0
	 */
	public function getDiyView($base,$show_id = false)
	{
		if(!$show_id){return $base;}
		$arr = explode('/',$base);
		$t_action = array_pop($arr);
		$base = implode('/',$arr);
		
		$url = APPPATH.'views/'.$base.'/'.$show_id.'/'.$t_action.EXT;
		return file_exists($url)?$base.'/'.$show_id.'/'.$t_action:$base.'/'.$t_action;
	}
	
	//随机产生六位数密码Begin
	private function randStr($len=6,$format='ALL') { 
		switch($format) { 
			case 'ALL':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; break;
			case 'CHAR':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~'; break;
			case 'NUMBER':
				$chars='0123456789'; break;
			default :
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~'; 
				break;
		}
		mt_srand((double)microtime()*1000000*getmypid()); 
		$password="";
		while(strlen($password)<$len)
			$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}
	
	
	/**
	 * 获得用户的真实IP地址
	 *
	 * @name	real_ip
	 * @access  public
	 * @return  string
	 * @author	desand
	 * @version	1.0.0
	 */
	public function real_ip()
	{
		static $realip = NULL;
		
		if ($realip !== NULL)
		{
			return $realip;
		}
	
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
	
				/* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
				foreach ($arr AS $ip)
				{
					$ip = trim($ip);
	
					if ($ip != 'unknown')
					{
						$realip = $ip;
	
						break;
					}
				}
			}
			elseif (isset($_SERVER['HTTP_CLIENT_IP']))
			{
				$realip = $_SERVER['HTTP_CLIENT_IP'];
			}
			else
			{
				if (isset($_SERVER['REMOTE_ADDR']))
				{
					$realip = $_SERVER['REMOTE_ADDR'];
				}
				else
				{
					$realip = '0.0.0.0';
				}
			}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR'))
			{
				$realip = getenv('HTTP_X_FORWARDED_FOR');
			}
			elseif (getenv('HTTP_CLIENT_IP'))
			{
				$realip = getenv('HTTP_CLIENT_IP');
			}
			else
			{
				$realip = getenv('REMOTE_ADDR');
			}
		}
	
		preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
		$realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
	
		return $realip;
	}
}
?>