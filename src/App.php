<?php
namespace KlikFlight;
/**
 * @package  KlikFlight\App
 * @author   Aris Riswanto
 * @version  1.0.dev
 * @since    Developement
 * @licence  MIT LICENCE
 * KlikFlight The Flight MicroFramework MVC Application Library
 * This Package Inspired By CodeIgniter Framework
 */
use Flight;
use Exception;
use ReflectionClass;
use ReflectionMethod;
class App{
	/**
	 * The Constructor
	 */
	public function __construct(){
		/**
		 * Pass The Default Configuration.
		 */
		Flight::path(APPPATH. '/controller/');
		Flight::set('flight.default.index', 'index');
		Flight::set('flight.model.prefix', '_model');
		Flight::set('flight.library.prefix', '_lib');
		Flight::set('flight.helper.prefix', '_helper');
		Flight::set('flight.views.path', APPPATH .'/view');
		Flight::set('flight.views.extension', '.php');
	}
	/**
	 * Initialized The Framework
	 * Example
	 * $app = new KlikFlight\App();
	 * $app->start();
	 * @return void
	 */
	public function start(){
		$config = require(APPPATH. '/config/config.php');
		foreach ($config['framework'] as $key => $value) {
			if($value){
				Flight::set('flight.'.$key, $value);
			}
		}
		/**
		 * Mapping Model To Framework Static Closure Method
		 */
		Flight::map('model', function($name = null, $args = array()){
			if(is_null($name)){
				Flight::error(new Exception('Please Provide a Model Name'));
			}
			return $this->model($name, $args);
		});
		/**
		 * Mapping Library To Framework Static Closure Method
		 */
		Flight::map('library', function($name = null, $args = array()){
			if(is_null($name)){
				Flight::error(new Exception('Please Provide a Library Name'));
			}
			return $this->library($name, $args);
		});
		/**
		 * Mapping Helper To Framework Static Closure Method
		 */
		Flight::map('helper', function($name = null){
			if(is_null($name)){
				Flight::error(new Exception('Please provide a Helper name..!'));
			}else{
				return $this->helper($name);
			}
		});
		/**
		 * Mapping Route Controller To Framework Static Closure Method
		 */
		Flight::map('routeController', function($name, $obj = null, $pass_route = true){
			return $this->controller($name, $obj, $pass_route);
		});
		/**
		 * Mapping Route Anything To Framework Static Closure Method
		 */
		Flight::map('routeAny', function($route, $handler, $pass_route = false){
			return Flight::router()->map($route, $handler, $pass_route);
		});
		/**
		 * Mapping Route GET Method To Framework Static Closure Method
		 */
		Flight::map('routeGet', function($route, $handler, $pass_route = false){
			return Flight::router()->map('GET '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route POST Method To Framework Static Closure Method
		 */
		Flight::map('routePost', function($route, $handler, $pass_route = false){
			return Flight::router()->map('POST '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route PUT Method To Framework Static Closure Method
		 */
		Flight::map('routePut', function($route, $handler, $pass_route = false){
			return Flight::router()->map('PUT '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route PATCH Method To Framework Static Closure Method
		 */
		Flight::map('routePatch', function($route, $handler, $pass_route = false){
			return Flight::router()->map('PATCH '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route DELETE Method To Framework Static Closure Method
		 */
		Flight::map('routeDelete', function($route, $handler, $pass_route = false){
			return Flight::router()->map('DELETE '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route TRACE Method To Framework Static Closure Method
		 */
		Flight::map('routeTrace', function($route, $handler, $pass_route = false){
			return Flight::router()->map('TRACE '.$route, $handler, $pass_route);
		});
		/**
		 * Mapping Route OPTIONS Method To Framework Static Closure Method
		 */
		Flight::map('routeOptions', function($route, $handler, $pass_route = false){
			return Flight::router()->map('OPTIONS '.$route, $handler, $pass_route);
		});
		/**
		 * Check If Routing Configuration file is Exists
		 * Then Start The Routing Framework.
		 */
		if(file_exists(APPPATH .'/config/route.php')){
			require_once APPPATH .'/config/route.php';
			Flight::start();
			exit();
		}else{
			Flight::error(new Exception('Route File Does not Found...!'));
		}
	}
	/**
	 * The Controller Method
	 * This is Private Method. Please Use Flight::routeController($name, $obj, $pass_route);
	 * @param  string $name        Route Url Passed
	 * @param  string $obj         Controller ClassName
	 * @param  boolean $pass_route Pass Route
	 * @return boolean             Returned Type
	 */
	private function controller($name, $obj, $pass_route){
		$sep = $name === '/' ? '' : '/';
		try{
			$reflector = new ReflectionClass($obj);
			$instance = $reflector->newInstance();
		}catch(Exception $e){
			Flight::error($e);
		}
		$validMethod = $this->getValidMethods();
		foreach($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $method){
			foreach($validMethod as $valid){
				if(stripos($method->name, $valid) === 0){
					$type = (($valid === 'ANY') ? '' : $valid.' ');
					$methodName = $this->camelCaseToDashed(
						substr($method->name, strlen($valid))
					);
					$param = $this->buildControllerParam($method);
					if($methodName === Flight::get('default.index')){
						Flight::router()->map(
							$type.$name.$param,
							array($method->class, $method->name)
						);
					}
					Flight::router()->map(
						$type.
						$name.
						$sep.
						$methodName.
						$param,
						array($method->class, $method->name)
					);
				}
			}
		}
		return $this;
	}
	/**
	 * Convert Camel Case To Dashed
	 * This is Private Method
	 * @param  string $string String To Convert
	 * @return void         Returned lowercase string
	 */
	private function camelCaseToDashed($string) { 
		return strtolower(preg_replace('/([A-Z])/', '-$1', lcfirst($string)));
	}
	private function buildControllerParam(ReflectionMethod $method){
		$params = '';
		foreach($method->getParameters() as $param){
			
			if($param->isOptional()){
				$var = '(/@'.$param->getName();
			}else{
				$var = '/@'.$param->getName();
			}
			$params .= $var .($param->isOptional() ? ')' : '');
		}
		return $params;
	}
	/**
	 * Allowed Method
	 * This is Private Method
	 * @return array Returned Array String
	 */
	public function getValidMethods(){
		return ['ANY', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'TRACE','OPTIONS'];
	}
	/**
	 * The Model Loader
	 * This is Private Method. Please Use Flight::model($model, $args);
	 * @param  string $model Model Name Without Prefix
	 * @param  array  $args  Parameters Argument
	 * @return object        Returned Object Class
	 */
	private function model($model = null, $args = array()){
		$model = $model.Flight::get('flight.model.prefix');
		$path = '';
		if(($last_slash = strrpos($model, '/')) !== false){
			$path = substr($model, 0, ++$last_slash);
			$model = substr($model, $last_slash);
		}
		$model = ucfirst($model);
		$file = APPPATH.'/model/'.$path.$model.'.php';
		if(file_exists($file)){
			if(!class_exists($model)) require_once $file;
			try{
				$reflector = new ReflectionClass($model);
				return $reflector->newInstanceArgs($args);
			}catch(Exception $e){
				Flight::error($e);
			}
		}else{
			Flight::error(new Exception('Model Located at '.$file.' Is Not Found..!'));
		}
	}
	/**
	 * The Library Loader
	 * This is Private Method. Please Use Flight::library($model, $args);
	 * @param  string $lib   Library Name Without Prefix
	 * @param  array  $args  Parameters Argument
	 * @return object        Returned Object Class
	 */
	private function library($lib = null, $args = array()){
		$lib = $lib.Flight::get('flight.library.prefix');
		$path = '';
		if(($last_slash = strrpos($lib, '/')) !== false){
			$path = substr($lib, 0, ++$last_slash);
			$lib = substr($lib, $last_slash);
		}
		$lib = ucfirst($lib);
		$file = APPPATH.'/library/'.$path.$lib.'.php';
		if(file_exists($file)){
			if(!class_exists($lib)) require_once $file;
			try{
				$reflector = new ReflectionClass($lib);
				return $reflector->newInstanceArgs($args);
			}catch(Exception $e){
				Flight::error($e);
			}
		}else{
			Flight::error(new Exception('Libraries Located at '.$file.' Is Not Found..!'));
		}
	}
	/**
	 * The Helper Loader
	 * This is Private Method. Please Use Flight::helper($helper);
	 * @param  string $helper Helper Name Without Prefix
	 * @return void           Returned Included File.
	 */
	private function helper($helper = array()){
		if(is_array($helper)){
				foreach($helper as $name){
					return $this->helper($name);
				}
		}
		$path = '';
		if(($last_slash = strrpos($helper, '/')) !== false){
			$path = substr($helper, 0, ++$last_slash);
			$helper = substr($helper, $last_slash);
		}
		$helper = $helper.Flight::get('flight.helper.prefix');
		$file = APPPATH.'/helper/'.$path.$helper. '.php';
		if(file_exists($file)){
			require_once $file;
		}else{
			Flight::error(new Exception('Helper Located at '.$file.' Is Not Found..!'));
		}
	}
}



















