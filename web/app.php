<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

if(extension_loaded('apc') && ini_get('apc.enabled')){
    // Use APC for autoloading to improve performance.
    // Change 'sf2' to a unique prefix in order to prevent cache key conflicts with other applications also using APC.
    // The Kunstmaan build system does this automatically.
    $apcLoader = new ApcClassLoader('sf2', $loader);
    $loader->unregister();
    $apcLoader->register(true);
}

require_once __DIR__.'/../app/AppKernel.php';

if (getenv('APP_ENV') === 'dev') {
    umask(0000);
    Debug::enable();
    $kernel = new AppKernel('dev', true);
} else {
    $kernel = new AppKernel('prod', false);
}

$kernel->loadClassCache();

if (getenv('APP_ENV') !== 'dev') {
    if (!isset($_SERVER['HTTP_SURROGATE_CAPABILITY']) || false === strpos($_SERVER['HTTP_SURROGATE_CAPABILITY'], 'ESI/1.0')) {
        require_once __DIR__.'/../app/AppCache.php';
        $kernel = new AppCache($kernel);
    }
}

Request::enableHttpMethodParameterOverride();
Request::setTrustedProxies(array('127.0.0.1'));
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
