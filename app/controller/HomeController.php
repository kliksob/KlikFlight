<?php
use KlikFlight\Controller;
class HomeController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->name = 'Azib';
	}
	public function index(){
		Flight::render('hello');
	}
	protected function hello(){
		echo 'Hello hello';
	}
	public function getFlightInstance(){
		echo '<pre>';
		//print_r(self::get());
		print_r(Flight::app());
	}
	public function test(){
		$str = new ReflectionMethod('test');
		
		echo '<pre>';
		print_r($str);
	}
}
