This is my first project.

# Welcome to my new repository.

KlikFlight is a Web Application Framework based on Micro Framework Flight That is very light for a small website and very good for restfull applications.

## How to Use.

There are two options for you when you want to install this application for your project.

### The first way.

This is the way I recommend.
Use Composer Autoloader.
Since I have not published this repository to Packagist yet. The alternative is the way you download this repository.

Type in your terminal.

```shell
$ ~ composer update
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
For More Information About Routing Please See http://flightphp.com/learn/#routing


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
Flight::model('helpername', $args = array()); // Helper Name Without Prefix
```
This Will Include Your Helper.

More Documentation Information About Flight http://flightphp.com/learn/

You can also contribute to this repository. Please.

Thank you.
