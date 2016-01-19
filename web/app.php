<?php
use Symfony\Component\HttpFoundation\Request;
/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../app/bootstrap.php.cache';

if (extension_loaded('apc') && ini_get('apc.enabled')) {
    $apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__FILE__), $loader);
    $loader->unregister();
    $apcLoader->register(true);
}

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
