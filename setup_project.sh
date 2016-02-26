#!/usr/bin/env bash

app/console kuma:generate:bundle
app/console kuma:generate:default-site
app/console doctrine:database:create
app/console doctrine:schema:create
app/console doctrine:fixtures:load

## Optionaly: create admin behat tests
app/console kuma:generate:admin-tests

npm install -g bower
npm install -g gulp
npm install -g uglify-js
npm install -g uglifycss

bundle install
npm install
bower install
gulp build

app/console assets:install --symlink
app/console assetic:dump
