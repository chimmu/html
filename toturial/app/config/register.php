<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Loader;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Logger\Adapter\File as FileAdapter;
// Register an autoloader
$loader = new Loader ();
$loader->registerDirs ( [ 
	APP_PATH . 'app/controllers/'
	//		'../app/models/' 
] )->register ();

$di = new FactoryDefault ();

$di->set('dispatcher', function() use ($di) {
	$eventsManager = new EventsManager;

	/**
	 *      * Check if the user is allowed to access certain action using the SecurityPlugin
	 *           */
//	$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

	/**
	 * Handle exceptions and not-found exceptions using NotFoundPlugin
	 */
//	$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
	$dispatcher = new Dispatcher;
	$dispatcher->setEventsManager($eventsManager);
	return $dispatcher;
});
// Setup the view component
$di->set ( 'view', function () {
	$view = new View ();
	$view->setViewsDir ( APP_PATH . 'app/views/' );
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
	return new FileAdapter ( '/data/log/wechat/' . date ( 'Y-m-d_H' ) . ".log" );
} );
