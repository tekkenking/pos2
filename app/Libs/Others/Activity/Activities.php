<?php namespace App\Libs\Others\Activity;

use Auth;
use App\Libs\Repos\ActivityRepo as ActivityRepo;

class Activities{

	public $activity;

	public function __construct()
	{
		$this->activity = new ActivityRepo;
	}

	public function make(){
		$args = func_get_args();
		$type = array_shift($args);
		$this->$type($args);
	}


	private function loggedin(){
		$data['username'] = Auth::user()->username;
		$this->save('loggedin', $data);
	}

	private function loggedout(){
		$data['username'] = Auth::user()->username;
		$this->save('loggedout', $data);
	}

	private function sale($params){
		$data['username'] = Auth::user()->username;
		$data['totalprice'] = $params[0]; //TOtal price
		$data['customername'] = $params[1]; // Customer Name
		$data['receipt_number'] = $params[2]; // Receipt Number
		$this->save('sale', $data);
	}

	private function stock($data){
		$data = $data[0];
		$data['username'] = Auth::user()->username;
		$this->save('stock', $data);
	}

	/*private function updateloggedTime($data){
		$user = User::find(Auth::user()->id);
		$user->isloggedin = $data[0];
		$user->loggedtime = sqldate();
		$user->save();
	}*/

	private function save($type, $data){
		$dbcontent['user_id'] = Auth::user()->id;
		$dbcontent['activity_type'] = $type;
		$dbcontent['message_body'] = json_encode($data);
		$this->activity->create($dbcontent);
	}
}