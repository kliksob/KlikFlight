This is my first project.

# Welcome to my new repository.

KlikFlight is a Web Application Framework based on Flight Micro Framework That is very light for a small website and very good for restfull applications.

## How to Use.

There are two options for you when you want to install this application for your project.

### The first way.

This is the way I recommend.
Use Composer Autoloader.

Type in your terminal.

```shell
$~ composer require kliksob/klikflight
$~ composer update
```
Create index.php File in your public root Directory.
```php
<?php
/**
 * This is Index.php File If you Use public directory
 */
define('APPROOT', __DIR__); // set root directory. not public
define('APPPATH', APPROOT. '/app'); // set your application directory
require_once APPROOT. '/vendor/autoload.php';
$app = new KlikFlight\App();
$app->start();
```


### The second way.

By Changing File Index.php

Please Uncomment
```php
// require_once APPPATH. '/src/vendor/autoload.php';
```

And Add a comment on the line
```php
require_once APPROOT. '/vendor/autoload.php';
```

This will work without Composer. Recommended for small projects.

#### Configuration
/app/config.php

```php
return [
	/* Basic Config */
	'config' => [
	],
	/* Framework Config */
	'framework'	=> [
		'default.index'		=> 'index',
		'case_sensitive' 	=> false,
		'views.path'		=> APPPATH. '/view/',
		'views.extension'	=> '.php',
		'model.prefix'		=> '_model',
		'helper.prefix'		=> '_helper',
		'library.prefix'	=> '_lib',
		'base_url'			=> '',
		'handle_errors'		=> true,
		'log_errors'		=> true
	]
];
```

#### Routing
/app/route.php

```php
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
Flight::route('/static', array('RouteStatic', 'example'));

// For Specific Method
//Flight::routeAny($route, $callback);
//Flight::routeGet($route, $callback);
//Flight::routePost($route, $callback);
//Flight::routePut($route, $callback);
//Flight::routePatch($route, $callback);
//Flight::routeDelete($route, $callback);
//Flight::routeHead($route, $callback);
//Flight::routeTrace($route, $callback);
//Flight::routeOptions($route, $callback);

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
```

Added by me. And the following features are not in the flight framework.
For More Information About Routing Engine Please See http://flightphp.com/learn/#routing

#### Using Flight::routeController();
```php
<?php
class Example{
	public function __construct(){
		// the constructor
	}
	public function anyIndex(){
		echo 'i am receipe anything';
		//This Will get Anything method * http://example.com/controller/ or http://example.com/controller/index
	}
	public function getData($var1 = '', $var2 = null){
		echo 'i am receipe get';
		// This will only GET method like http://example.com/controller/data(/@var1)(/@var2)
	}
	public function postData(){
		echo 'i am receipe post';
		// This will only POST method like http://example.com/controller/data
	}
	public function putData(){
		echo 'i am receipe put';
		// This will only PUT method like http://example.com/controller/data
	}
	public function deleteData(){
		echo 'i am receipe delete';
		// This will only DELETE method like http://example.com/controller/data
	}
}
```
```php
Flight::routeController('/controller', 'Example');
// You can Pass With Namespace
Flight::routeController('/controller', 'Mynamespace\Example');
```
Please note: Static Class Does not Work.

#### Loading Model
```php
Flight::model('modelname', $args = array()); // Model Name Without Prefix
```
This Will Get Model Instance.

#### Loading Library
```php
Flight::library('libraryname', $args = array()); // Library Name Without Prefix.
```
This Will Get Model Instance.

#### Loading Helper
```php
Flight::helper('helpername', $args = array()); // Helper Name Without Prefix
```
This Will Include Your Helper.

More Documentation Information About Flight http://flightphp.com/learn/

You can also contribute to this repository. Please.

Thank you.
