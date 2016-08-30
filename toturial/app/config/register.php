<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Loader;
// Register an autoloader
$loader = new Loader ();
$loader->registerDirs ( [ 
		'../app/controllers/',
		'../app/models/' 
] )->register ();

$di = new FactoryDefault ();

// Setup the view component
$di->set ( 'view', function () {
	$view = new View ();
	$view->setViewsDir ( '../app/views/' );
	return $view;
} );

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set ( 'url', function () {
	$url = new UrlProvider ();
	$url->setBaseUri ( '/' );
	return $url;
} );
	
	// setup logger
$di->set ( 'logger', function () {
	return new FileAdapter ( '/data/log/toturial_zhaocm' . date ( 'Y-m-d_H' ) . ".log" );
} );