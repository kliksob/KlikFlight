<?php
use KlikFlight\Model;
class User_model extends Model{
	public function __construct(){
		$this->name = "User";
	}
	public function user(){
		echo 'Hello '.$this->name;
	}
}