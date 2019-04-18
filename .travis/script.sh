#!/usr/bin/env bash

bin/console kuma:generate:bundle --namespace="MyProject\\WebsiteBundle" --dir=src --no-interaction || exit $?
bin/console kuma:generate:default-site --namespace="MyProject\\WebsiteBundle" --prefix="myproject_" --demosite --browsersync=kunstmaanbundlescms.dev --articleoverviewpageparent="HomePage,ContentPage" --no-interaction || exit $?

# Setup frontend
npm set progress=false
npm --version
npm install
npm run build

# Setup application
bin/console doctrine:schema:drop --env=dev --force --no-interaction || exit $?
bin/console doctrine:schema:create --env=dev --no-interaction || exit $?
bin/console doctrine:fixtures:load --env=dev --no-interaction || exit $?
bin/console kuma:generate:admin-tests --namespace="MyProject\\WebsiteBundle" || exit $?
bin/console assets:install --env=test --no-interaction || exit $?
bin/console cache:clear --env=test --no-interaction || exit $?
bin/console cache:warmup --env=test --no-interaction || exit $?
chmod -R 777 var/cache/ var/logs/

# Check that the YAML config files contain no syntax errors
bin/console lint:yaml app/config || exit $?
# Check that the Twig template files contain no syntax errors
bin/console lint:twig app/Resources/views || exit $?
bin/console lint:twig src/MyProject/WebsiteBundle/Resources/views || exit $?
# Check that the application doesn't use dependencies with known security vulnerabilities
bin/console security:check --end-point=https://security.symfony.com/check_lock || exit $?

# Start webserver for behat
bin/console server:run 127.0.0.1:8000 --no-debug --quiet > $TRAVIS_BUILD_DIR/webserver.log 2>&1 &

# Run behat tests
php -d memory_limit=2048M bin/behat --suite=default --strict -f progress || exit $?
