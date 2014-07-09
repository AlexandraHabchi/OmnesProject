<?php 

define('DS',  DIRECTORY_SEPARATOR);
define('PUBLIC_PATH', __DIR__);
define('APPLICATION_PATH', dirname(__DIR__) . DS . 'application' );
define('CONTROLLER_PATH', APPLICATION_PATH . DS . 'controllers');
define('MODEL_PATH', APPLICATION_PATH . DS . 'models');
define('VIEW_PATH', APPLICATION_PATH . DS . 'views');
define('LAYOUT_PATH', APPLICATION_PATH . DS . 'layouts');
define('LIBRARY_PATH', APPLICATION_PATH . DS . 'libraries');

require_once LIBRARY_PATH . DS . 'Request.php';
require_once LIBRARY_PATH . DS . 'Session.php';
require_once LIBRARY_PATH . DS . 'Response.php';
require_once LIBRARY_PATH . DS . 'Router.php';
require_once LIBRARY_PATH . DS . 'Dispatcher.php';
require_once LIBRARY_PATH . DS . 'View.php';
require_once LIBRARY_PATH . DS . 'Controller.php';
require_once LIBRARY_PATH . DS . 'Layout.php';
require_once LIBRARY_PATH . DS . 'Model.php';
require_once LIBRARY_PATH . DS . 'Url.php';
require_once LIBRARY_PATH . DS . 'Date.php';
require_once LIBRARY_PATH . DS . 'Email.php';
require_once MODEL_PATH . DS . 'Client.php';
require_once MODEL_PATH . DS . 'Password.php';
require_once MODEL_PATH . DS . 'Identifiant.php';
require_once MODEL_PATH . DS . 'Famille.php';
require_once MODEL_PATH . DS . 'Tva.php';
require_once MODEL_PATH . DS . 'Fabricant.php';
require_once MODEL_PATH . DS . 'Error.php';

$request = new Request;
$response = new Response;

$session = new Session;
$request->setSession($session);

$router = new Router($request);
$router->route();

$dispatcher = new Dispatcher($request, $response);
$dispatcher->dispatch();

$response->send();




