<?php
use KlikFlight\Controller;
class TestController extends Controller{
	public function __construct(){
		
	}
	public function anyIndex(){
		echo 'i am receipe anything';
	}
	public function getData($var1 = '', $var2 = null){
		echo 'i am receipe get';
	}
	public function postData(){
		echo 'i am receipe post';
	}
	public function putData(){
		echo 'i am receipe put';
	}
	public function deleteData(){
		echo 'i am receipe delete';
	}
}























