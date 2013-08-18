<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
$loader = new ApcClassLoader('sf2', $loader);
$loader->register(true);

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('prod', false);
// Make sure non production servers run the staging env, replace the line above by
// these and enter your main domain name
//if (stripos(gethostname(), 'mytestproject.com') !== false){
//    $kernel = new AppKernel('prod', false);
//} else {
//    $kernel = new AppKernel('test', false);
//}

$kernel->loadClassCache();
if (!isset($_SERVER['HTTP_SURROGATE_CAPABILITY']) || false === strpos($_SERVER['HTTP_SURROGATE_CAPABILITY'], 'ESI/1.0')) {
    require_once __DIR__.'/../app/AppCache.php';
    $kernel = new AppCache($kernel);
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
