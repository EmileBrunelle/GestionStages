<?php
/**
 * Created by PhpStorm.
 * User: Werner Burat
 * Date: 06-Nov-18
 * Time: 1:39 PM
 */
$_SERVER[ 'HTTP_HOST' ] = 'stage123.ca'; //  use only domain name here
require dirname(__DIR__) . '/config/bootstrap.php';
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Routing\Router;
use Cake\Routing\DispatcherFactory;
if(PHP_SAPI == "cli" && $argc == 2) {
    $dispatcher = DispatcherFactory::create();
    $request = new Request($argv[1]);
    $request = $request->addParams(
        Router::parse(
            $request->url,
            ''
        )
    );
    $dispatcher->dispatch(
        $request,
        new Response()
    );
}
else {
    exit;
}
?>