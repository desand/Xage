<?php
class xanalysis{
	private $_key = '7AND';
	private $_show_id = ''; 
	private $_g = array();
	private $_model;
	
	private $_fields = array(
		'attendees' => array('barcode','ticket_id','Reg_Date'),
		'checkin' => array('*'),
	);
	private $_db = array(
		'attendee' => 'regs_attendees',
		'checkin' => 'regs_subsection_checkin',
	);
	private $_needgroup = array(
		'attendee' => array('ticket_id','Reg_Date'),
		'checkin' => array('boarding_date','subsection_id','station'),
	);
	private $_setting = array(
		'base' => array(
			'attendee' => array('ticket_id','Reg_Date'),
			'checkin' => array('boarding_date','subsection_id','station'),
		),
		#comb 暂时只支持 [2层] 和 [3层]  两种情况.  而且只限 相同表内
		'comb' => array(
			array(
				'k'=>array('attendee##ticket_id','attendee##Reg_Date'),
				't'=>'rs'
			),
		),
	);
	
	function __construct($model){
		$this->_model = $model;
		
		$attendee = $model->q("SELECT `".implode('`,`',$this->_fields['attendees'])."` FROM `".$this->_db['attendee']."` WHERE `show_id`='8'");
		$checkin = $model->q("SELECT * FROM `".$this->_db['checkin']."`  ");
		
		foreach($this->_needgroup as $key => $rows){
			foreach($rows as $row){
				$this->_g[$key][$row] = $this->_group($$key,$row);
			}
		}
		print_r($this->_g);
	}
	
	function _decode($str){
		return explode($this->_key, base64_decode(base64_decode(urldecode($str))));
	}
	
	function _encode($array){
		$barcodes = array();
		foreach ($array as $k => $value) {
			# code...
			$barcodes[] = $value['barcode'];
		}
			
		$str = implode($this->_key, $barcodes);
		return urlencode(base64_encode(base64_encode(($str))));
	}
	function _array($resource,$uppers = array('barcode','Country')){
		$result = array();
		if($resource && mysql_num_rows($resource)>0)
		{
			while($row = mysql_fetch_assoc($resource))
			{
				foreach ($uppers as $uppkey){
					if(isset($row[$uppkey])){
						 $row[$uppkey] = strtoupper($row[$uppkey]);
					}
				}
				
				$result[] = $row;
			}
		}
		return $result;
	}
	function _com($d,$a,$b,$s,$n = 0){
		if($n == $b){
			$key = count($GLOBALS['_datesResult']);
			for ($x=0; $x < $b; $x++) { 
				# code...
				if(isset($GLOBALS['_datesResult'][$key])){
					$GLOBALS['_datesResult'][$key] .= $GLOBALS['_dates'][$x];
				}else{
					$GLOBALS['_datesResult'][$key] = $GLOBALS['_dates'][$x];
				}
				
			}
			return;
		}
		for ($i=$s; $i < $d ; $i++) { 
			# code...
			$GLOBALS['_dates'][$n] = $a[$i];
			_com($d,$a,$b,$i+1,$n+1);
		}
	}
	/**
	 * $array array()
	 * $g array('Reg_Date','Cat') eg.
	 * $where = array(
	 * 		'Reg_Date' => '2013-04-10',
	 *		'A' => '_EMPTY_'
	 * );
	 * $unique eg: barcode
	 */
	function _group($array,$g,$where = array(),$unqiue = false){
		$result = array();
		if(!empty($array))
		{
			if(!empty($where)){
				foreach($array as $each)
				{
					if(!isset($result[$each[$g]]) && isset($each[$g])){
						$result[$each[$g]] = array();	
					}
	
					$do = true;
					foreach ($where as $k => $v) {
						# code...
						if($v == '_EMPTY_'){
							if($each[$k] != ''){
								$do = false;
							}
						}else{
							if($each[$k] != $v){
								$do = false;
							}
						}
					}
	
					if($do){
						if($each[$g] == ''){
							$each[$g] = '_EMPTY_';
						}
						if($unqiue){
							$result[$each[$g]][$each[$unqiue]] = $each;
						}else{
							$result[$each[$g]][] = $each;
						}
					}
				}
	
			}else{
				foreach($array as $each)
				{
					if($each[$g] == ''){
						$each[$g] = '_EMPTY_';
					}
					if($unqiue){
						$result[$each[$g]][$each[$unqiue]] = $each;
					}else{
						$result[$each[$g]][] = $each;
					}
				}
			}
		}
		ksort($result);
		return $result;
	}
	
	function _denoising($ori,$ref,$refkey = 'barcode'){
		$refresult = array();
		foreach ($ref as $key => $value) {
			# code...
			$refresult[] = $value[$refkey];
		}
		foreach ($ori as $key => $value) {
			# code...
			if(!in_array($value[$refkey], $refresult)){
				unset($ori[$key]);
			}
		}
		return $ori;
	}
	
	function _addkey($tar,$ori,$key,$by = 'barcode'){
		#先抽取 $ori
		$q_ori = array();
		foreach ($ori as $each) {
			# code...
	
			$q_ori[$each[$by]] = _getkeys($each,$key);
		}
	
		#联合到 $tar
		foreach ($tar as $k=>$each) {
			# code...
			$tar[$k] = array_merge($tar[$k],isset($q_ori[$each[$by]])?$q_ori[$each[$by]]:_getkeys(array(),$key));
		}
		return $tar;
	
	}
	
	function _getkeys($array,$keys){
		$result = array();
		foreach ($keys as $each) {
			$result[$each] = isset($array[$each])?$array[$each]:'_EMPTY_';
		}
		return $result;
	}
	
	function _cangekey($array,$o_key,$tar_key){
		foreach ($array as $k=>$each) {
			$tar_val = $each[$o_key];
			unset($each[$o_key]);
			$each[$tar_key] = $tar_val;
			$array[$k] = $each;
		}
		return $array;
	}
	
	
	function _crossTable($ori,$across_key = 'boarding_date',$key = 'barcode'){
		$result = array();
		foreach ($ori as $d => $eachday) {
			# code...
			//print_r($each);exit;
			foreach ($eachday as $i=>$each) {
				# code...
				if(!isset($result[$each[$key]])){
					$result[$each[$key]] = array_merge($each,array($d=>1));	
				}else{
					$result[$each[$key]] = array_merge($result[$each[$key]],array($d=>1));	
				}
				unset($result[$each[$key]][$across_key]);
				
			}
			
		}
		return $result;
	}
	
	function _countCrossTable($ori,$keys){
		$result = array();
		foreach ($ori as $key => $each) {
			# code...
			$dk = '';
			foreach ($keys as $d) {
				# code...
				if(isset($each[$d]) && $each[$d] == 1){
					$dk .= $d.'##';
				}
			}
	
			if(isset($result[$dk])){
				if(!in_array($key, $result[$dk])){
					$result[$dk][] = $key;	
				}	
			}else{
				$result[$dk][] = $key;	
			}
			
		}
	
		return $result;
	}
	
	function _display($garr,$header){
		$html = '<table cellpadding="0" cellspacing="0"><tr><th colspan="2">'.$header.'</th></tr>';
		foreach ($garr as $key => $value) {
			# code...
			$html .= '<tr><td>'.$key.'</td><td>'.count($value).'</td></tr>';
		}
		return $html.'</table>';
	}
	
	function _displayComb($combarr,$rowval,$keys,$type = 'rs',$rs = array()){
		//print_r($rowval);exit();
		//$rows = array();
	
		$html = '<table cellpadding="0" cellspacing="0"><tr>'.(count($rs)>0?'<th>&nbsp;</th>':'').'<th>&nbsp;</th>';
		foreach ($keys as $key) {
			# code...
			$html .= '<th>'.$key.'</th>';
		}
		$html .= '</tr>';
		
	
		foreach ($combarr as $i => $value) {
			$html .= '<tr>'.(count($rs)>0?'<td>'.$rs[$rowval[$i]]['name_cn'].'</td>':'').'<td>'.$rowval[$i].'</td>';
			foreach ($keys as $key) {
				$html .= '<td '.($GLOBALS['_showdetails'] == 1?'class="showdetails" fflag="'.$key.'" flag="'.$rowval[$i].'" val="'.(isset($value[$key])?_encode($value[$key]):0).'" type="'.$type.'"':'').'>'.(isset($value[$key])?count($value[$key]):0).'</td>';
			}
			$html .= '</tr>';
		}
		return $html.'</table>';
	}
	
	function _displayCrossTable($ct,$header,$dates = array(),$group = array(),$ori = array(),$attendee = array()){
		$keys = array_keys($ct);
		//print_r($ori);exit;
	
		$html = '<table cellpadding="0" cellspacing="0"><caption>每日实时报告(人数)<br/>REALTIME DAILY REPORT(Number of Visitor)</caption>';
		$html .= '<tr class="title"><th rowspan="2">类型[人数]</th>';
		foreach ($dates as $i => $row) {
			# code...
			$html .= '<th';
			if($i>0){
				$html .= ' colspan="'.(2+pow(2, $i)-1).'"';
			}else{
				$html .= ' rowspan="2"';
			}
			$html .= '>DAY '.($i+1).'<br/>'.$row.'</th>';
		}
	
		$html .= '<th rowspan="2">'.count($dates).' DAYS TOTAL</th></tr><tr class="title">';
	
		//$dates = array('2013-04-11','2013-04-12','2013-04-13','2013-04-14');
		$allDates = _getCrossDay($dates);
		//print_r($allDates);exit;
	
		foreach ($allDates as $i => $row) {
			if($i > 0){
				foreach ($row as $k => $v) {
					# code...
					if(strlen($v) == 1){
						$html .= '<th>NEW</th>';
					}else{
						$explode = array();
						if(preg_match_all('/[\d]{1}/', $v, $m) > 0){
							$explode = $m[0];
						}
						unset($explode[(count($explode)-1)]);
	
						$val = '';
						foreach ($explode as $e) {
							# code...
							$val .= (intval($e)+1).' ';
						}
						$html .= '<th>DAY '.$val.' RETURN</th>';
					}
				}
				$html .= '<th>TOTAL</th>';
			}
		}
	
		$html .= '</tr>';
	
		if(count($group) == 0){
			$html .= '<tr class="content"><td>ALL</td>';
		}else{
			$html .= '<tr class="content"><td><div class="c_all">ALL</div><ul>';
			foreach ($group as $each) {
				foreach (array_keys($ori[$each]) as $e) {
					# code...
					$html .= '<li>'.$e.'</li>';
				}
			}
			$html .= '</ul></td>';
		}
		$sum['ALL'] = 0;
		foreach ($group as $each) {
			foreach (array_keys($ori[$each]) as $e) {
				# code...
				$sum[$each][$e] = 0;
			}
		}
	
		foreach ($allDates as $i => $row) {
			$count['ALL'] = 0;
			foreach ($group as $each) {
				foreach (array_keys($ori[$each]) as $e) {
					# code...
					$count[$each][$e] = 0;
				}
			}
	
			foreach ($row as $k => $v) {
				# code...
				$mv = false;
				$mtk = array();
	
				for ($mi=$i+1; $mi < count($allDates); $mi++) { 
					# code...
					foreach ($allDates[$mi] as $mv) {
						# code...
						if($mv != $v && preg_match_all('/^'.$v.'/', $mv, $tm)>0){
							$mexplode = array();
							if(preg_match_all('/[\d]{1}/', $mv, $m) > 0){
								$mexplode = $m[0];
							}
	
							$tmtk = '';
							foreach ($mexplode as $e) {
								# code...
								$tmtk .= $dates[$e].'##';
							}
	
							$mtk[] = $tmtk;
						}
					}
				}
	
				if(strlen($v) == 1){
					$tk = $dates[$v].'##';
					if(isset($ct[$tk])){
						$tsum = count($ct[$tk]);
						$sum['ALL'] += $tsum;
	
						if(count($mtk)>0){
							foreach ($mtk as $me) {
								# code...
								if(isset($ct[$me])){
									$tsum += count($ct[$me]);
								}
							}
						}
						$count['ALL'] += $tsum;
						
	
						$html .= '<td class="total"><div class="c_all">'.$tsum.'</div>';	
	
						if($GLOBALS['_showdetails'] == 1){
							$html .= '<div class="details">';
							foreach ($ct[$tk] as $value) {
								# code...
								$html .= $value.'<br/>';
							}
							$html .= '</div>';
						}
						
					}else{
						$html .= '<td class="total"><div class="c_all">&nbsp;</div>';	
					}
	
					if(count($group) == 0){
						$html .= '</td>';
					}else{
						$prekeyarr = array();
						foreach ($ct[$tk] as $value) {
							# code...
							$prekeyarr[] = array('barcode'=>$value);
						}
	
						$html .= '<ul>';
						foreach ($group as $each) {
							$addkeyVs = _group(_addkey($prekeyarr,$attendee,array($each)),$each);
							
							foreach (array_keys($ori[$each]) as $e) {
								# code...
								$tsum = isset($addkeyVs[$e])?count($addkeyVs[$e]):0;
	
								$sum[$each][$e] += $tsum;
	
								if(count($mtk)>0){
									foreach ($mtk as $me) {
										# code...
										$prekeyarr = array();
										foreach ($ct[$me] as $value) {
											# code...
											$prekeyarr[] = array('barcode'=>$value);
										}
										$maddkeyVs = _group(_addkey($prekeyarr,$attendee,array($each)),$each);
	
										if(isset($maddkeyVs[$e])){
											$tsum += count($maddkeyVs[$e]);
										}
									}
								}
								$count[$each][$e] += $tsum;
	
	
								$html .= '<li><span>'.$tsum.'</span>';
	
								if($GLOBALS['_showdetails'] == 1 && $tsum>0){
									$html .= '<div class="details">';
									foreach ($addkeyVs[$e] as $value) {
										# code...
										$html .= $value['barcode'].'<br/>';
									}
									$html .= '</div>';
								}
	
								$html .= '</li>';
	
								//$count[$each][$e] += $tsum;
								//$sum[$each][$e] += $tsum;
							}
						}
						$html .= '</ul></td>';
					}
	
				}else{
					$explode = array();
					if(preg_match_all('/[\d]{1}/', $v, $m) > 0){
						$explode = $m[0];
					}
					//unset($explode[(count($explode)-1)]);
	
					$tk = '';
					foreach ($explode as $e) {
						# code...
						$tk .= $dates[$e].'##';
					}
	
					if(isset($ct[$tk])){
						
						$tsum = count($ct[$tk]);
	
						$sum['ALL'] += $tsum;
	
						if(count($mtk)>0){
							foreach ($mtk as $me) {
								# code...
								if(isset($ct[$me])){
									$tsum += count($ct[$me]);
								}
							}
						}
						$count['ALL'] += $tsum;
	
	
						$html .= '<td class="total"><div class="c_all">'.$tsum.'</div>';	
	
						if($GLOBALS['_showdetails'] == 1){
							$html .= '<div class="details">';
							foreach ($ct[$tk] as $value) {
								# code...
								$html .= $value.'<br/>';
							}
							$html .= '</div>';
						}
	
						//$count['ALL'] += $tsum;
						//$sum['ALL'] += $tsum;
	
					}else{
						$html .= '<td class="total"><div class="c_all">&nbsp;</div>';	
					}
	
					if(count($group) == 0){
						$html .= '</td>';
					}else{
						$prekeyarr = array();
						foreach ($ct[$tk] as $value) {
							# code...
							$prekeyarr[] = array('barcode'=>$value);
						}
						
						$html .= '<ul>';
						foreach ($group as $each) {
							$addkeyVs = _group(_addkey($prekeyarr,$attendee,array($each)),$each);
							
							foreach (array_keys($ori[$each]) as $e) {
								# code...
								$tsum = isset($addkeyVs[$e])?count($addkeyVs[$e]):0;
	
								$sum[$each][$e] += $tsum;
	
								if(count($mtk)>0){
									foreach ($mtk as $me) {
										# code...
										$prekeyarr = array();
										foreach ($ct[$me] as $value) {
											# code...
											$prekeyarr[] = array('barcode'=>$value);
										}
										$maddkeyVs = _group(_addkey($prekeyarr,$attendee,array($each)),$each);
	
										if(isset($maddkeyVs[$e])){
											$tsum += count($maddkeyVs[$e]);
										}
									}
								}
								$count[$each][$e] += $tsum;
	
								$html .= '<li><span>'.$tsum.'</span>';
	
								if($GLOBALS['_showdetails'] == 1 && $tsum>0){
									$html .= '<div class="details">';
									foreach ($addkeyVs[$e] as $value) {
										# code...
										$html .= $value['barcode'].'<br/>';
									}
									$html .= '</div>';
								}
	
								$html .= '</li>';
								
								//$count[$each][$e] += $tsum;
								//$sum[$each][$e] += $tsum;
							}
						}
						$html .= '</ul></td>';
					}
	
				}
			}
			if($i > 0){
				$html .= '<td class="total"><div class="c_all">'.$count['ALL'].'</div>';
	
				if(count($group) == 0){
					$html .= '</td>';
				}else{
					$html .= '<ul>';
					foreach ($group as $each) {
						foreach (array_keys($ori[$each]) as $e) {
							# code...
							$html .= '<li>'.$count[$each][$e].'</li>';
						}
					}
					$html .= '</ul></td>';
				}
			}
			
		}
		$html .= '<td class="count"><div class="c_all">'.$sum['ALL'].'</div>';
	
		if(count($group) == 0){
			$html .= '</td>';
		}else{
			$html .= '<ul>';
			foreach ($group as $each) {
				foreach (array_keys($ori[$each]) as $e) {
					# code...
					$html .= '<li>'.$sum[$each][$e].'</li>';
				}
			}
			$html .= '</ul></td>';
		}
	
		$html .= '</tr>';
	
		return $html.'</table>';
	}
	function _getCrossDay($dates){
		$a = array_keys($dates);
		$n = count($a);
	
		for ($i=1; $i <= $n; $i++) { 
			# code...
			$k = $i;
			_com($n,$a,$k,0);
		}
	
		$result = array();
	
		foreach ($GLOBALS['_datesResult'] as $each) {
			# code...
			$key = 0;
	
			$explode = array();
			if(preg_match_all('/[\d]{1}/', $each, $m) > 0){
				$explode = $m[0];
			}
			
			foreach ($explode as $e) {
				# code...
				if($e >= $key){
					$key = $e;
				}
			}
	
			$result[$key][] = $each;
	
		}
		$GLOBALS['_datesResult'] = array();
	
		return $result;
	}
}
