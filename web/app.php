<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

if(extension_loaded('apc') && ini_get('apc.enabled')){
    // Use APC for autoloading to improve performance.
    // Change 'sf2' to a unique prefix in order to prevent cache key conflicts
    // with other applications also using APC.
    $apcLoader = new ApcClassLoader('sf2', $loader);
    $loader->unregister();
    $apcLoader->register(true);
}

require_once __DIR__.'/../app/AppKernel.php';

$kernel = new AppKernel('prod', false);

$kernel->loadClassCache();
if (!isset($_SERVER['HTTP_SURROGATE_CAPABILITY']) || false === strpos($_SERVER['HTTP_SURROGATE_CAPABILITY'], 'ESI/1.0')) {
    require_once __DIR__.'/../app/AppCache.php';
    $kernel = new AppCache($kernel);
}

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
