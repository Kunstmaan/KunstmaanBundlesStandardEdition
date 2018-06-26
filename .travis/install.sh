#!/usr/bin/env bash

# No memory limit for running the behat tests
echo "memory_limit = -1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

echo "extension = memcached.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini
# Enable additional PHP extensions
if [[ $TRAVIS_PHP_VERSION =~ 7.[01] ]]; then
    echo "install php 7 apc package"
    pecl config-set preferred_state beta; echo yes | pecl install apcu || exit $?;
fi

echo "extension = apcu.so" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/php.ini;

chmod -R 777 var/cache/ var/logs/
