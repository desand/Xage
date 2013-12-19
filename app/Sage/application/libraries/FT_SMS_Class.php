<?php
class FT_SMS
{
	private $token    = 16050;
	private $account  = 'seasonfair';
	private $password = 's12345678';
	private $host     = 'sms.106vip.com';
	private $post     = 80;
	
	private function httpRequest($params,$index='sms.aspx')
	{
		if(!empty($params))
		{
			$inData = "";
			$header = "POST /{$index} HTTP/1.1\r\n";
			$header .= "Host:{$this->host}:{$this->post}\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: ".strlen($params)."\r\n";
			$header .= "Connection: Close\r\n\r\n";
			$header .= $params;
			
			$fp = fsockopen($this->host,$this->post);
			fputs($fp,$header);
			
			while(!feof($fp))
			{
				$inData .= fgets($fp);
			}
			return $inData;
		}
		return false;
	}
	
	private function returnSMS($returnRS)
	{
		if(!empty($returnRS))
		{
			$xml = strpos($returnRS,'<?xml version="1.0" encoding="utf-8" ?>');
			if(!empty($xml))
				return (array)simplexml_load_string(substr($returnRS,$xml));
		}
		return false;
	}
	
	#短信发送
	public function SendSMS($mobile=array(),$msg,$send_time='')
	{
		if(!empty($mobile) && is_array($mobile) && !empty($msg))
		{
			$params = "action=send&userid={$this->token}&account={$this->account}&password={$this->password}&mobile=".implode(',',$mobile)."&content={$msg}&sendTime={$send_time}&taskName=&checkcontent=1&mobilenumber=".count($mobile)."&countnumber=".count($mobile)."&telephonenumber=0";
			return $this->returnSMS($this->httpRequest($params));
		}
		return false;
	}
	
	#余额查询
	public function overage()
	{
		$params = "action=overage&userid={$this->token}&account={$this->account}&password={$this->password}";
		return $this->returnSMS($this->httpRequest($params));
	}
	
	#发送状态
	public function statusApi()
	{
		$params = "action=query&userid={$this->token}&account={$this->account}&password={$this->password}";
		return $this->returnSMS($this->httpRequest($params,'statusApi.aspx'));
	}
	
	#上行短信
	public function callApi()
	{
		$params = "action=query&userid={$this->token}&account={$this->account}&password={$this->password}";
		return $this->returnSMS($this->httpRequest($params,'callApi.aspx'));
	}
}

//$u = new FT_SMS();
//$rs = $u->SendSMS(array('13533533509','13609738572'),'TEST CONTENTS'.time());
//$rs = $u->overage();
//$rs = $u->statusApi();
//$rs = $u->callApi();
//print_r($rs);
?>