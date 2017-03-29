#!/usr/bin/env bash

bin/console kuma:generate:bundle
bin/console kuma:generate:default-site
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load

## Optionaly: create admin behat tests
bin/console kuma:generate:admin-tests

npm install -g uglify-js
npm install -g uglifycss

## Optionaly: Set node version (if no NVM installed, do it manually)
nvm install

bundle install
npm install
npm run build

bin/console assets:install --symlink
bin/console assetic:dump
