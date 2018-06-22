#!/usr/bin/env bash

mysql -e 'create database IF NOT EXISTS kunstmaanbundles;'
cp app/config/parameters.yml.dist app/config/parameters.yml
sed -i 's/dbuser/travis/g' app/config/parameters.yml

if [ "TRAVIS_EVENT_TYPE" != "cron" ]; then
    composer install --no-scripts --optimize-autoloader;
else
    composer update --no-scripts --optimize-autoloader;
fi;

bin/console --force --no-interaction doctrine:schema:drop --env=dev || exit $?
bin/console --no-interaction doctrine:schema:create --env=dev || exit $?

if [[ $TRAVIS_PHP_VERSION = 5.* ]]; then
    php vendor/sensio/distribution-bundle/Resources/bin/build_bootstrap.php
fi

echo "Prepare behat environment"

# Configure display
/sbin/start-stop-daemon --start --quiet --pidfile /tmp/xvfb_99.pid --make-pidfile --background --exec /usr/bin/Xvfb -- :99 -ac -screen 0 1680x1050x16
export DISPLAY=:99

chromium-browser --version

# Download and configure ChromeDriver
if [ ! -f $BUILD_CACHE_DIR/chromedriver ] || [ "$($BUILD_CACHE_DIR/chromedriver --version | grep -c 2.35)" = "0" ]; then
    # Using ChromeDriver 2.35 which supports Chrome 62-64, we're using Chromium 62
    curl https://chromedriver.storage.googleapis.com/2.35/chromedriver_linux64.zip > chromedriver.zip
    unzip chromedriver.zip
    mv chromedriver $BUILD_CACHE_DIR
fi

# Download and configure Selenium
if [ ! -f $BUILD_CACHE_DIR/selenium.jar ] || [ "$(java -jar $BUILD_CACHE_DIR/selenium.jar --version | grep -c 3.11.0)" = "0" ]; then
    curl https://selenium-release.storage.googleapis.com/3.11/selenium-server-standalone-3.11.0.jar > selenium.jar
    mv selenium.jar $BUILD_CACHE_DIR
fi

echo "Start selenium"
PATH=$PATH:$BUILD_CACHE_DIR java -jar $BUILD_CACHE_DIR/selenium.jar > $TRAVIS_BUILD_DIR/selenium.log 2>&1 &
sleep 5
