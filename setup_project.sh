#!/usr/bin/env bash

bin/console kuma:generate:bundle
bin/console kuma:generate:default-site
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load

## Optionaly: create admin behat tests
bin/console kuma:generate:admin-tests

## Optionaly: build all assets (FE & CMS)
./buildUI.sh

bin/console assets:install --symlink
