<?php
require_once APPPATH . 'controllers/base_controller.php';
class Manage extends Base_Controller 
{
	private $url = '';
	private $data = array();
	private $show_id = FALSE;
	
	private $needverify = FALSE;
	private $role = __ROLE__;
	
	private $thisfields = array('barcode','company','A','B','C','D','E','name','F','G','H','I','J','mobile','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ','EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EW');
	
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
		$this->data['show_id'] = $this->show_id;
		
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
	/**
	 * @name sign
	 * load sign page
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function sign()
	{
		$this->load->view($this->get_diy_view($this->url,$this->show_id),$this->data);
	}
	/**
	 * @name loadvisadata
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function loadvisadata()
	{
		if(!$this->input->post('barcode')){
			echo json_encode(array('error'=>'Invaild Data'));
			die();
		}
		$barcode = $this->input->post('barcode');
		
		$q = "SELECT a.*,b.`id`,b.`datetime`,b.`location`,b.`remark`,b.`step`,b.`time_a`,b.`time_b`,b.`time_c`,b.`time_d`,b.`insertdatetime` FROM(
				SELECT `id`,`".implode('`,`',$this->thisfields)."` FROM `regs_attendees_".$this->show_id."` WHERE `barcode`='".$barcode."') a LEFT JOIN (SELECT * FROM `visa` WHERE `barcode`='".$barcode."' AND `show_id`='".$this->show_id."') b ON a.barcode = b.barcode";
		
		$data['data'] = $this->super_model->q($q);
		if(!isset($data['data'][0])){
			echo json_encode(array('error'=>'No Data'));
			die();
		}
		
		$data['data'] = $data['data'][0];
		echo json_encode($data);
		die();
	}
	
	public function visasteps()
	{
		$post = $this->input->post();
		if(!isset($post['step'])){
			echo json_encode(array('error'=>'Invaild Data'));
			die();
		}
		switch ($post['step']){
			case '1':{
				$post['datetime'] = $post['date'].' '.$post['time'];
				unset($post['date']);unset($post['time']);
				
				$q = "SELECT * FROM `visa` WHERE `show_id`='".$this->show_id."' AND `barcode`='".$post['barcode']."'";
				$result = $this->super_model->q($q);
				if(isset($result[0])){
					$post['insertdatetime'] = date('Y-m-d H:i:s');
					$q = 'UPDATE `visa` SET '.$this->drawUndateq($post).' WHERE `id`=\''.$result[0]['id'].'\'';
					$this->super_model->q($q,FALSE);
				}else{
					$post['insertdatetime'] = date('Y-m-d H:i:s');
					$post['show_id'] = $this->show_id;
					$q = 'INSERT INTO `visa` ('.$this->drawInsertq($post);
					$this->super_model->q($q,FALSE);
				}
				$content = "尊敬的完美贵宾，您好！您的赴美签证已完成约签，请您于".$post['datetime']."时，前往".$post['location']."城市的美国使（领）馆，携带面签辅助资料（具体参考网站公示），我们的工作人员将在48小时之内与您取得联系并告知详情，感谢！".$post['remark']." 完美活动国旅会务组 ";
				
				#使用用例
				require_once APPPATH . 'libraries/FT_SMS_Class.php';
				$u = new FT_SMS();
				#短信发送
				$rs = $u->SendSMS(array('13533533509','13609738572','13798176672','13826019412'),'TEST CONTENTS'.time());
				#余额查询
				//$rs = $u->overage();
				#状态查询
				//$rs = $u->statusApi();
				#上行短信
				//$rs = $u->callApi();
				#返回数组结果
				//print_r($rs);
				break;
			}
			case '2':{
				$post['time_a'] = date('Y-m-d H:i:s');
				$barcode = $post['barcode'];
				unset($post['barcode']);
				$q = 'UPDATE `visa` SET '.$this->drawUndateq($post).' WHERE `barcode`=\''.$barcode.'\'';
				$this->super_model->q($q,FALSE);
				break;
			}
			case '3':{
				$post['time_b'] = date('Y-m-d H:i:s');
				$barcode = $post['barcode'];
				unset($post['barcode']);
				$q = 'UPDATE `visa` SET '.$this->drawUndateq($post).' WHERE `barcode`=\''.$barcode.'\'';
				$this->super_model->q($q,FALSE);
				break;
			}
			case '4':{
				$post['time_c'] = date('Y-m-d H:i:s');
				$barcode = $post['barcode'];
				unset($post['barcode']);
				$q = 'UPDATE `visa` SET '.$this->drawUndateq($post).' WHERE `barcode`=\''.$barcode.'\'';
				$this->super_model->q($q,FALSE);
				break;
			}
			case '5':{
				$post['time_d'] = date('Y-m-d H:i:s');
				$barcode = $post['barcode'];
				unset($post['barcode']);
				$q = 'UPDATE `visa` SET '.$this->drawUndateq($post).' WHERE `barcode`=\''.$barcode.'\'';
				$this->super_model->q($q,FALSE);
				break;
			}
			default:
				break;
		}
		die();
	}
	
	/**
	 * @name listmatch
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function listmatch()
	{
		if(!$this->input->post('id')){
			echo json_encode(array('error'=>'Invaild Data'));
			die();
		}
		ini_set("memory_limit","512M");
		set_time_limit(300);
		
		$this->data['keys'] = array('D','name','G','H','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM');
		$this->data['vals'] = array('完美卡号','出席人姓名','性别','身份证号','护照姓名','护照英文名','性别','出生日期','国籍','外籍','护照号码','签发日期','有效期至','出生地','出生地英文','护照签发地','签护照发地英文','快递单号');
		
		$this->data['atkeys'] = array('D','name','G','H','AC');
		$this->data['dkeys'] = array('Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM');
		
		$this->data['attendee'] = $this->super_model->q("SELECT `id`,`".implode('`,`',$this->data['keys'])."` FROM `regs_attendees_".$this->show_id."` WHERE `operator` IS NULL");
		
		$this->super_model->set_table('analysis_upload_files');
		$this->data['details'] = $this->super_model->get_detail($this->input->post('id'));
		
		$this->session->set_userdata(array('thisexcel'=>$this->data['details']['filename']));
		
		$this->data['id'] = $this->input->post('id');
		
		
		$this->load->view($this->get_diy_view($this->url,$this->show_id),$this->data);
	}
	/**
	 * @name donematch
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function donematch()
	{
		$post = $this->input->post();
		if(isset($post['id']) && is_numeric($post['id'])){
			
			$q = 'UPDATE `analysis_upload_files` SET `status`=\'1\' WHERE `id`=\''.$post['id'].'\'';
			$result = $this->super_model->q($q,FALSE);
				
			if($result){
				echo json_encode(array('id'=>$post['id']));
			}else{
				echo json_encode(array('error'=>'UPDATE DB Error'));
			}
		}else{
			echo json_encode(array('error'=>'Invaild Data'));
		}
		exit;
	}
	/**
	 * @name domatch
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function domatch()
	{
		$post = $this->input->post();
		if(isset($post['id']) && isset($post['params']) && count($post['params'])>0){
			$post['params']['operator'] = 'match';
			$post['params']['submit_counter'] = $this->session->userdata('thisexcel');
			$post['params']['submit_date'] = date('Y-m-d');
			$post['params']['submit_time'] = date('H:i:s');
			
			$q = 'UPDATE `regs_attendees_'.$this->show_id.'` SET '.$this->drawUndateq($post['params']).' WHERE `id`=\''.$post['id'].'\'';
			$result = $this->super_model->q($q,FALSE);
			
			if($result){
				echo json_encode(array('ori'=>$post['ori']));
			}else{
				echo json_encode(array('error'=>'UPDATE DB Error'));
			}
		}else{
			echo json_encode(array('error'=>'Invaild Data'));
		}
		exit;
	}
	public function domatchall()
	{
		$posts = $this->input->post();
		if(count($posts)>0){
			$return = array();
			foreach($posts as $post){
				if(isset($post['id']) && isset($post['params']) && count($post['params'])>0){
					$q = 'UPDATE `regs_attendees_'.$this->show_id.'` SET '.$this->drawUndateq($post['params']).' WHERE `id`=\''.$post['id'].'\'';
					$result = $this->super_model->q($q,FALSE);
						
					if($result){
						$return[] = array('ori'=>$post['ori']);
					}
				}
			}
			if(count($return)>0){
				echo json_encode($return);
			}else{
				echo json_encode(array('error'=>'Invaild Data'));
			}
		}else{
			echo json_encode(array('error'=>'Invaild Data'));
		}
		exit;
	}
	
	/**
	 * @name analysis
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function analysis()
	{
		$this->load->helper('file');
		$uploadurl = 'templates/assets/jquery-file-upload/server/php/files/';
		$files = get_filenames($uploadurl);
		$accept_file_types = array('xls','xlsx');
		
		$details = array();
		foreach($files as $i=>$file){
			#忽略不是 Excel 类型的文件
			if(!in_array(pathinfo($file,PATHINFO_EXTENSION),$accept_file_types)){
				unset($files[$i]);
			}else{
				#查找 Excel 文件是否被分析过
				$result = $this->super_model->q("SELECT `id`,`datetime`,`volume`,`status`,`result` FROM `analysis_upload_files` WHERE `filename`='".$file."'");
				if(count($result)>0 && isset($result[0])){
					$result[0]['result'] = json_decode($result[0]['result'],true);
					$details[$i] = $result[0];
				}
			}
		}
		echo json_encode(array('files'=>$files,'details'=>$details));
		die();
	}
	
	/**
	 * @name doanalysis
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function doanalysis()
	{
		if(!$this->input->post('id')){
			echo json_encode(array('error'=>'Invaild Data'));
			die();
		}
		ini_set("memory_limit","512M");
		set_time_limit(300);
		
		$this->thisfields = array('D','name','G','H','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM');
		$attendee = $this->super_model->q("SELECT `".implode('`,`',$this->thisfields)."` FROM `regs_attendees_".$this->show_id."` WHERE `operator` IS NULL");
		//print_r($attendee);exit;
		
		$this->super_model->set_table('analysis_upload_files');
		$details = $this->super_model->get_detail($this->input->post('id'));
				
		$jsondata = json_decode($details['data'],true);
		if($jsondata == false || count($jsondata)<=0){
			echo json_encode(array('error'=>'Data Have Some Invaild Characters(数据中含有非法字符，请确保单元格内数据没有换号符)!'));
			die();
		}
		if(count($attendee)<=0){
			echo json_encode(array('error'=>'No Attendees Data!'));
			die();
		}
		//print_r($jsondata);
		
		$atom = array();
		//$filter = array('ZA','ZB','ZC','ZD','ZE','ZF');
		//$tarfilter = array();
		
		/*foreach($jsondata['key'] as $key=>$val){
			if(in_array($val,$filter)){
				unset($jsondata['key'][$key]);
				unset($jsondata['val'][$key]);
				$tarfilter[] = $key;
			}
		}*/
		
		foreach($jsondata['data'] as $each){
			/*foreach($tarfilter as $tf){
				unset($each[$tf]);;
			}*/
			$atom[] = array_combine($jsondata['key'], $each);
		}
		//print_r($atom);
		$matcher = array(
			'name'=>'Z',
			'AC'=>'AC',
			'G'=>'AB',
		);
		
		$match_result = $this->_array_match($attendee,$atom,$matcher);
		
		$return = array('matchno'=>count($match_result['matchno']),
						'matchone'=>count($match_result['matchone']),
						'matchmore'=>count($match_result['matchmore']));
		
		$q = "UPDATE `analysis_upload_files` SET `result`='".$this->JSON($return)."',`result_details`='".$this->JSON($match_result)."' WHERE `id`='".$this->input->post('id')."'";
		$result = $this->super_model->q($q,FALSE);
		
		if($result){
			/*
			 * $result[$ori_k] = array(
				'matchno'=>array(),
				'matchone'=>array(),
				'matchmore'=>array()
			);
			 * */
			echo json_encode($return);
		}else{
			echo json_encode(array('error'=>'UPDATE DB Error'));
		}
		die();
	}
	
	/**
	 * @name doindb
	 * type ajax
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	public function doindb()
	{
		if(!$this->input->post('filename')){
			echo json_encode(array('error'=>'No File'));
			die();
		}
		ini_set("memory_limit","512M");
		set_time_limit(300);
		
		$url = 'templates/assets/jquery-file-upload/server/php/files/'.$this->input->post('filename');
		$data = $this->load_excel_file($url);
		
		
		$this->thisfields = array('B','AF','AI','AG','AK','AL','AH','Z','AA','AB','AC','AD','AM');
		$thisfields = array_merge($this->thisfields,array('ZA','ZB','ZC','ZD','ZE','ZF'));
		
		#判断数据是否符合格式
		if(intval($data['count'])>0 && count(array_diff($data['key'],$thisfields)) == 0){
			$datetime = date('Y-m-d H:i:s');
			$q = "INSERT INTO `analysis_upload_files` (`filename`,`datetime`,`volume`,`data`) VALUES ('".$this->input->post('filename')."','".$datetime."','".$data['count']."','".$this->JSON($data)."')";
			$result = $this->super_model->q($q,FALSE);
			if($result){
				echo json_encode(array('volume'=>$data['count'],'id'=>mysql_insert_id(),'datetime'=>$datetime));
			}else{
				$msg = json_encode(array('error'=>'Insert DB Error'));
				$q = "INSERT INTO `analysis_upload_files` (`filename`,`datetime`,`volume`,`result`) VALUES ('".$this->input->post('filename')."','".$datetime."','".$data['count']."','".$msg."')";
				$this->super_model->q($q,FALSE);
				echo $msg;
			}
		}else{
			echo json_encode(array('error'=>'File Not Match'));
		}
		
		die();
	}
	
	public function exportrequest()
	{
		if(!$this->input->get('id') || !$this->input->get('key')){
			echo 'Invaild Data';
			die();
		}		
		error_reporting(E_ERROR);
		ini_set("memory_limit","512M");
		set_time_limit(300);
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		
		$this->super_model->set_table('analysis_upload_files');
		$details = $this->super_model->get_detail($this->input->get('id'));
		
		$vals = array("团号","护照号码","出生地","签发日期","发证机关","发证机关拼音","护照到期","中文姓名","中文姓","中文名","汉语拼音","拼音姓","拼音名","性别","出生日期","国籍","备注","输入时间","照片地址");
		$key = $this->input->get('key');
		
		$result_details = json_decode($details['result_details'],true);
		if(!isset($result_details[$key])){
			echo 'Invaild Data';
			die();
		}
		
		require_once APPPATH . 'libraries/PHPExcel/PHPExcel.php';
		$result_details = $result_details[$key];
		
		//print_r($result_details);
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator('Seasonfair')
									->setLastModifiedBy('Seasonfair')
									->setTitle('data')
									->setSubject('data')
									->setDescription('Seasonfair export data')
									->setKeywords('Seasonfair export data')
									->setCategory('data');
		
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->fromArray($vals, NULL, 'A1');
		$objPHPExcel->getActiveSheet()->fromArray($result_details, NULL, 'A2');
		$objPHPExcel->setActiveSheetIndex(0);
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="data_'.$key.'_'.date('YmdHis').'.xlsx"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	/* public function exportimportrequest()
	{
		//print_r(json_decode(json_encode($_POST)));
	
		$params = $this->input->post();
		header("Content-Type:text/html;charset=utf-8");
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=data.xls");
		echo '<table border="1">'.$params['html'].'</table>';
		//print_r($params);
		exit;
	} */
	/**
	 * @name load_import_file
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	private function load_excel_file($url)
	{
		error_reporting(E_ERROR);
	
		require_once APPPATH . 'libraries/PHPExcel/PHPExcel.php';
		ini_set("memory_limit","512M");
		set_time_limit(300);
		
		$inputFileType = PHPExcel_IOFactory::identify($url);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		//$objReader->setReadDataOnly(true);
	
		$objPHPExcel = $objReader->load($url);
		//$sheet_count = $objPHPExcel->getSheetCount();
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,false,true,false);
		$result['val'] = array_chunk($sheetData[0],19);
		$result['val'] = $result['val'][0];
		unset($sheetData[0]);
		
		foreach($sheetData as $i=>$each){
			$each = array_chunk($each,19);
			$each = $each[0];
			if(trim($each[7]) != ''){
				$each[3] = $this->_mygmdate($each[3]);
				$each[6] = $this->_mygmdate($each[6]);
				$each[14] = $this->_mygmdate($each[14]);
				$each[17] = $this->_mygmdate($each[17]);
				//$each[3] = date('Y-m-d',strtotime($each[3]));
				//$each[14]=PHPExcel_Style_NumberFormat::toFormattedString($each[14]);
				//$each[14]=gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($each[14]));
				//$each[17]=gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($each[17]));
					
				$each[16] = str_replace('_x000D_','',str_replace(array("\r\n", "\r", "\n"), '', $each[16]));
				foreach ($each as $j=>$v){
					$each[$j] = trim($v);
				}
				$sheetData[$i] = $each;
			}else{
				unset($sheetData[$i]);
			}
		}
		
		
		//print_r($sheetData);exit;
	
		$result['count'] = count($sheetData);
		$result['key'] = array('B','AF','AI','AG','AK','AL','AH','Z','ZA','ZB','AA','ZC','ZD','AB','AC','AD','AM','ZE','ZF');
		$result['data'] = $sheetData;

		return $result;
	}
	private function _mygmdate($str)
	{
		if(stripos($str, '/')){
			return date('Y-m-d',strtotime($str));
		}
		if(stripos($str, '-') && strlen($str) == 8){
			$str = explode('-',$str);
			if(intval($str[2]) <= 40){
				return '20'.$str[2].'-'.$str[0].'-'.$str[1];
			}else{
				return '19'.$str[2].'-'.$str[0].'-'.$str[1];
			}
		}
		
		return $str;
	}
	
	/**
	 * @name _array_match
	 * @author desand
	 * @version 2.0.0
	 * 
	 * 函数用于
	 * 通过对应关系 $matcher 的配置
	 * 来找出两个二维数组间的相同数据
	 * 从而将 $atom 分好类, 并返回一个 三维数据
	 * 
	 * @param Array $ori eg:
	 * $ori = array(
	 * 	0=>array('name'=>'姓名','AC'=>'出生日期','G'=>'性别'),
	 *  1=>.....
	 * );
	 * @param Array $atom
	 * $atom = array(
	 * 	0=>array('Z'=>'姓名','AC'=>'出生日期','AB'=>'性别'),
	 *  1=>.....
	 * );
	 * @param Array $matcher eg:
	 * $matcher = array(
			'name'=>'Z',
			'AC'=>'AC',
			'G'=>'AB',
		);
	 * @return Array $result eg:
	 * $result = array(
			'matchno'=>array(),
			'matchone'=>array(),
			'matchmore'=>array()
		);
	 */
	private function _array_match($ori = FALSE,$atom = FALSE,$matcher = array('barcode'=>'barcode'))
	{
		$t_ori = array();
		$result = array();
		foreach($matcher as $ori_k => $atom_k){
			foreach($ori as $each){
				$t_ori[$ori_k][] = $each[$ori_k];
			}
		}
		$result = array(
			'matchno'=>array(),
			'matchone'=>array(),
			'matchmore'=>array()
		);
		//print_r($t_ori);
		$i = 0;
		$all = count($matcher);
		
		$pkey = current($matcher);
		//print_r($t_ori);
		$matchmore = array();
		foreach($matcher as $ori_k => $atom_k){
			foreach($atom as $k=>$each){
				$matchintersect = array_intersect($t_ori[$ori_k], array($each[$atom_k]));
				$ismatch = count($matchintersect);
				if($i == 0){
					if($ismatch == 0){
						$result['matchno'][$k] = $each;
						unset($atom[$k]);
					}else{
						$matchmore[$k][$ori_k] = array_keys($matchintersect);
						if($all == 1){
							$result['matchone'][$k] = $each;
						}
					}
				}elseif($i == $all-1){
					if($ismatch == 0){
						$result['matchmore'][$k] = $each;
					}else{
						
						$matchmore[$k][$ori_k] = array_keys($matchintersect);
						
						//print_r($matchmore[$k]);//exit;
						if(count($this->_array_intersect($matchmore[$k]))>0){
							$result['matchone'][$k] = $each;
						}else{
							$result['matchmore'][$k] = $each;
						}
										
					}
				}else{
					if($ismatch == 0){
						$result['matchmore'][] = $each;
						unset($atom[$k]);
					}else{
						$matchmore[$k][$ori_k] = array_keys($matchintersect);
					}
				}
			}
			$i++;
		}
		
		
		//print_r($result);exit;
		return $result;
	}
	
	private function _array_intersect($array)
	{
		$c = count($array);
		$result = array();
		if($c<2){
			return $result;
		}
		$array = array_values($array);
		for ($i = 0; $i < $c-1; ++$i){
			$result = $i==0?array_intersect($array[$i],$array[$i+1]):array_intersect($result,$array[$i+1]);
		}
		return $result;
	}
	
	/**************************************************************
	 *
	*  使用特定function对数组中所有元素做处理
	*  @param  string  &$array     要处理的字符串
	*  @param  string  $function   要执行的函数
	*  @return boolean $apply_to_keys_also     是否也应用到key上
	*  @access public
	*
	*************************************************************/
	function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
	{
		static $recursive_counter = 0;
		if (++$recursive_counter > 1000) {
			die('possible deep recursion attack');
		}
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$this->arrayRecursive($array[$key], $function, $apply_to_keys_also);
			} else {
				$array[$key] = $function($value);
			}
	
			if ($apply_to_keys_also && is_string($key)) {
				$new_key = $function($key);
				if ($new_key != $key) {
					$array[$new_key] = $array[$key];
					unset($array[$key]);
				}
			}
		}
		$recursive_counter--;
	}
	
	/**************************************************************
	 *
	*  将数组转换为JSON字符串（兼容中文）
	*  @param  array   $array      要转换的数组
	*  @return string      转换得到的json字符串
	*  @access public
	*
	*************************************************************/
	function JSON($array) {
		$this->arrayRecursive($array, 'urlencode', true);
		$json = json_encode($array);
		return urldecode($json);
	}
	
	function drawUndateq($array){
		$q = '';
		$i = 0;
		foreach($array as $k=>$v){
			if($i>0){
				$q .= ',';
			}
			$q .= '`'.$k.'`=\''.$v.'\'';
			$i++;
		}
		return $q;
	}
	
	function drawInsertq($array){
		$i = 0;
		$q = '';
		foreach($array as $key=>$val){
			if($i>0){
				$q .= ',';
			}
			$q .= '`'.$key.'`';
			$i++;
		}
		$q .= ') VALUES (';
		$i = 0;
		foreach($array as $key=>$val){
			if($i>0){
				$q .= ',';
			}
			$q .= '\''.(is_array($val)?implode(',',$val):$val).'\'';
			$i++;
		}
		$q .= ')';
	
		return $q;
	}
	
	function compare($a,$b){
		$result = array();
		foreach($a as $k=>$v){
			if(!isset($b[$k]) || $v != $b[$k]){
				$result[$k] = $v;
			}
		}
		return $result;
	}
	
	/**
	 * @name load_excel_file_bak
	 *
	 * @author desand
	 * @version 2.0.0
	 */
	private function load_excel_file_bak($url)
	{
		error_reporting(E_ERROR);
	
		require_once APPPATH . 'libraries/PHPExcel/PHPExcel.php';
		ini_set("memory_limit","512M");
		set_time_limit(300);
	
		$inputFileType = PHPExcel_IOFactory::identify($url);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		//$objReader->setReadDataOnly(true);
	
		$objPHPExcel = $objReader->load($url);
		//$sheet_count = $objPHPExcel->getSheetCount();
	
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	
		/*$col_num = 0;
			$col_max = 0;
	
		for ($s = 0; $s < 1; $s++)
		{
		$currentSheet = $objPHPExcel->getSheet($s);// 当前页
		$row_num = $currentSheet->getHighestRow();// 当前页行数
		$col_max = $currentSheet->getHighestColumn(); // 当前页最大列号
			
		if(strlen($col_max)==2){
		$col_num = $col_num==0?( (ord(substr($col_max,0,1)) - ord('A') + 1)*26+(ord(substr($col_max,1,1)) - ord('A') + 1) ):$col_num;
		}else{
		$col_num = $col_num==0?(ord($col_max) - ord('A') + 1):$col_num;
		}
			
		// 循环从第二行开始，第一行往往是表头
		for($i = 1; $i <= $row_num; $i++)
		{
		$cell_values = array();
		for($j = 0; $j < $col_num; $j++)
		{
		$thisj = '';
		$tj = floor($j/26);
		if($tj != 0){
		$thisj = chr($tj+64).''.chr(($j%26)+65);
		}else{
		$thisj = chr($j+65);
		}
			
		$address = $thisj . $i; // 单元格坐标
		$cell_values[] = addslashes($currentSheet->getCell($address)->getFormattedValue());
		}
		// 看看数据
		if(count($cell_values) == $col_num){
		$result['data'][] = $cell_values;
		}
		}
		}*/
	
		$result['count'] = count($sheetData)-2;
		$result['key'] = $sheetData[1];
		$result['val'] = $sheetData[2];
	
		unset($sheetData[1]);
		unset($sheetData[2]);
		$result['data'] = $sheetData;
	
		return $result;
	}
}
?>