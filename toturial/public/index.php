<?php

use Phalcon\Mvc\Application;
error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Asia/Shanghai');
//use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
define('APP_PATH', __DIR__ . '/../');
try {
    require_once APP_PATH . 'app/config/register.php';
    $config = require_once APP_PATH . 'app/config/config.php';
    // Create a DI
    $application = new Application($di);
    # $services = $application->getDI()->getServices();
    # foreach ($services as $key => $val) {
    # 	var_dump($key);
    # 	var_dump(get_class($application->getDI()->get($key)));
    # } 
    // Handle the request
   echo $application->handle()->getContent();

//     $response->send();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}
