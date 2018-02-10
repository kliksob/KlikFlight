<?php
/**
 * Flight MicroFramework Routing File.
 * @author Aris Riswanto
 */

/**
 * Object Method Routing
 */

$home = new HomeController();
Flight::routeGet('/', array($home, 'index'));
Flight::routeGet('/flight', array($home, 'getFlightInstance'));
Flight::routeGet('/test(/*)', array($home, 'test'));

/**
 * Static Method Routing
 */

class RouteStatic{
	static function example(){
		echo 'Hello Static';
	}
}
Flight::routeGet('/static', array('RouteStatic', 'example'));

/**
 * Controller Method Routing pass All Public Class Object Method
 * Static Method Does't Work.
 */

Flight::routeController('/blog', 'TestController');

/**
 * Regular Method Routing
 */

Flight::route('/regular', function(){
	echo '<pre>';
	print_r(Flight::app());
	
});















