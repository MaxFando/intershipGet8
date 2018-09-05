<?php 

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\MongoDB\Client;

define('ROOT_PATH', __DIR__ . '/../..');
define('APP_PATH', ROOT_PATH . '/app');
define('VENDOR_PATH', ROOT_PATH . '/vendor');

require_once ROOT_PATH . '/vendor/autoload.php';

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

// Create a DI
$di = new FactoryDefault();

$di->set(
    'mongo',
    function (){


        $dsn = sprintf(
          'mongodb://%s:%s@%s', 'root', 'example', 'mongo'
        );

        $mongo = new Client($dsn);

        return $mongo->selectDatabase('Blog');
    },
    true
);

$di->set(
    "collectionManager",
    function () {
        return new \Phalcon\Mvc\Collection\Manager();
    }
);

// Setup the view component
$di->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set(
    'url',
    function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    }
);

// $di->set( 
//     'db',
//     function () {
//         return new DbAdapter(
//             [
//                 'host'     => 'mongo:27017',
//                 'username' => 'root',
//                 'password' => 'qwerty123',
//                 'dbname'   => 'Blog',
//             ]
//         );
//     }
// );


$application = new Application($di);

try {
    // Handle the request
    $response = $application->handle();

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}
