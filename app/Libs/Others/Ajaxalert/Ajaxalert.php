<?php namespace App\Libs\Others\Ajaxalert;

/**
* UPDATED 11th Sept. 2015
* Worked on arrayMessage working with message method
*/

class Ajaxalert
{
	//private static $ini = false;
	private $alertData = array();
	private $alertTypes = array('success', 'error', 'info', 'warning', 'lite', 'created', 'updated');
	
	public function __call($method, $msg=''){
		
		if( !in_array( $method, $this->alertTypes ) ){
			dd('ERROR: Unknown Alert Type = ' . $method);
			return false;
		}
		
		//Bootstrap doesn't use ERROR as red alert. Instead they used DANGER as red alert
		//So we have to change the error key to danger
		if( $method === 'error' ){
			$method = 'danger';
		}
		
		$this->alertData['status'] = $method;	
		
		if( $msg !== '' ){
			$msg = array_shift($msg);
			//return ( is_array($msg) ) ? $this->arrayMessage($msg) : $this->message($msg);
			return $this->message($msg);
		}
		
		return $this;
	}
	
	public function message($msg){
		$this->alertData['message'] = $msg;
		return $this;
	}
	
	public function arrayMessage(Array $msg){
		$this->alertData['arraymessage'] = $msg;
		return $this;
	}
	
	public function url($url){
		$this->alertData['url'] = $url;
		return $this;
	}
	
	public function created($alert="success")
	{
		$this->alertData['status'] = $alert;
		$this->message("Created Successfully");
		return $this;
	}

	public function icon($icon)
	{
		if( isset( $this->alertData['message'] ) && !is_array($this->alertData['message']) ){
			$prefix = 'fa fa-';
			$message = $this->alertData['message'];
			$this->message("<i class='". $prefix . $icon . "'></i> " . $message);
		}
		return $this;
	}
	
	public function get(){
		return $this->alertData;
	}
}